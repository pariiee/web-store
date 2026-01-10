<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $attributes = [
        'saldo' => 0,
    ];

    protected $fillable = [
        'name',
        'whatsapp',
        'nama_tele',
        'email',
        'role',
        'saldo',
        'profile_photo',
        'password',
        'last_order_at',
        'last_username_change',
        'last_password_change', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'current_month_points',
        'current_month_items',
        'can_change_username',
        'can_change_password',
        'next_username_change',
        'next_password_change', 
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'saldo' => 'integer',
            'last_order_at' => 'datetime',
            'deleted_at' => 'datetime',
            'last_username_change' => 'datetime',
            'last_password_change' => 'datetime',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!empty($user->nama_tele)) {
                $user->email = $user->generateEmail();
            }
            $user->last_username_change = now();
            $user->last_password_change = now();
        });

        static::updating(function ($user) {
            if ($user->isDirty('nama_tele') && !empty($user->nama_tele)) {
                $user->email = $user->generateEmail();
                
                $user->last_username_change = now();
            }
            
            if ($user->isDirty('password')) {
                $user->last_password_change = now();
            }
        });
    }

    public function generateEmail()
    {
        $cleanUsername = preg_replace('/[^a-zA-Z0-9]/', '', $this->nama_tele);
        return strtolower($cleanUsername) . '@ayastore.com';
    }

    
    public function canChangeUsername(): bool
    {
        if ($this->role === 'admin') {
            return true;
        }
        
        if (!$this->last_username_change) {
            return true;
        }
        
        $daysRequired = $this->role === 'reseller' ? 7 : 14;
        $nextChangeDate = $this->last_username_change->addDays($daysRequired);
        
        return now()->gte($nextChangeDate);
    }
    
    public function canChangePassword(): bool
    {
        if ($this->role === 'admin') {
            return true;
        }
        
        if (!$this->last_password_change) {
            return true;
        }
        
        $daysRequired = $this->role === 'reseller' ? 7 : 14;
        $nextChangeDate = $this->last_password_change->addDays($daysRequired);
        
        return now()->gte($nextChangeDate);
    }
    
    public function getNextUsernameChangeDate(): ?Carbon
    {
        if ($this->role === 'admin') {
            return null;
        }
        
        if (!$this->last_username_change) {
            return now();
        }
        
        $daysRequired = $this->role === 'reseller' ? 7 : 14;
        return $this->last_username_change->copy()->addDays($daysRequired);
    }
    
    public function getNextPasswordChangeDate(): ?Carbon
    {
        if ($this->role === 'admin') {
            return null;
        }
        
        if (!$this->last_password_change) {
            return now();
        }
        
        $daysRequired = $this->role === 'reseller' ? 7 : 14;
        return $this->last_password_change->copy()->addDays($daysRequired);
    }
    
    public function getRemainingTimeForChange(string $type = 'username'): string
    {
        if ($this->role === 'admin') {
            return 'Bisa kapan saja';
        }
        
        $nextDate = $type === 'username' 
            ? $this->getNextUsernameChangeDate()
            : $this->getNextPasswordChangeDate();
        
        if (!$nextDate || now()->gte($nextDate)) {
            return 'Bisa sekarang';
        }
        
        $diff = now()->diff($nextDate);
        
        if ($diff->days > 0) {
            return $diff->days . ' hari lagi';
        } elseif ($diff->h > 0) {
            return $diff->h . ' jam ' . $diff->i . ' menit lagi';
        } else {
            return $diff->i . ' menit lagi';
        }
    }
    
    public function getCanChangeUsernameAttribute(): bool
    {
        return $this->canChangeUsername();
    }
    
    public function getCanChangePasswordAttribute(): bool
    {
        return $this->canChangePassword();
    }
    
    public function getNextUsernameChangeAttribute(): string
    {
        return $this->getRemainingTimeForChange('username');
    }
    
    public function getNextPasswordChangeAttribute(): string
    {
        return $this->getRemainingTimeForChange('password');
    }

    
    public function topups()
    {
        return $this->hasMany(TopupTransaction::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function sentTransfers()
    {
        return $this->hasMany(TransferTransaction::class, 'sender_id');
    }

    public function receivedTransfers()
    {
        return $this->hasMany(TransferTransaction::class, 'receiver_id');
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function getDailyTransferCount()
    {
        return $this->sentTransfers()
            ->whereDate('created_at', today())
            ->where('status', TransferTransaction::STATUS_SUCCESS)
            ->count();
    }

    public function getDailyTransferLimit()
    {
        return match($this->role) {
            'admin' => null,
            'reseller' => 10,
            default => 5,
        };
    }

    public function canTransferToday()
    {
        $dailyLimit = $this->getDailyTransferLimit();
        
        if ($dailyLimit === null) {
            return true;
        }
        
        return $this->getDailyTransferCount() < $dailyLimit;
    }

    public function getDailyTransferRemaining()
    {
        $dailyLimit = $this->getDailyTransferLimit();
        
        if ($dailyLimit === null) {
            return '∞';
        }
        
        $used = $this->getDailyTransferCount();
        $remaining = $dailyLimit - $used;
        
        return max(0, $remaining);
    }

    public function transferSaldo(User $receiver, $amount, $note = null)
    {
        if ($amount < 100) {
            throw new \Exception('Minimal transfer adalah Rp 100');
        }

        if (!$this->canTransferToday()) {
            $dailyLimit = $this->getDailyTransferLimit();
            
            if ($dailyLimit === null) {
            } else {
                $used = $this->getDailyTransferCount();
                
                $roleMessage = match($this->role) {
                    'reseller' => 'Batas transfer harian untuk reseller adalah 10x',
                    default => 'Batas transfer harian untuk guest adalah 5x',
                };
                
                throw new \Exception("$roleMessage. Anda telah melakukan $used transfer hari ini.");
            }
        }

        $adminFee = TransferTransaction::calculateAdminFee($amount);
        $totalDeducted = TransferTransaction::calculateTotalDeducted($amount);

        if ($this->saldo < $totalDeducted) {
            throw new \Exception('Saldo tidak cukup. Total yang diperlukan: Rp ' . number_format($totalDeducted, 0, ',', '.'));
        }

        return DB::transaction(function () use ($receiver, $amount, $adminFee, $totalDeducted, $note) {
            $this->decrement('saldo', $totalDeducted);
            
            $receiver->increment('saldo', $amount);

            $transfer = TransferTransaction::create([
                'sender_id' => $this->id,
                'receiver_id' => $receiver->id,
                'amount' => $amount,
                'admin_fee' => $adminFee,
                'total_deducted' => $totalDeducted,
                'status' => TransferTransaction::STATUS_SUCCESS,
                'note' => $note,
                'transfer_date' => now()
            ]);

            TransactionLog::create([
                'user_id' => $this->id,
                'transfer_id' => $transfer->id,
                'description' => 'TF ke ' . $receiver->name,
                'amount' => -$totalDeducted,
                'type' => TransactionLog::TYPE_TRANSFER_OUT
            ]);

            TransactionLog::create([
                'user_id' => $receiver->id,
                'transfer_id' => $transfer->id,
                'description' => 'TF dari ' . $this->name,
                'amount' => $amount,
                'type' => TransactionLog::TYPE_TRANSFER_IN
            ]);

            return $transfer;
        });
    }

    public function getTransferLimitInfo()
    {
        $dailyLimit = $this->getDailyTransferLimit();
        $used = $this->getDailyTransferCount();
        
        if ($dailyLimit === null) {
            return [
                'limit' => '∞',
                'used' => $used,
                'remaining' => '∞',
                'message' => 'Transfer tidak terbatas'
            ];
        }
        
        $remaining = max(0, $dailyLimit - $used);
        
        return [
            'limit' => $dailyLimit,
            'used' => $used,
            'remaining' => $remaining,
            'message' => "{$remaining}/{$dailyLimit} transfer tersisa"
        ];
    }

    public function getCurrentMonthPoint(): int
    {
        return Point::getCurrentMonthPoint($this->id);
    }

    public function getLifetimePoint(): int
    {
        return Point::getLifetimePoint($this->id);
    }

    public function getPointHistory(int $limit = 6)
    {
        return Point::getUserPointHistory($this->id, $limit);
    }

    public function addPoints(int $itemsBought): void
    {
        Point::updateUserPoint($this->id, $itemsBought);
    }

    public function getCurrentMonthPointsAttribute()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        $point = $this->points()
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->first();
        
        return $point ? $point->points : 0;
    }

    public function getCurrentMonthItemsAttribute()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        $point = $this->points()
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->first();
        
        return $point ? $point->total_items : 0;
    }

    public function getPointsHistory($year = null)
    {
        $query = $this->points();
        
        if ($year) {
            $query->where('year', $year);
        }
        
        return $query->orderBy('year', 'desc')
                     ->orderBy('month', 'desc')
                     ->get();
    }

    public static function autoDeleteInactiveUsers()
    {
        $usersToSoftDelete = self::where('role', '!=', 'admin')
            ->where(function($query) {
                $query->where('saldo', '<', 10000)
                      ->orWhereNull('saldo');
            })
            ->where(function($query) {
                $query->where('last_order_at', '<', now()->subDays(30))
                      ->orWhereNull('last_order_at');
            })
            ->whereNull('deleted_at')
            ->get();

        foreach ($usersToSoftDelete as $user) {
            $user->delete();
            \Log::info("Auto soft deleted user: {$user->id} - {$user->name}");
        }

        $usersToPermanentDelete = self::onlyTrashed()
            ->where('deleted_at', '<', now()->subDays(7))
            ->get();

        foreach ($usersToPermanentDelete as $user) {
            $user->forceDelete();
            \Log::info("Permanently deleted user after 7 days: {$user->id} - {$user->name}");
        }

        return [
            'soft_deleted' => $usersToSoftDelete->count(),
            'permanent_deleted' => $usersToPermanentDelete->count()
        ];
    }
}