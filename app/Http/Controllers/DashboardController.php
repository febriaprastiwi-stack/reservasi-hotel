<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $reservasi_bulan_ini = Reservation::whereMonth('created_at', now()->month)->count();
        $kamar_tersedia = Room::where('status', 'tersedia')->count();
        $total_pendapatan = Reservation::sum('total_harga');

        // Data reservasi per bulan
        $reservasi_bulanan = [];
        for ($i=1; $i<=12; $i++) {
            $reservasi_bulanan[] = Reservation::whereMonth('created_at', $i)->count();
        }

        // Status kamar
        $status_kamar = [
            'Tersedia' => Room::where('status','tersedia')->count(),
            'Terisi'   => Room::where('status','terisi')->count(),
        ];

        return view('pages.admin.dashboard', compact(
            'reservasi_bulan_ini',
            'kamar_tersedia',
            'total_pendapatan',
            'reservasi_bulanan',
            'status_kamar'
        ));
    }
}