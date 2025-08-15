<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a user and some rooms
        $user = User::where('role', 'user')->first();
        $rooms = Room::take(3)->get();

        if ($user && $rooms->isNotEmpty()) {
            foreach ($rooms as $index => $room) {
                // Create past bookings (completed)
                Booking::create([
                    'user_id' => $user->id,
                    'room_id' => $room->id,
                    'start_date' => Carbon::now()->subDays(30 + ($index * 10)),
                    'end_date' => Carbon::now()->subDays(5 + ($index * 10)),
                    'total_price' => $room->price * 2,
                    'status' => 'approved',
                ]);

                // Create current booking (ongoing)
                Booking::create([
                    'user_id' => $user->id,
                    'room_id' => $room->id,
                    'start_date' => Carbon::now()->subDays(5),
                    'end_date' => Carbon::now()->addDays(25),
                    'total_price' => $room->price * 2,
                    'status' => 'approved',
                ]);
            }
        }
    }
} 