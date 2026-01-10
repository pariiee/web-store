<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TopupTransaction;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ===============================
        // HITUNG ROLE USER
        // ===============================
        $totalReseller = User::where('role', 'reseller')->count();
        $totalGuest    = User::where('role', 'guest')->count();

        // ===============================
        // TOPUP BULAN INI
        // ===============================
        $start = now()->startOfMonth();
        $end   = now()->endOfMonth();

        $topup = TopupTransaction::where('status', 'paid')
            ->whereBetween('created_at', [$start, $end]);

        $totalTopupNominal = $topup->sum('amount');
        $totalTopupCount   = $topup->count();

        // ===============================
        // TRANSAKSI PEMBELIAN BULAN INI
        // ===============================
        $trx = Transaction::whereBetween('created_at', [$start, $end]);

        $totalTransaksi    = $trx->count();
        $totalPemasukanTrx = $trx->sum('total_amount');

        // ==========================================================
        // 📊 STATISTIK 7 HARI
        // ==========================================================
        $days7 = collect(range(0, 6))->map(fn($i) => now()->subDays($i)->format('Y-m-d'))
                                     ->reverse()
                                     ->values();

        $guest7 = [];
        $reseller7 = [];

        foreach ($days7 as $day) {
            $guest7[] = Transaction::whereDate('created_at', $day)
                                   ->where('role_at_purchase', 'guest')
                                   ->count();

            $reseller7[] = Transaction::whereDate('created_at', $day)
                                      ->where('role_at_purchase', 'reseller')
                                      ->count();
        }

        $days7Formatted = $days7->map(fn($d) => Carbon::parse($d)->format('d M'));

        // ==========================================================
        // 📊 STATISTIK 30 HARI
        // ==========================================================
        $days30 = collect(range(0, 29))->map(fn($i) => now()->subDays($i)->format('Y-m-d'))
                                       ->reverse()
                                       ->values();

        $guest30 = [];
        $reseller30 = [];

        foreach ($days30 as $day) {
            $guest30[] = Transaction::whereDate('created_at', $day)
                                    ->where('role_at_purchase', 'guest')
                                    ->count();

            $reseller30[] = Transaction::whereDate('created_at', $day)
                                       ->where('role_at_purchase', 'reseller')
                                       ->count();
        }

        $days30Formatted = $days30->map(fn($d) => Carbon::parse($d)->format('d M'));

        // ===============================
        // LOG 10 TERBARU
        // ===============================
        $logs = Transaction::with(['items.item', 'user'])
            ->orderByDesc('id')
            ->limit(10)
            ->get();

        // ===============================
        // RETURN KE VIEW
        // ===============================
        return view('admin.dashboard', [
            // STAT KARTU
            'totalReseller'      => $totalReseller,
            'totalGuest'         => $totalGuest,
            'totalTopupNominal'  => $totalTopupNominal,
            'totalTopupCount'    => $totalTopupCount,
            'totalTransaksi'     => $totalTransaksi,
            'totalPemasukanTrx'  => $totalPemasukanTrx,

            // LOG TABLE
            'logs' => $logs,

            // CHART DATA 7 HARI
            'days7'       => $days7Formatted,
            'guest7'      => $guest7,
            'reseller7'   => $reseller7,

            // CHART DATA 30 HARI
            'days30'      => $days30Formatted,
            'guest30'     => $guest30,
            'reseller30'  => $reseller30,
        ]);
    }
}
