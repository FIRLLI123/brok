<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\User;
https://mcp.notion.com/mcp
class DashboardController extends Controller
{
    public function index()
    {
        $totalMitra = User::where('role', 'mitra')->count();
        $activeMitra = User::where('role', 'mitra')->where('is_active', true)->count();
        $pendingMitra = User::where('role', 'mitra')->where('is_active', false)->count();
        $totalKost = Kost::count();
        $pendingKost = Kost::whereNull('admin_approved')->count();
        $approvedKost = Kost::where('admin_approved', true)->count();
        $rejectedKost = Kost::where('admin_approved', false)->count();
        $recentMitras = User::where('role', 'mitra')
            ->withCount('kost')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMitra',
            'activeMitra',
            'pendingMitra',
            'totalKost',
            'pendingKost',
            'approvedKost',
            'rejectedKost',
            'recentMitras'
        ));
    }
}
