<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /**
         * Rate limit register (punya kamu, TETAP)
         */
        RateLimiter::for('register-ip', function (Request $request) {
            return Limit::perMinutes(2880, 3)
                ->by($request->ip());
        });

        /**
         * FLAG GLOBAL DEVTOOLS PROTECTION
         * cukup 1 kali set di sini
         */
        View::share('devtoolsProtection', true);
    }
}
