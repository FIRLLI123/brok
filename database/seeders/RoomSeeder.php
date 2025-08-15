<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Kost;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all approved kost
        $kosts = Kost::where('admin_approved', true)->where('is_active', true)->get();

        foreach ($kosts as $kost) {
            // Create 3 rooms for each kost
            for ($i = 1; $i <= 3; $i++) {
                Room::create([
                    'kost_id' => $kost->id,
                    'room_number' => $i,
                    'description' => 'Kamar ' . $i . ' dengan kamar mandi dalam, AC, dan WiFi',
                    'price' => $kost->price + (($i - 1) * 100000), // Slight price variation
                    'is_available' => true,
                ]);
            }
        }
    }
} 