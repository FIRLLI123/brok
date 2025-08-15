<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    public function index()
    {
        $kosts = Kost::with(['user', 'rooms'])
            ->latest()
            ->paginate(10);

        return view('admin.kost.index', compact('kosts'));
    }

    public function approve(Kost $kost)
    {
        $kost->update(['admin_approved' => true]);
        return redirect()->route('admin.kost.index')
            ->with('success', 'Kost berhasil disetujui.');
    }

    public function reject(Kost $kost)
    {
        $kost->update(['admin_approved' => false]);
        return redirect()->route('admin.kost.index')
            ->with('success', 'Kost berhasil ditolak.');
    }
} 