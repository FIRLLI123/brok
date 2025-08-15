<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illware_Contracts_Http_Kernel::class);

$app->boot();

use App\Models\Kost;

// Find the kost with ID 2
$kost = Kost::find(2);

if ($kost) {
    try {
        // Create a new room for this kost
        $room = $kost->rooms()->create([
            'room_number' => 'A1',
            'price' => 1500000,
            'description' => 'Kamar nyaman dengan AC dan kamar mandi dalam',
            'is_available' => true
        ]);
        
        echo "Room created successfully with ID: " . $room->id . "\n";
    } catch (\Exception $e) {
        echo "Error creating room: " . $e->getMessage() . "\n";
    }
} else {
    echo "Kost with ID 2 not found.\n";
}
