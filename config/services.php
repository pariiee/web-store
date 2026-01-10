<?php

return [

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

'github' => [
    'webhook_secret' => env('GITHUB_WEBHOOK_SECRET'),
],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

  
    'telegram' => [
        'bot_token' => env('TELEGRAM_BOT_TOKEN'),
        'gc_admin'  => env('TELEGRAM_GC_ADMIN'),
        'gc_logs'   => env('TELEGRAM_GC_LOGS'),
        'gc_daftar' => env('TELEGRAM_GC_DAFTAR'),
    ],

];
