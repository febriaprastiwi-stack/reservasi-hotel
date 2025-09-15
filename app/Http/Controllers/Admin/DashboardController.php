<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Fasilitas;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data sesuai menu sidebar
        $totalKamar     = Room::count();
        $totalFasilitas = Fasilitas::count();

        // Chart data (sementara dummy, bisa diganti pakai data real)
        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            'data'   => [10, 20, 15, 25, 30, 18]
        ];

        return view('admin.dashboard', compact(
            'totalKamar',
            'totalFasilitas',
            'chartData'
        ));
    }
}
