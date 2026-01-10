<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDeployScript extends Command
{
    protected $signature = 'deploy:script {path=/var/www/store.parie.site}';
    protected $description = 'Generate deploy.sh script';

    public function handle()
    {
        $path = rtrim($this->argument('path'), '/');
        $file = $path . '/deploy.sh';

        if (File::exists($file)) {
            $this->error('deploy.sh already exists!');
            return Command::FAILURE;
        }

        $content = <<<BASH
#!/bin/bash

set -e

cd {$path} || exit 1

echo "Pulling latest code..."
git pull origin main

echo "Installing dependencies..."
composer install --no-dev --optimize-autoloader

echo "Running migrations..."
php artisan migrate --force

echo "Optimizing..."
php artisan optimize

echo "Deployment finished successfully"
BASH;

        File::put($file, $content);
        chmod($file, 0755);

        $this->info("deploy.sh created at {$file}");
        return Command::SUCCESS;
    }
}
