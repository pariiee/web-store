<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * $roles bisa string tunggal atau array role yang diizinkan.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            // tidak login
            abort(403, 'Anda tidak memiliki akses.');
        }

        if (! in_array($user->role, $roles)) {
            abort(403, 'Anda tidak memiliki hak akses yang cukup.');
        }

        return $next($request);
    }
}
