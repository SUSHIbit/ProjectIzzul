<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'mimin@gmail.com',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
        ]);

        // Create lecturer users
        User::create([
            'name' => 'Lecturer One',
            'email' => 'lecturer1@gmail.com',
            'password' => Hash::make('123456789'),
            'role' => 'lecturer',
        ]);

        User::create([
            'name' => 'Lecturer Two',
            'email' => 'lecturer2@gmail.com',
            'password' => Hash::make('123456789'),
            'role' => 'lecturer',
        ]);
    }
}