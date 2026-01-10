<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InjectDevtoolsScript
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // hanya inject ke HTML
        if (
            $response instanceof Response &&
            str_contains($response->headers->get('Content-Type'), 'text/html')
        ) {
            $content = $response->getContent();

            if (str_contains($content, '</body>')) {
                $script = view('partials.devtools')->render();
                $content = str_replace('</body>', $script . '</body>', $content);
                $response->setContent($content);
            }
        }

        return $response;
    }
}
