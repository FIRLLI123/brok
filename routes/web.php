<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route to add a test room to kost ID 2
Route::get('/add-test-room', function() {
    try {
        $kost = \App\Models\Kost::find(2);
        
        if (!$kost) {
            return 'Kost with ID 2 not found';
        }
        
        $room = $kost->rooms()->create([
            'room_number' => 'A1',
            'price' => 1500000,
            'description' => 'Kamar nyaman dengan AC dan kamar mandi dalam',
            'is_available' => true
        ]);
        
        return 'Room created successfully with ID: ' . $room->id;
        
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Debug route to check database structure
Route::get('/debug/kost-structure', function() {
    try {
        $columns = Schema::getColumnListing('kost');
        $tableInfo = DB::select('DESCRIBE kost');
        return response()->json([
            'columns' => $columns,
            'table_info' => $tableInfo
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('debug.kost.structure');

// Public routes
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('mitra')) {
            return redirect()->route('mitra.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
    return redirect()->route('login');
});

// Authentication routes (handled by Breeze)
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        // Mitra management
        Route::get('/mitra', [App\Http\Controllers\Admin\MitraController::class, 'index'])->name('mitra.index');
        Route::put('/mitra/{user}/approve', [App\Http\Controllers\Admin\MitraController::class, 'approve'])->name('mitra.approve');
        Route::put('/mitra/{user}/reject', [App\Http\Controllers\Admin\MitraController::class, 'reject'])->name('mitra.reject');

        // Kost management
        Route::get('/kost', [App\Http\Controllers\Admin\KostController::class, 'index'])->name('kost.index');
        Route::put('/kost/{kost}/approve', [App\Http\Controllers\Admin\KostController::class, 'approve'])->name('kost.approve');
        Route::put('/kost/{kost}/reject', [App\Http\Controllers\Admin\KostController::class, 'reject'])->name('kost.reject');
    });

    // Mitra routes
    Route::prefix('mitra')->name('mitra.')->group(function () {
        Route::get('/dashboard', function () {
            return view('mitra.dashboard');
        })->name('dashboard');
        
        // Kost management
        Route::resource('kost', App\Http\Controllers\Mitra\KostController::class);
        Route::resource('rooms', App\Http\Controllers\Mitra\RoomController::class);
        
        // Booking management
        Route::get('/bookings', [App\Http\Controllers\Mitra\BookingController::class, 'index'])->name('bookings.index');
        Route::put('/bookings/{booking}/approve', [App\Http\Controllers\Mitra\BookingController::class, 'approve'])->name('bookings.approve');
        Route::put('/bookings/{booking}/reject', [App\Http\Controllers\Mitra\BookingController::class, 'reject'])->name('bookings.reject');
        
        // Reviews
        Route::get('/reviews', [App\Http\Controllers\Mitra\ReviewController::class, 'index'])->name('reviews.index');
        Route::post('/reviews/{review}/reply', [App\Http\Controllers\Mitra\ReviewReplyController::class, 'store'])->name('reviews.reply');
    });

    // User routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');
        
        // Kost browsing
        Route::get('/kost', [App\Http\Controllers\User\KostController::class, 'index'])->name('kost.index');
        Route::get('/kost/{kost}', [App\Http\Controllers\User\KostController::class, 'show'])->name('kost.show');
        
        // Bookings
        Route::post('/bookings', [App\Http\Controllers\User\BookingController::class, 'store'])->name('bookings.store');
        Route::get('/bookings', [App\Http\Controllers\User\BookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [App\Http\Controllers\User\BookingController::class, 'show'])->name('bookings.show');
        Route::get('/kost/{kost}', [App\Http\Controllers\User\KostController::class, 'show'])->name('kost.show');
        
        // Booking
        Route::post('/bookings', [App\Http\Controllers\User\BookingController::class, 'store'])->name('bookings.store');
        Route::get('/bookings', [App\Http\Controllers\User\BookingController::class, 'index'])->name('bookings.index');
        
        // Reviews
        Route::get('/bookings/{booking}/review', [App\Http\Controllers\User\ReviewController::class, 'create'])->name('reviews.create');
        Route::post('/bookings/{booking}/review', [App\Http\Controllers\User\ReviewController::class, 'store'])->name('reviews.store');
    });

    // Profile routes (accessible by all authenticated users)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
