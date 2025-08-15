<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081111111111',
            'address' => 'Admin Street 1',
            'is_active' => true,
        ]);

        // Create a Mitra user
        User::create([
            'name' => 'Mitra Demo',
            'email' => 'mitra@example.com',
            'password' => Hash::make('password'),
            'role' => 'mitra',
            'phone' => '082222222222',
            'address' => 'Mitra Street 2',
            'is_active' => true,
        ]);

        // Create a standard User
        User::create([
            'name' => 'Pengguna Demo',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '083333333333',
            'address' => 'User Street 3',
            'is_active' => true,
        ]);
    }
}
