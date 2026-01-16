<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Point;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    /**
     * Tampilkan halaman manage users dengan statistik
     */
    public function index(): View
    {
        $users = User::whereNull('deleted_at')
            ->with(['points' => function($query) {
                $query->where('month', now()->month)
                      ->where('year', now()->year);
            }])
            ->orderBy('role')
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        // Hitung statistik
        $totalUsers = User::whereNull('deleted_at')->count();
        
        // Active resellers (role reseller dengan order dalam 30 hari)
        $activeResellers = User::whereNull('deleted_at')
            ->where('role', 'reseller')
            ->where('last_order_at', '>=', now()->subDays(30))
            ->count();
            
        // Inactive users (tidak order 30+ hari)
        $inactiveUsers = User::whereNull('deleted_at')
            ->where('role', '!=', 'admin')
            ->where(function($query) {
                $query->where('last_order_at', '<', now()->subDays(30))
                      ->orWhereNull('last_order_at');
            })
            ->count();
            
        // Rata-rata points per bulan
        $avgPoints = (int) Point::where('year', now()->year)
            ->avg('points') ?? 0;

        return view('admin.manage_users', compact(
            'users', 
            'totalUsers', 
            'activeResellers', 
            'inactiveUsers',
            'avgPoints'
        ));
    }

    /**
     * Update role user - FIXED
     */
    public function updateRole(Request $request, User $user): RedirectResponse
    {
        try {
            $request->validate([
                'role' => ['required', 'in:guest,reseller,admin'],
            ]);

            $oldRole = $user->role;
            $user->role = $request->role;
            $user->save();

            // Log perubahan role
            \Log::info("Role updated", [
                'admin_id' => auth()->id(),
                'user_id' => $user->id,
                'old_role' => $oldRole,
                'new_role' => $user->role
            ]);

            return redirect()
                ->route('admin.manage-users')
                ->with('success', "Role {$user->name} berhasil diubah dari {$oldRole} ke {$user->role}.");
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.manage-users')
                ->with('error', "Gagal update role: " . $e->getMessage());
        }
    }

    /**
     * Update saldo user dengan audit log - FIXED (tanpa balance_before/balance_after)
     */
    public function updateBalance(Request $request, User $user): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:1'],
            'action' => ['required', 'in:add,reduce'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.manage-users')
                ->withErrors($validator)
                ->with('error', 'Validasi gagal.')
                ->withInput();
        }

        try {
            return DB::transaction(function () use ($request, $user) {
                $oldBalance = $user->saldo;
                $amount = (int) $request->amount;
                $action = $request->action;
                $note = $request->note ?? 'Penyesuaian saldo oleh admin';

                switch ($action) {
                    case 'add':
                        $user->increment('saldo', $amount);
                        $newBalance = $oldBalance + $amount;
                        break;
                        
                    case 'reduce':
                        if ($user->saldo < $amount) {
                            return redirect()
                                ->route('admin.manage-users')
                                ->with('error', "Saldo tidak cukup. Saldo saat ini: Rp " . number_format($user->saldo, 0, ',', '.'));
                        }
                        $user->decrement('saldo', $amount);
                        $newBalance = $oldBalance - $amount;
                        break;
                        
                    default:
                        throw new \Exception('Aksi tidak valid.');
                }

                // Catat di transaction log - TANPA balance_before dan balance_after
                TransactionLog::create([
                    'user_id' => $user->id,
                    'description' => "Penyesuaian saldo oleh admin: {$note}",
                    'amount' => $action === 'add' ? $amount : -$amount,
                    'type' => 'adjustment',
                    'metadata' => json_encode([
                        'admin_id' => auth()->id(),
                        'action' => $action,
                        'note' => $note,
                        'old_balance' => $oldBalance, // Simpan di metadata
                        'new_balance' => $newBalance, // Simpan di metadata
                        'ip_address' => $request->ip()
                    ])
                ]);

                \Log::info("Saldo updated", [
                    'admin_id' => auth()->id(),
                    'user_id' => $user->id,
                    'old_balance' => $oldBalance,
                    'new_balance' => $newBalance,
                    'action' => $action,
                    'amount' => $amount,
                    'note' => $note
                ]);

                return redirect()
                    ->route('admin.manage-users')
                    ->with('success', 
                        "Saldo {$user->name} berhasil diperbarui: " .
                        "Rp " . number_format($oldBalance, 0, ',', '.') . " → " .
                        "Rp " . number_format($newBalance, 0, ',', '.')
                    );
            });
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.manage-users')
                ->with('error', "Gagal update saldo: " . $e->getMessage());
        }
    }

    /**
     * Update password user - FIXED
     */
    public function updatePassword(Request $request, User $user): RedirectResponse
    {
        try {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user->password = Hash::make($request->password);
            $user->save();

            \Log::info("Password updated by admin", [
                'admin_id' => auth()->id(),
                'user_id' => $user->id,
                'user_name' => $user->name
            ]);

            return redirect()
                ->route('admin.manage-users')
                ->with('success', "Password {$user->name} berhasil diubah.");
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.manage-users')
                ->with('error', "Gagal update password: " . $e->getMessage());
        }
    }

    /**
     * Soft delete user - FIXED (gunakan route dengan /delete)
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        try {
            if (auth()->id() === $user->id) {
                return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
            }

            $userName = $user->name;
            $user->delete();

            \Log::info("User soft deleted", [
                'admin_id' => auth()->id(),
                'user_id' => $user->id,
                'user_name' => $userName
            ]);

            return redirect()
                ->route('admin.manage-users')
                ->with('success', "User {$userName} berhasil di-soft delete.");
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.manage-users')
                ->with('error', "Gagal menghapus user: " . $e->getMessage());
        }
    }

    /**
     * Tampilkan user yang sudah dihapus (soft delete)
     */
    public function deletedUsers(): View
    {
        $deletedUsers = User::onlyTrashed()
            ->with(['points' => function($query) {
                $query->orderBy('created_at', 'desc')->limit(5);
            }])
            ->orderBy('deleted_at', 'desc')
            ->paginate(200);

        return view('admin.user_delete', compact('deletedUsers'));
    }

    /**
     * Restore user dari soft delete
     */
    public function restore($id): RedirectResponse
    {
        try {
            $user = User::onlyTrashed()->findOrFail($id);
            $userName = $user->name;
            $user->restore();

            \Log::info("User restored", [
                'admin_id' => auth()->id(),
                'user_id' => $user->id,
                'user_name' => $userName
            ]);

            return redirect()
                ->route('admin.users.deleted')
                ->with('success', "User {$userName} berhasil direstore.");
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.deleted')
                ->with('error', "Gagal restore user: " . $e->getMessage());
        }
    }

    /**
     * Permanent delete user - FIXED
     */
    public function forceDestroy($id): RedirectResponse
    {
        try {
            $user = User::onlyTrashed()->findOrFail($id);
            if (!$user) {
                return redirect()
                    ->route('admin.users.deleted')
                    ->with('error', 'User tidak ditemukan.');
            }
            
            $userName = $user->name;
            $userId = $user->id;
            
            // Backup data sebelum dihapus
            $userData = [
                'id' => $userId,
                'name' => $userName,
                'email' => $user->email,
                'whatsapp' => $user->whatsapp,
                'nama_tele' => $user->nama_tele,
                'role' => $user->role,
                'saldo' => $user->saldo,
                'last_order_at' => $user->last_order_at,
                'deleted_at' => now(),
                'permanently_deleted_at' => now(),
                'deleted_by_admin_id' => auth()->id()
            ];
            
            \Log::info("User permanently deleted - Backup", $userData);
            
            // Hapus permanent
            $user->forceDelete();

            \Log::warning("User permanently deleted", [
                'admin_id' => auth()->id(),
                'user_id' => $userId,
                'user_name' => $userName
            ]);

            return redirect()
                ->route('admin.users.deleted')
                ->with('success', "User {$userName} berhasil dihapus permanent.");
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.deleted')
                ->with('error', "Gagal menghapus permanent: " . $e->getMessage());
        }
    }

    /**
     * Manual trigger auto delete
     */
    public function triggerAutoDelete(): RedirectResponse
    {
        try {
            $result = User::autoDeleteInactiveUsers();
            
            \Log::info("Auto delete triggered manually", [
                'admin_id' => auth()->id(),
                'result' => $result
            ]);

            return redirect()
                ->route('admin.manage-users')
                ->with('success', 
                    "Auto delete selesai: " .
                    "{$result['soft_deleted']} user di-soft delete, " .
                    "{$result['permanent_deleted']} user dihapus permanent."
                );
                
        } catch (\Exception $e) {
            \Log::error("Auto delete failed", [
                'error' => $e->getMessage(),
                'admin_id' => auth()->id()
            ]);

            return redirect()
                ->route('admin.manage-users')
                ->with('error', "Auto delete gagal: " . $e->getMessage());
        }
    }

    /**
     * Edit data user (nama, telegram, whatsapp) - FIXED
     */
    public function updateData(Request $request, User $user): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'nama_tele' => ['required', 'string', 'max:50'],
            'whatsapp' => ['required', 'string', 'max:20'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.manage-users')
                ->withErrors($validator)
                ->with('error', 'Validasi data gagal.')
                ->withInput();
        }

        try {
            // Simpan data lama untuk logging
            $oldData = [
                'name' => $user->name,
                'nama_tele' => $user->nama_tele,
                'whatsapp' => $user->whatsapp,
                'email' => $user->email
            ];

            // Update data
            $user->name = $request->name;
            $user->nama_tele = $request->nama_tele;
            $user->whatsapp = $request->whatsapp;
            
            // Email akan otomatis terupdate via model boot
            $user->save();

            \Log::info("User data updated", [
                'admin_id' => auth()->id(),
                'user_id' => $user->id,
                'old_data' => $oldData,
                'new_data' => [
                    'name' => $user->name,
                    'nama_tele' => $user->nama_tele,
                    'whatsapp' => $user->whatsapp,
                    'email' => $user->email
                ]
            ]);

            return redirect()
                ->route('admin.manage-users')
                ->with('success', "Data {$user->name} berhasil diperbarui.");
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.manage-users')
                ->with('error', "Gagal update data: " . $e->getMessage());
        }
    }

    /**
     * Get detailed points data for modal - FIXED
     */
    public function getPointDetails(User $user)
    {
        try {
            // Current month points
            $currentMonth = Point::where('user_id', $user->id)
                ->where('month', now()->month)
                ->where('year', now()->year)
                ->first();

            // Lifetime points
            $lifetimePoints = Point::where('user_id', $user->id)->sum('points');

            // History (6 bulan terakhir)
            $history = Point::where('user_id', $user->id)
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->limit(6)
                ->get()
                ->map(function ($point) use ($user) {
                    // Calculate ranking for this month
                    $ranking = Point::getUserRank($point->month, $point->year, $user->id);
                    
                    return [
                        'month' => $point->month,
                        'year' => $point->year,
                        'points' => $point->points,
                        'total_items' => $point->total_items,
                        'rank' => $ranking
                    ];
                });

            // Current ranking
            $currentRanking = Point::getUserRank(now()->month, now()->year, $user->id);

            return response()->json([
                'success' => true,
                'data' => [
                    'current_month' => [
                        'points' => $currentMonth->points ?? 0,
                        'total_items' => $currentMonth->total_items ?? 0,
                        'month' => now()->month,
                        'year' => now()->year
                    ],
                    'lifetime' => $lifetimePoints,
                    'ranking' => $currentRanking,
                    'history' => $history
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail points: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search users by name, email, or telegram
     */
    public function search(Request $request): View
    {
        $search = $request->query('q', '');
        
        $users = User::whereNull('deleted_at')
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('nama_tele', 'like', "%{$search}%")
                      ->orWhere('whatsapp', 'like', "%{$search}%");
                });
            })
            ->with(['points' => function($query) {
                $query->where('month', now()->month)
                      ->where('year', now()->year);
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(100)
            ->appends(['q' => $search]);

        $totalUsers = User::whereNull('deleted_at')->count();
        
        $activeResellers = User::whereNull('deleted_at')
            ->where('role', 'reseller')
            ->where('last_order_at', '>=', now()->subDays(30))
            ->count();
            
        $inactiveUsers = User::whereNull('deleted_at')
            ->where('role', '!=', 'admin')
            ->where(function($query) {
                $query->where('last_order_at', '<', now()->subDays(30))
                      ->orWhereNull('last_order_at');
            })
            ->count();
            
        $avgPoints = (int) Point::where('year', now()->year)
            ->avg('points') ?? 0;

        return view('admin.manage_users', compact(
            'users', 
            'totalUsers', 
            'activeResellers', 
            'inactiveUsers',
            'avgPoints',
            'search'
        ));
    }

    /**
     * Reset username change timer for user
     */
    public function resetUsernameTimer(User $user): RedirectResponse
    {
        try {
            $user->last_username_change = now()->subDays(100); // Set ke masa lalu
            $user->save();
            
            \Log::info("Username timer reset", [
                'admin_id' => auth()->id(),
                'user_id' => $user->id,
                'user_name' => $user->name,
                'reset_time' => now()
            ]);
            
            return back()->with('success', 'Timer perubahan username untuk ' . $user->name . ' telah direset!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal reset timer username: ' . $e->getMessage());
        }
    }

    /**
     * Reset password change timer for user
     */
    public function resetPasswordTimer(User $user): RedirectResponse
    {
        try {
            $user->last_password_change = now()->subDays(100); // Set ke masa lalu
            $user->save();
            
            \Log::info("Password timer reset", [
                'admin_id' => auth()->id(),
                'user_id' => $user->id,
                'user_name' => $user->name,
                'reset_time' => now()
            ]);
            
            return back()->with('success', 'Timer perubahan password untuk ' . $user->name . ' telah direset!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal reset timer password: ' . $e->getMessage());
        }
    }
    
    /**
     * Get user change status info for admin
     */
    public function getChangeStatus(User $user)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => [
                    'username' => [
                        'can_change' => $user->canChangeUsername(),
                        'next_change' => $user->getRemainingTimeForChange('username'),
                        'last_change' => $user->last_username_change ? $user->last_username_change->format('Y-m-d H:i:s') : null,
                    ],
                    'password' => [
                        'can_change' => $user->canChangePassword(),
                        'next_change' => $user->getRemainingTimeForChange('password'),
                        'last_change' => $user->last_password_change ? $user->last_password_change->format('Y-m-d H:i:s') : null,
                    ],
                    'role' => $user->role,
                    'rules' => [
                        'admin' => 'Bebas kapan saja',
                        'reseller' => '7 hari sekali',
                        'guest' => '14 hari sekali',
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil status perubahan: ' . $e->getMessage()
            ], 500);
        }
    }
}