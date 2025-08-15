<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = User::where('role', 'mitra')->get();
        return view('admin.mitra.index', compact('mitras'));
    }

    public function approve(User $user)
    {
        if ($user->role !== 'mitra') {
            return back()->with('error', 'User is not a mitra.');
        }

        $user->update(['is_active' => true]);
        return back()->with('success', 'Mitra has been approved.');
    }

    public function reject(User $user)
    {
        if ($user->role !== 'mitra') {
            return back()->with('error', 'User is not a mitra.');
        }

        $user->update(['is_active' => false]);
        return back()->with('success', 'Mitra has been rejected.');
    }
} 