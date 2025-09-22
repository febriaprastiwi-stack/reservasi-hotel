<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Home\KamarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Home\ReservationsController;
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


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('reservations', ReservationController::class);
});

// =============================
// Halaman Home
// =============================
Route::prefix('home')->name('home.')->group(function () {
        Route::get('/rooms', [KamarController::class, 'index'])->name('rooms.index');
        Route::get('/home/rooms/{room}', [KamarController::class, 'show'])->name('rooms.show');

Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [HomeReservationsController::class, 'index'])->name('index');   // daftar reservasi user
        Route::get('/create', [HomeReservationsController::class, 'create'])->name('create'); // form pemesanan
        Route::post('/', [HomeReservationsController::class, 'store'])->name('store');  // simpan pemesanan
        Route::get('/history', [HomeReservationsController::class, 'history'])->name('history'); // riwayat pemesanan
        Route::get('/{reservation}', [HomeReservationsController::class, 'show'])->name('show'); // detail reservasi
        Route::delete('/{reservation}', [HomeReservationsController::class, 'destroy'])->name('destroy'); // batal
    });
});