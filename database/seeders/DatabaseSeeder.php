<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun admin
        User::create([
            'name' => 'Admin',
            'email' => 'tegarprawira350@gmail.com',
            'password' => 'admin123', // Pastikan password ter-hash
            'role' => 'admin', // Menetapkan role admin
        ]);

        // Membuat akun ketua yayasan
        User::create([
            'name' => 'Ketua Yayasan',
            'email' => 'ketuayayasan@example.com',
            'password' => 'ketuayayasan123', // Pastikan password ter-hash
            'role' => 'ketua_yayasan', // Menetapkan role ketua yayasan
        ]);

        // Membuat akun user biasa
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => 'user123', // Pastikan password ter-hash
            'role' => 'user', // Menetapkan role user
        ]);
    }
}
