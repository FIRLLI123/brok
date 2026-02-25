<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'kost_id',
        'room_number',
        'price',
        'description',
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    // Relationships
    public function kost()
    {
        return $this->belongsTo(Kost::class, 'kost_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
} 