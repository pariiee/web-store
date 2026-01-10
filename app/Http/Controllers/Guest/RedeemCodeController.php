<?php
// app/Http/Controllers/Guest/RedeemCodeController.php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\RedeemCode;
use App\Models\RedeemClaim;
use App\Models\ItemStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedeemCodeController extends Controller
{
    public function index()
    {
        $claims = RedeemClaim::with('code')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('guest.redeem', compact('claims'));
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user  = Auth::user();
        $input = strtoupper(trim($request->code));

        $code = RedeemCode::where('code', $input)->first();

        if (!$code) {
            return back()->with('error', 'Kode redeem tidak ditemukan.');
        }

        $already = RedeemClaim::where('redeem_code_id', $code->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($already) {
            return back()->with('error', 'Kamu sudah menggunakan kode ini.');
        }

        $claimed = RedeemClaim::where('redeem_code_id', $code->id)->count();

        // ==================== SALDO ====================
        if ($code->type === 'saldo') {

            if ($claimed >= $code->max_users) {
                return back()->with('error', 'Kuota kode saldo ini sudah habis.');
            }

            $parts = $code->per_user_saldo ?? [];

            $amount = $parts[$claimed] ?? null;

            if (!$amount || $amount == 0) {
                // Untuk distribusi acak, mungkin ada user yang dapat 0
                return back()->with('error', 'Tidak ada saldo yang tersisa untuk klaim ini.');
            }

            $user->saldo += $amount;
            $user->save();

            RedeemClaim::create([
                'redeem_code_id' => $code->id,
                'user_id'        => $user->id,
                'reward_type'    => 'saldo',
                'saldo_awarded'  => $amount,
            ]);

            if ($claimed + 1 >= $code->max_users) {
                $code->delete();
            }

            return back()->with('success', 'Berhasil! Kamu mendapatkan saldo Rp ' . number_format($amount, 0, ',', '.'));
        }

        // ==================== STOCK ====================
        if ($code->type === 'stock') {

            if ($claimed >= $code->total_stock) {
                return back()->with('error', 'Stock untuk kode ini sudah habis.');
            }

            if (!$code->item_id) {
                return back()->with('error', 'Kode stock ini tidak terhubung ke item manapun.');
            }

            $stock = ItemStock::where('item_id', $code->item_id)
                ->orderBy('id')
                ->first();

            if (!$stock) {
                return back()->with('error', 'Stock item sudah habis.');
            }

            $raw = $stock->data;
            if (!is_array($raw)) {
                $raw = [$raw];
            }

            $displayText = implode("\n", $raw);

            $stock->delete();

            RedeemClaim::create([
                'redeem_code_id' => $code->id,
                'user_id'        => $user->id,
                'reward_type'    => 'stock',
                'stock_awarded'  => 1,
                'data_stock'     => $raw,
            ]);

            if ($claimed + 1 >= $code->total_stock) {
                $code->delete();
            }

            return back()->with('success_stock', $displayText);
        }

        return back()->with('error', 'Tipe kode tidak dikenal.');
    }
}