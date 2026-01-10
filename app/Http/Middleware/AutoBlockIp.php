<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AutoBlockIp
{
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();

        // Cek IP diblokir
        if (Cache::has("blocked_ip:$ip")) {
            abort(429, 'IP blocked for 30 days');
        }

        // Hitung request per menit
        $key = "rate_ip:$ip";
        $count = Cache::increment($key);
        Cache::put($key, $count, now()->addMinute());

        if ($count > 200) {
            Cache::put("blocked_ip:$ip", true, now()->addDays(30));
            Cache::forget($key);

            $this->notifyTelegram($ip);
            abort(429, 'Too many requests');
        }

        return $next($request);
    }

    protected function notifyTelegram(string $ip): void
    {
        Http::post(
            "https://api.telegram.org/bot".env('TELEGRAM_BOT_TOKEN')."/sendMessage",
            [
                'chat_id' => env('TELEGRAM_BOT_ADMIN'),
                'text'    => "🚫 IP AUTO BLOCKED\n\nIP: {$ip}\nDurasi: 30 hari",
            ]
        );
    }
}
