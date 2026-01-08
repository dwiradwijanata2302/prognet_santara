<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 5 akun admin dengan password mudah diingat
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Admin Santara {$i}",
                'email' => "admin{$i}@santara.com",
                'password' => Hash::make("admin@santara{$i}"),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        // Dummy user untuk testing (optional)
        User::create([
            'name' => 'Pembaca Demo',
            'email' => 'demo@santara.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}