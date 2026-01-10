<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat/Update Admin
        $namaTele = 'pardevv';
        $cleanUsername = preg_replace('/[^a-zA-Z0-9]/', '', $namaTele);
        $email = strtolower($cleanUsername) . '@ayastore.com';
        
        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin PARI ID',
                'whatsapp' => '6281234567890',
                'nama_tele' => $namaTele,
                'role' => 'admin',
                'password' => bcrypt('Admin123.'),
                'saldo' => 1000000,
                'profile_photo' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
          
        // 2. Update user yang sudah ada untuk menambahkan nama_tele
        $users = User::whereNull('nama_tele')->get();
        
        foreach ($users as $user) {
            // Jika user adalah admin backup atau user lama
            if ($user->email === 'gabutmen5@gmail.com') {
                $user->update(['nama_tele' => 'gabutmen']);
                continue;
            }
            
            // Generate username dari nama (untuk user lama)
            $usernameFromName = Str::slug($user->name, '');
            $username = preg_replace('/[^a-zA-Z0-9]/', '', $usernameFromName);
            
            // Jika username kosong, gunakan ID
            if (empty($username)) {
                $username = 'user' . $user->id;
            }
            
            // Pastikan username unik
            $baseUsername = $username;
            $counter = 1;
            while (User::where('nama_tele', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }
            
            // Update user
            $user->update([
                'nama_tele' => $username,
                // Email akan di-update otomatis oleh Model boot() method
            ]);
        }
        
        $this->command->info('Admin created and existing users updated successfully!');
        $this->command->info('Total users updated: ' . $users->count());
    }
}