<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        // Filter jumlah tamu (person vs jumlah kasur)
        if ($request->filled('person')) {
            $query->where('jumlah_kasur', '>=', $request->person);
        }

        // Filter tanggal (cek apakah ada reservasi aktif yang bentrok)
        if ($request->filled('check_in') && $request->filled('check_out')) {
            $checkIn  = $request->check_in;
            $checkOut = $request->check_out;

            $query->whereDoesntHave('reservations', function ($q) use ($checkIn, $checkOut) {
                $q->where(function ($sub) use ($checkIn, $checkOut) {
                    $sub->whereBetween('check_in', [$checkIn, $checkOut])
                        ->orWhereBetween('check_out', [$checkIn, $checkOut])
                        ->orWhere(function ($q2) use ($checkIn, $checkOut) {
                            $q2->where('check_in', '<=', $checkIn)
                            ->where('check_out', '>=', $checkOut);
                        });
                })
                ->where('status', 'active'); // hanya reservasi aktif yang dihitung
            });
        }

        // Kalau hanya filter Guests tanpa tanggal → exclude kamar reserved
        if ($request->filled('person') && (!$request->filled('check_in') || !$request->filled('check_out'))) {
            $query->where('status', '!=', 'reserved');
        }

        $rooms = $query->get();

        return view('home.rooms.index', compact('rooms'));
    }



    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('home.rooms.show', compact('room'));
    }
}
