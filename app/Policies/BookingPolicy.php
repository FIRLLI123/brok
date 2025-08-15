<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Booking $booking)
    {
        // Mitra hanya bisa melihat booking untuk kost mereka
        if ($user->isMitra()) {
            return $booking->room->kost->user_id === $user->id;
        }

        // User hanya bisa melihat booking mereka sendiri
        if ($user->isUser()) {
            return $booking->user_id === $user->id;
        }

        // Admin bisa melihat semua booking
        return $user->isAdmin();
    }

    public function update(User $user, Booking $booking)
    {
        // Hanya mitra yang memiliki kost tersebut yang bisa mengupdate status booking
        if ($user->isMitra()) {
            return $booking->room->kost->user_id === $user->id;
        }

        // Admin bisa mengupdate semua booking
        return $user->isAdmin();
    }
} 