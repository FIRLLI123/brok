<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;

class UpdateRoomAvailability extends Command
{
    protected $signature = 'rooms:update-availability';
    protected $description = 'Update room availability based on booking dates';

    public function handle()
    {
        $today = Carbon::today();

        // Get all approved bookings
        $bookings = Booking::where('status', 'approved')->get();

        foreach ($bookings as $booking) {
            $startDate = Carbon::parse($booking->start_date);
            $endDate = Carbon::parse($booking->end_date);
            $room = $booking->room;

            if (!$room) continue;

            if ($today->lt($startDate)) {
                // Before start date: is_available = 2 (Dipesan)
                if ($room->is_available != 2) {
                    $room->update(['is_available' => 2]);
                    $this->info("Room {$room->room_number} set to Dipesan (booking starts {$startDate->format('Y-m-d')})");
                }
            } elseif ($today->gte($startDate) && $today->lte($endDate)) {
                // During booking period: is_available = 3 (Terisi)
                if ($room->is_available != 3) {
                    $room->update(['is_available' => 3]);
                    $this->info("Room {$room->room_number} set to Terisi ({$today->format('Y-m-d')} within {$startDate->format('Y-m-d')} - {$endDate->format('Y-m-d')})");
                }
            } elseif ($today->gt($endDate)) {
                // After end date: is_available = 1 (Tersedia)
                if ($room->is_available != 1) {
                    $room->update(['is_available' => 1]);
                    $this->info("Room {$room->room_number} set to Tersedia (booking ended {$endDate->format('Y-m-d')})");
                }
            }
        }

        $this->info('Room availability update completed.');
    }
}
