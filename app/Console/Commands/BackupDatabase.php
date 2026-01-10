<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Backup database & send to Telegram';

    public function handle()
    {
        $db   = config('database.connections.mysql.database');
        $user = config('database.connections.mysql.username');
        $pass = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $file = storage_path('app/db_backup_' . now()->format('Y-m-d_H-i') . '.sql');

        exec("mysqldump -h{$host} -u{$user} -p{$pass} {$db} > {$file}");

        Http::attach(
            'document',
            file_get_contents($file),
            basename($file)
        )->post(
            "https://api.telegram.org/bot".env('TELEGRAM_BOT_TOKEN')."/sendDocument",
            [
                'chat_id' => env('TELEGRAM_BOT_ADMIN'),
                'caption' => '✅ Backup DB ' . now(),
            ]
        );

        unlink($file);

        $this->info('Backup sent to Telegram');
    }
}
