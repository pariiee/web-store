<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function showUserPoints(User $user)
    {
        $points = $user->points()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->paginate(12);
        
        return view('admin.user_points', compact('user', 'points'));
    }
    
    public function resetPoints(Request $request, User $user)
    {
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2023',
        ]);
        
        $point = $user->points()
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->first();
        
        if ($point) {
            $point->delete();
            return back()->with('success', 'Points berhasil direset.');
        }
        
        return back()->with('error', 'Data point tidak ditemukan.');
    }
}