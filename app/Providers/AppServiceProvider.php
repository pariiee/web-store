<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Console\Commands\MakeDeployScript;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // DAFTAR COMMAND ARTISAN (LARAVEL 11)
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeDeployScript::class,
            ]);
        }
    }

    public function boot(): void
    {
        /**
         * Rate limit register
         */
        RateLimiter::for('register-ip', function (Request $request) {
            return Limit::perMinutes(2880, 3)->by($request->ip());
        });

        /**
         * Global flag devtools protection
         */
        View::share('devtoolsProtection', true);
    }
}
