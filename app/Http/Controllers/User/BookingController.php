<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kost;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->with(['room.kost'])
            ->latest()
            ->paginate(10);

        return view('user.bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $room = Room::findOrFail($request->room_id);
        
        // Check if room is available
        if (!$room->is_available) {
            return back()->withErrors(['room_id' => 'Kamar ini sudah tidak tersedia.']);
        }
        
        // Check if user already has a booking for this room
        $existingBooking = auth()->user()->bookings()
            ->where('room_id', $request->room_id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();
            
        if ($existingBooking) {
            return back()->withErrors(['room_id' => 'Anda sudah memiliki booking untuk kamar ini.']);
        }
        
        // Hitung total harga berdasarkan durasi (per bulan)
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $months = $startDate->diffInMonths($endDate) + 1; // Minimal 1 bulan
        $totalPrice = $room->price * $months;

        $booking = auth()->user()->bookings()->create([
            'room_id' => $request->room_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('user.bookings.index')
            ->with('success', 'Booking berhasil dibuat. Silahkan tunggu konfirmasi dari pemilik kost.');
    }
} 