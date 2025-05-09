<?php

// database/seeders/DatabaseSeeder.php

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
            'email' => 'admin@example.com',
            'password' =>'admin123',  
            'is_admin' => true,
        ]);

        // Membuat akun user biasa
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' =>'user123',  
            'is_admin' => false,
        ]);
    }
}
