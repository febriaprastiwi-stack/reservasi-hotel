<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KetersediaanKamarController;
use Illuminate\Http\Request;

// Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [AuthController::
class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Dashboard dengan login (admin/resepsionis)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Dashboard tanpa login (public)
Route::get('/public-dashboard', function () {
    return view('pages.dashboard.index');
})->name('public.dashboard');


// Halaman verifikasi sebelum dashboard
Route::get('/verify-dashboard', function () {
    return view('verify');
})->name('verify.dashboard');

// Proses verifikasi
Route::post('/verify-dashboard', function (Request $request) {
    // misalnya kode akses "12345"
    if ($request->input('access_code') === '12345') {
        return redirect()->route('dashboard');
    }
    return back()->with('error', 'Kode verifikasi salah!');
});

Route::get('/dashboard', function (Request $request) {
    // Cek apakah user datang dari form verifikasi
    if (!$request->headers->get('referer') || !str_contains($request->headers->get('referer'), 'verify-dashboard')) {
        return redirect()->route('verify.dashboard');
    }
    return view('pages.dashboard.index'); 
})->name('dashboard');

Route::resource('reservations', ReservationController::class);
Route::resource('payments', PaymentController::class);
Route::get('/payments/report', [PaymentController::class, 'report'])->name('payments.report');
Route::get('/ketersediaan_kamar', [KetersediaanKamarController::class, 'index'])
     ->name('pages.dashboard.ketersediaan_kamar.index');


