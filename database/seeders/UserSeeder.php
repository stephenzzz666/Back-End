<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Using updateOrCreate ensures we don't get "Email already exists" errors
        User::updateOrCreate(
            ['email' => 'steph@gmail.com'], // Find by this
            [
                'name' => 'Admin User',
                'password' => Hash::make('123'), // Securely hash the password
            ]
        );
    }
}