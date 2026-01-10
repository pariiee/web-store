<?php
// app/Http/Controllers/Admin/RedeemController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RedeemCode;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RedeemController extends Controller
{
    public function index()
    {
        $codes = RedeemCode::withCount('claims')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.redeem.index', compact('codes'));
    }

    public function create()
    {
        $items = Item::withCount('stocks')->get();
        return view('admin.redeem.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:saldo,stock',
            'distribution_type' => 'required_if:type,saldo|in:rata,acak',
            'code' => 'nullable|string|max:10',
            'nominal_saldo' => 'required_if:type,saldo|nullable|integer|min:1',
            'max_users'   => 'required_if:type,saldo|nullable|integer|min:1',
            'item_id'     => 'required_if:type,stock|nullable|exists:items,id',
            'total_stock' => 'required_if:type,stock|nullable|integer|min:1',
        ]);

        $code = strtoupper($request->code ?: $this->generateCode());

        if (RedeemCode::where('code', $code)->exists()) {
            return back()->with('error', 'Kode sudah digunakan')->withInput();
        }

        $data = [
            'code' => $code,
            'type' => $request->type,
            'distribution_type' => $request->distribution_type,
        ];

        if ($request->type === 'saldo') {
            $data['max_users'] = $request->max_users;
            
            if ($request->distribution_type === 'rata') {
                // RATA: Setiap user dapat nominal_saldo yang SAMA
                // Total saldo = nominal_saldo × max_users
                $nominalPerUser = $request->nominal_saldo;
                $totalSaldo = $nominalPerUser * $request->max_users;
                $data['total_saldo'] = $totalSaldo;
                $data['per_user_saldo'] = $this->equalDistribution(
                    $nominalPerUser,
                    $request->max_users
                );
            } else {
                // ACAK: Total saldo = nominal_saldo
                // Dibagi acak ke max_users user
                $data['total_saldo'] = $request->nominal_saldo;
                $data['per_user_saldo'] = $this->randomDistribution(
                    $request->nominal_saldo,
                    $request->max_users
                );
            }
        }

        if ($request->type === 'stock') {
            $data['item_id'] = $request->item_id;
            $data['total_stock'] = $request->total_stock;
        }

        RedeemCode::create($data);

        return redirect()->route('admin.redeem.index')
            ->with('success', 'Kode redeem berhasil dibuat!');
    }

    public function show(RedeemCode $redeem)
    {
        $redeem->load(['claims.user']);
        return view('admin.redeem.show', ['code' => $redeem]);
    }

    public function destroy(RedeemCode $redeem)
    {
        DB::transaction(function () use ($redeem) {
            DB::table('redeem_claims')
                ->where('redeem_code_id', $redeem->id)
                ->update(['redeem_code_id' => null]);

            DB::table('redeem_codes')
                ->where('id', $redeem->id)
                ->delete();
        });

        return redirect()->route('admin.redeem.index')
            ->with('success', 'Kode redeem dihapus.');
    }

    // ================= UTIL =================

    private function generateCode(int $length = 6): string
    {
        return substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 5)), 0, $length);
    }

    /**
     * Distribusi Rata - setiap user dapat nominal_saldo yang SAMA
     */
    private function equalDistribution(int $nominalPerUser, int $n): array
    {
        // Setiap user dapat nominal yang sama
        return array_fill(0, $n, $nominalPerUser);
    }

    /**
     * Distribusi Acak - total saldo (nominal_saldo) dibagi acak ke semua user
     */
    private function randomDistribution(int $totalSaldo, int $n): array
    {
        if ($n === 1) return [$totalSaldo];
        
        if ($totalSaldo < $n) {
            // Jika total kurang dari jumlah user, beri 1 ke beberapa user pertama
            $distribution = array_fill(0, $totalSaldo, 1);
            $distribution = array_pad($distribution, $n, 0);
            shuffle($distribution);
            return $distribution;
        }
        
        // Setiap user minimal dapat 1
        $distribution = array_fill(0, $n, 1);
        $remaining = $totalSaldo - $n;
        
        if ($remaining <= 0) {
            shuffle($distribution);
            return $distribution;
        }
        
        // Bagikan sisa secara acak
        for ($i = 0; $i < $remaining; $i++) {
            $randomUser = rand(0, $n - 1);
            $distribution[$randomUser]++;
        }
        
        shuffle($distribution);
        
        return $distribution;
    }
}