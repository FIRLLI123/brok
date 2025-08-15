<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function create(Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if booking is approved
        if ($booking->status !== 'approved') {
            return redirect()->route('user.bookings.index')
                ->with('error', 'Anda hanya bisa memberikan ulasan untuk booking yang sudah disetujui.');
        }

        // Check if booking end date has passed or is today
        $endDate = Carbon::parse($booking->end_date);
        if ($endDate->isFuture() && !$endDate->isToday()) {
            return redirect()->route('user.bookings.index')
                ->with('error', 'Anda hanya bisa memberikan ulasan setelah atau pada hari terakhir masa booking.');
        }

        // Check if user already reviewed this booking
        if ($booking->review) {
            return redirect()->route('user.bookings.index')
                ->with('error', 'Anda sudah memberikan ulasan untuk booking ini.');
        }

        return view('user.reviews.create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if booking is completed
        if ($booking->status !== 'approved' || Carbon::parse($booking->end_date)->isFuture()) {
            return redirect()->route('user.bookings.index')
                ->with('error', 'Anda hanya bisa memberikan ulasan setelah booking selesai.');
        }

        // Check if user already reviewed this booking
        if ($booking->review) {
            return redirect()->route('user.bookings.index')
                ->with('error', 'Anda sudah memberikan ulasan untuk booking ini.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        Review::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->id(),
            'kost_id' => $booking->room->kost_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('user.bookings.index')
            ->with('success', 'Ulasan berhasil ditambahkan.');
    }
} 