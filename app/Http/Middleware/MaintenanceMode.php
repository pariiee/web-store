<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::find(1);

        // kalau belum ada setting
        if (!$setting || !$setting->maintenance) {
            return $next($request);
        }

        // ADMIN LOGIN BOLEH LEWAT
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // SEMUA USER LAIN KENA
        abort(503); // lebih cocok untuk maintenance
    }
}
