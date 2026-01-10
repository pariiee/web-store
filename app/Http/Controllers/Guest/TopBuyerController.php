<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TopBuyerController extends Controller
{
    /**
     * Tampilkan halaman top 100 buyer
     */
    public function index(Request $request): View
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        // Ambil data ranking untuk bulan ini
        $topBuyers = Point::with(['user' => function($query) {
                $query->select('id', 'name', 'profile_photo');
            }])
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->orderBy('points', 'desc')
            ->orderBy('total_items', 'desc')
            ->limit(10)
            ->get();
        
        // Hitung total poin semua user (bukan total user count)
        $totalAllPoints = Point::where('month', $currentMonth)
            ->where('year', $currentYear)
            ->sum('points');
        
        // Hitung total semua user yang aktif
        $totalAllUsers = User::whereNull('deleted_at')->count();
        
        // Format bulan
        $bulanIndonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        $currentMonthName = $bulanIndonesia[$currentMonth] ?? 'Bulan';
        
        return view('guest.top-buyers', [
            'topBuyers' => $topBuyers,
            'currentMonth' => $currentMonthName,
            'currentYear' => $currentYear,
            'totalAllPoints' => $totalAllPoints,
            'totalAllUsers' => $totalAllUsers
        ]);
    }
}