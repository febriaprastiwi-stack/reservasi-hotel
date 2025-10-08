<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PendapatanController extends Controller
{
    public function index()
    {
        // Total reservasi bulan ini
        $reservasi_bulan_ini = Reservation::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        // Total pendapatan
        $total_pendapatan = Reservation::sum('total_price');

        // Kamar tersedia = semua yang bukan reserved
        $kamar_tersedia = Room::where('status', '!=', 'reserved')->count();

        // Kamar terisi = semua yang reserved
        $kamar_terisi   = Room::where('status', 'reserved')->count();

        // Data chart reservasi bulanan
        $reservasi_bulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $reservasi_bulanan[] = Reservation::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $i)
                ->count();
        }

        // Status kamar untuk chart
        $status_kamar = [
            'Tersedia' => $kamar_tersedia,
            'Terisi'   => $kamar_terisi,
        ];

        return view('pages.pendapatan.index', compact(
            'reservasi_bulan_ini',
            'total_pendapatan',
            'kamar_tersedia',
            'status_kamar',
            'reservasi_bulanan'
        ));
    }
}
