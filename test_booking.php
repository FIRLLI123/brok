<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Booking;
use App\Models\Kost;
use App\Models\Room;
use App\Models\User;

echo "Testing Kost model...\n";
try {
    $kostCount = Kost::count();
    echo "Kost count: $kostCount\n";
} catch (Exception $e) {
    echo "Error with Kost: " . $e->getMessage() . "\n";
}

echo "\nTesting Room model...\n";
try {
    $roomCount = Room::count();
    echo "Room count: $roomCount\n";
} catch (Exception $e) {
    echo "Error with Room: " . $e->getMessage() . "\n";
}

echo "\nTesting Booking with relations...\n";
try {
    $bookings = Booking::with(['room.kost'])->get();
    echo "Booking count: " . $bookings->count() . "\n";
    
    if ($bookings->count() > 0) {
        $firstBooking = $bookings->first();
        echo "First booking kost name: " . $firstBooking->room->kost->name . "\n";
    }
} catch (Exception $e) {
    echo "Error with Booking relations: " . $e->getMessage() . "\n";
}

echo "\nTesting User bookings...\n";
try {
    $user = User::where('role', 'user')->first();
    if ($user) {
        $userBookings = $user->bookings()->with(['room.kost'])->get();
        echo "User bookings count: " . $userBookings->count() . "\n";
    }
} catch (Exception $e) {
    echo "Error with User bookings: " . $e->getMessage() . "\n";
} 