<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewReply;
use Illuminate\Http\Request;

class ReviewReplyController extends Controller
{
    public function store(Request $request, Review $review)
    {
        // Check if review belongs to kost owned by authenticated mitra
        if ($review->kost->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if mitra already replied to this review
        if ($review->replies()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()
                ->with('error', 'Anda sudah membalas ulasan ini.');
        }

        $request->validate([
            'reply' => 'required|string|min:10|max:1000',
        ]);

        ReviewReply::create([
            'review_id' => $review->id,
            'user_id' => auth()->id(),
            'reply' => $request->reply,
        ]);

        return redirect()->back()
            ->with('success', 'Balasan berhasil ditambahkan.');
    }
} 