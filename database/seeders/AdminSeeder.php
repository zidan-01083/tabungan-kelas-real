<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // akan dicek jika sudah ada
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'), // ganti jika perlu
                'role' => 'admin',
            ]
        );
    }
}
