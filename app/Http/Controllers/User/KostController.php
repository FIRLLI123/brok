<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    public function index(Request $request)
    {
        $query = Kost::with(['user', 'images'])
            ->where('admin_approved', true);

        // Search by name (only if search term is not empty)
        if ($request->filled('search')) {
            $searchTerm = trim($request->search);
            if (!empty($searchTerm)) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            }
        }

        // Filter by city (only if city is selected)
        if ($request->filled('city')) {
            $city = trim($request->city);
            if (!empty($city)) {
                $query->where('city', $city);
            }
        }

        // Filter by price range (only if values are valid numbers)
        if ($request->filled('min_price') && is_numeric($request->min_price)) {
            $query->where('price', '>=', (float)$request->min_price);
        }
        
        if ($request->filled('max_price') && is_numeric($request->max_price)) {
            $query->where('price', '<=', (float)$request->max_price);
        }

        // Filter by availability status (based on rooms availability)
        if ($request->filled('status')) {
            $status = $request->status;
            
            if ($status === 'tersedia') {
                $query->whereHas('rooms', function($q) {
                    $q->where('is_available', true);
                });
            } elseif ($status === 'tidak_tersedia') {
                $query->whereDoesntHave('rooms', function($q) {
                    $q->where('is_available', true);
                });
            }
        }
        // // Exclude kost yang sudah dibooking oleh user ini (hanya tampilkan yang is_active = 1)
        // $bookedKostIds = auth()->user()->bookings()
        //     ->whereIn('status', ['pending', 'approved'])
        //     ->pluck('room_id');
        
        // if ($bookedKostIds->isNotEmpty()) {
        //     $query->whereNotIn('id', function($subquery) use ($bookedKostIds) {
        //         $subquery->select('kost_id')
        //             ->from('rooms')
        //             ->whereIn('id', $bookedKostIds);
        //     });
        // }

        // Ambil daftar kota untuk filter
        $cities = Kost::where('admin_approved', true)
            ->distinct()
            ->pluck('city');

        $kosts = $query->latest()->paginate(9)->withQueryString();

        // Load rooms for each kost to calculate availability
        $kosts->load('rooms');

        return view('user.kost.index', compact('kosts', 'cities'));
    }

    public function show(Kost $kost)
    {
        // Load relasi yang diperlukan
        $kost->load(['user', 'images']);

        return view('user.kost.show', compact('kost'));
    }
} 