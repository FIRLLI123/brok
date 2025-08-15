<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics for admin dashboard
        $totalMitra = User::role('mitra')->count();
        $totalKost = Kost::count();
        $pendingKost = Kost::whereNull('admin_approved')->count();
        $approvedKost = Kost::where('admin_approved', true)->count();
        $rejectedKost = Kost::where('admin_approved', false)->count();

        return view('admin.dashboard', compact(
            'totalMitra',
            'totalKost',
            'pendingKost',
            'approvedKost',
            'rejectedKost'
        ));
    }
} 