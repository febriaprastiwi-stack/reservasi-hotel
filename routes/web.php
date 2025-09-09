<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Hapus Auth::routes(); karena kita menggunakan rute kustom di bawah.

// Rute untuk menampilkan form login (menggunakan GET)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses data dari form login (menggunakan POST)
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk halaman dashboard yang dilindungi middleware 'auth'
Route::get('/dashboard', function () {
    if (Auth::user()->role == 'admin') {
        return view('admin.dashboard');
    } elseif (Auth::user()->role == 'receptionist') {
        return view('resepsionis.dashboard');
    } else {
        // Arahkan ke rute lain, misalnya halaman utama
        return redirect('/');
    }
})->middleware('auth')->name('dashboard');


// Catatan: Anda juga bisa menambahkan rute untuk register jika dibutuhkan
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);