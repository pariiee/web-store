<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Default Inspire Command
|--------------------------------------------------------------------------
*/
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})
->purpose('Display an inspiring quote')
->hourly();

/*
|--------------------------------------------------------------------------
| Scheduler Tasks (Laravel 11)
|--------------------------------------------------------------------------
*/

// 🔐 Backup database setiap hari jam 00:00
Schedule::command('db:backup')
    ->dailyAt('00:00')
    ->timezone('Asia/Jakarta')
    ->description('Daily database backup & send to Telegram');

// (OPSIONAL) cek scheduler jalan
Schedule::call(function () {
    logger('Scheduler running at ' . now());
})->daily();
