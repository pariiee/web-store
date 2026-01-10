<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\MaintenanceMode;
use App\Http\Middleware\AutoBlockIp;
use App\Http\Middleware\InjectDevtoolsScript;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // GLOBAL MIDDLEWARE
        $middleware->append([
            AutoBlockIp::class,
            InjectDevtoolsScript::class,
        ]);

        // ALIAS
        $middleware->alias([
            'role'        => CheckRole::class,
            'maintenance' => MaintenanceMode::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
