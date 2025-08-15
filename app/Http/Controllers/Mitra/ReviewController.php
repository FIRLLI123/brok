<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::whereHas('kost', function($query) {
            $query->where('user_id', auth()->id());
        })
        ->with(['user', 'kost', 'booking.room', 'replies.user'])
        ->latest()
        ->paginate(10);

        return view('mitra.reviews.index', compact('reviews'));
    }
} 