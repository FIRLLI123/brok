<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Kost;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::whereHas('kost', function($query) {
            $query->where('user_id', auth()->id());
        })->with('kost')->paginate(10);

        return view('mitra.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $kosts = Kost::where('user_id', auth()->id())->get();
        return view('mitra.rooms.create', compact('kosts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kost_id' => 'required|exists:kost,id',
            'room_number' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Check if kost belongs to authenticated user
        $kost = Kost::where('id', $request->kost_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        Room::create([
            'kost_id' => $request->kost_id,
            'room_number' => $request->room_number,
            'description' => $request->description,
            'price' => $request->price,
            'is_available' => true,
        ]);

        return redirect()->route('mitra.rooms.index')
            ->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function show(Room $room)
    {
        // Check if room belongs to authenticated user
        if ($room->kost->user_id !== auth()->id()) {
            abort(403);
        }

        return view('mitra.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        // Check if room belongs to authenticated user
        if ($room->kost->user_id !== auth()->id()) {
            abort(403);
        }

        $kosts = Kost::where('user_id', auth()->id())->get();
        return view('mitra.rooms.edit', compact('room', 'kosts'));
    }

    public function update(Request $request, Room $room)
    {
        // Check if room belongs to authenticated user
        if ($room->kost->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'kost_id' => 'required|exists:kost,id',
            'room_number' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $room->update($request->all());

        return redirect()->route('mitra.rooms.index')
            ->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        // Check if room belongs to authenticated user
        if ($room->kost->user_id !== auth()->id()) {
            abort(403);
        }

        $room->delete();

        return redirect()->route('mitra.rooms.index')
            ->with('success', 'Kamar berhasil dihapus.');
    }
} 