<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Ambil semua booking yang terkait dengan kost milik mitra
        $bookings = Booking::whereIn('room_id', function($query) {
            $query->select('id')
                  ->from('rooms')
                  ->whereIn('kost_id', auth()->user()->kost()->pluck('id'));
        })
        ->with(['user', 'room.kost'])
        ->latest()
        ->paginate(10);

        return view('mitra.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        // Pastikan booking ini terkait dengan kost milik mitra
        $this->authorize('view', $booking);
        
        return view('mitra.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        // Pastikan booking ini terkait dengan kost milik mitra
        if ($booking->room->kost->user_id !== auth()->id()) {
            abort(403);
        }
        
        $booking->update(['status' => 'approved']);
        
        return redirect()->route('mitra.bookings.index')
            ->with('success', 'Booking berhasil disetujui');
    }

    public function reject(Booking $booking)
    {
        // Pastikan booking ini terkait dengan kost milik mitra
        if ($booking->room->kost->user_id !== auth()->id()) {
            abort(403);
        }
        
        $booking->update(['status' => 'rejected']);
        
        return redirect()->route('mitra.bookings.index')
            ->with('success', 'Booking berhasil ditolak');
    }
} 