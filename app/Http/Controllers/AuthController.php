<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ... (metode showLoginForm)

    public function login(Request $request)
    {
        $request->all(); // Tambahkan baris ini

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

            // 2. Coba otentikasi pengguna
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin.dashboard'); // admin → admin dashboard
                }
                return redirect()->route('dashboard'); // resepsionis → dashboard biasa
            }

            // Login gagal, kembalikan ke halaman login dengan pesan error
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }
        public function showLoginForm()
        {
            return view('auth.login');
        }

         public function showRegisterForm()
        {
            return view('auth.register');
        }

        public function register(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'resepsionis', 
        ]);

        // Login pengguna setelah registrasi
        Auth::login($user);

        // Arahkan ke dashboard
        return redirect()->route('dashboard');
    }


    }