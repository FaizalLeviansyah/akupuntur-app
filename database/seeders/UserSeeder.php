<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@lkpmandiri.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
        ]);

        // Akun Praktisi / Akupunkturis
        User::create([
            'name' => 'Dr. Praktisi Utama',
            'email' => 'praktisi@lkpmandiri.com',
            'password' => Hash::make('password123'),
            'role' => 'praktisi',
        ]);
    }
}
