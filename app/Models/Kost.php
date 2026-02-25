<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    protected $table = 'kost';

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'description',
        'price',
        'is_active',
        'admin_approved'
    ];

    protected $casts = [
        'admin_approved' => 'boolean',
        'price' => 'decimal:2'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(KostImage::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
} 