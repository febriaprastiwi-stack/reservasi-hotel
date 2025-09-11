<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ResepsionisController extends Controller
{
    public function dashboard()
    {
        $today = now()->toDateString();

        // Statistik
        $reservasi_hari_ini = Reservation::whereDate('check_in', $today)->count();
        $checkin_hari_ini   = Reservation::whereDate('check_in', $today)
                              ->where('status', 'checkin')->count();
        $checkout_hari_ini  = Reservation::whereDate('check_out', $today)
                              ->where('status', 'checkout')->count();

        // Reservasi aktif (belum checkout)
        $reservasi_aktif = Reservation::where('status', '!=', 'checkout')->get();

        return view('resepsionis.dashboard', compact(
            'reservasi_hari_ini',
            'checkin_hari_ini',
            'checkout_hari_ini',
            'reservasi_aktif'
        ));
    }
}
