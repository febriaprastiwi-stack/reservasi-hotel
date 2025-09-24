<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Home\KamarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Home\HomeReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// =============================
// Halaman utama (welcome)
// =============================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login'); // arahkan kembali ke halaman login
})->name('logout');

// =============================
// Group Admin
// =============================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('rooms', RoomController::class);
    Route::resource('fasilitas', FasilitasController::class);
});

// =============================
// Halaman verifikasi sebelum dashboard
// =============================
Route::get('/verify-dashboard', function () {
    return view('verify');
})->name('verify.dashboard');

// Proses verifikasi
Route::post('/verify-dashboard', function (Request $request) {
    if ($request->input('access_code') === '12345') {
        return redirect()->route('dashboard');
    }

    return back()->with('error', 'Kode verifikasi salah!');
});

// Dashboard (hanya bisa diakses jika lewat verify)
Route::get('/dashboard', function (Request $request) {
    if (
        ! $request->headers->get('referer') ||
        ! str_contains($request->headers->get('referer'), 'verify-dashboard')
    ) {
        return redirect()->route('verify.dashboard');
    }

    return view('pages.dashboard.index');
})->name('dashboard');


Route::resource('reservations', ReservationController::class);


// =============================
// Halaman Home
// =============================
Route::prefix('home')->name('home.')->group(function () {
    // Route untuk Rooms
    Route::get('/rooms', [KamarController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{room}', [KamarController::class, 'show'])->name('rooms.show');

    // Route untuk Reservations
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [HomeReservationController::class, 'index'])->name('index');
        Route::get('/create', [HomeReservationController::class, 'create'])->name('create');
        Route::post('/', [HomeReservationController::class, 'store'])->name('store');
        Route::get('/history', [HomeReservationController::class, 'history'])->name('history');
    });
});
