<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('layouts.pages.dashboard.index', ['userRole' => 'admin']);
            } elseif (Auth::user()->role == 'resepsionis') {
                return view('layouts.pages.dashboard.index', ['userRole' => 'resepsionis']);
            }
        }

        // Jika belum login, arahkan ke dashboard umum
        return view('layouts.pages.dashboard.index');
    }
}