<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kost;
use App\Models\User;

class KostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a mitra user
        $mitra = User::where('role', 'mitra')->first();
        
        if (!$mitra) {
            $mitra = User::create([
                'name' => 'Mitra Test',
                'email' => 'mitra@test.com',
                'password' => bcrypt('password'),
                'role' => 'mitra',
                'email_verified_at' => now(),
            ]);
        }

        // Create sample kost data
        $kosts = [
            [
                'name' => 'Kost Sejahtera',
                'description' => 'Kost nyaman dengan fasilitas lengkap, dekat dengan transportasi umum dan pusat perbelanjaan.',
                'address' => 'Jl. Sudirman No. 123',
                'city' => 'Jakarta',
                'price' => 1500000,
                'user_id' => $mitra->id,
                'admin_approved' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Kost Harmoni',
                'description' => 'Kost modern dengan kamar mandi dalam, AC, dan WiFi gratis.',
                'address' => 'Jl. Thamrin No. 45',
                'city' => 'Jakarta',
                'price' => 2000000,
                'user_id' => $mitra->id,
                'admin_approved' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Kost Bandung Indah',
                'description' => 'Kost dengan view pegunungan, lingkungan yang asri dan tenang.',
                'address' => 'Jl. Asia Afrika No. 67',
                'city' => 'Bandung',
                'price' => 1200000,
                'user_id' => $mitra->id,
                'admin_approved' => true,
                'is_active' => true,
            ],
        ];

        foreach ($kosts as $kostData) {
            Kost::create($kostData);
        }
    }
} 