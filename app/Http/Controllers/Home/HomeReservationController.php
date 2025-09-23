<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;

class HomeReservationController extends Controller
{
    public function index()
    {
        // Ambil email dari session (diset saat booking)
        $email = session('reservation_email');

        $reservations = collect();

        if ($email) {
            $reservations = Reservation::with('room')
                ->where('email', $email)
                ->latest()
                ->get();
        }

        return view('home.reservations.index', compact('reservations'));
    }

    public function create(Request $request)
    {
        $room = null;

        if ($request->filled('room_id')) {
            $room = Room::findOrFail($request->room_id);
        }

        return view('home.reservations.create', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id'   => 'required|exists:rooms,id',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1',
            'payment'   => 'required|string',
        ]);

        $room = Room::findOrFail($request->room_id);

        // Hitung lama menginap
        $check_in = Carbon::parse($request->check_in);
        $check_out = Carbon::parse($request->check_out);
        $nights = max(1, $check_in->diffInDays($check_out)); // kalau sama tanggal, tetap 1 malam

        $totalPrice = $nights * $room->harga;

        // Simpan reservasi
        $reservation = Reservation::create([
            'room_id'     => $room->id,
            'name'        => $request->name,
            'email'       => $request->email,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'guests'      => $request->guests,
            'payment'     => $request->payment,
            'total_price' => $totalPrice,
        ]);

        // Simpan email ke session
        session(['reservation_email' => $request->email]);

        return redirect()->route('home.reservations.history')
                         ->with('success', 'Pemesanan berhasil! Total: Rp ' . number_format($totalPrice, 0, ',', '.'));
    }

    public function history()
{
    $email = session('reservation_email');

    $reservation = null;

    if ($email) {
        $reservation = Reservation::with('room')
            ->where('email', $email)
            ->latest()
            ->first(); // hanya ambil 1 reservasi terakhir
    }

    return view('home.reservations.history', compact('reservation'));
}

}
