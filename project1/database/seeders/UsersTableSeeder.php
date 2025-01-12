<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Create Staff
        User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('password123'),
            'role' => 'staff'
        ]);

        // Create some Academicians
        User::create([
            'name' => 'Dr. John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'role' => 'academician'
        ]);

        User::create([
            'name' => 'Dr. Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'role' => 'academician'
        ]);
    }
}
