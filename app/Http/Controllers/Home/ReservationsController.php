<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;

class ReservationController extends Controller
{

    public function index()
        {
            // Ambil semua reservasi (sementara semua user)
            $reservations = Reservation::with('room')->latest()->get();

            return view('home.reservations.index', compact('reservations'));
        }


    public function create(Request $request)
        {
            $room = null;
            if ($request->has('room_id')) {
                $room = \App\Models\Room::findOrFail($request->room_id);
            }

            return view('home.form.index', compact('room'));
        }


   public function store(Request $request)
    {
        $request->validate([
            'room_id'   => 'required|exists:rooms,id',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            'check_in'   => 'required|date|after_or_equal:today',
            'check_out'  => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1',
            'payment'   => 'required|string',
        ]);

        // Ambil data room
        $room = Room::findOrFail($request->room_id);

        // Hitung lama menginap (dalam malam)
        $check_in = Carbon::parse($request->check_in);
        $check_out = Carbon::parse($request->check_out);
        $nights = $check_in->diffInDays($check_out);

        // Hitung total harga
        $totalPrice = $nights * $room->harga;

        // Simpan reservasi
        Reservation::create([
            'room_id'      => $room->id,
            'name'         => $request->name,
            'email'        => $request->email,
            'check_in'      => $request->check_in,
            'check_out'     => $request->check_out,
            'guests'       => $request->guests,
            'payment'      => $request->payment,
            'total_price'  => $totalPrice,
        ]);

        return redirect()->route('home.reservations.history')
                         ->with('success', 'Pemesanan berhasil! Total: Rp ' . number_format($totalPrice, 0, ',', '.'));
    }


    public function history()
    {
        // Ambil semua booking user (sementara kita tampilkan semua)
        // Kalau sudah pakai login Auth, bisa filter by user_id
        $reservations = Reservation::with('room')->latest()->get();

        return view('home.reservations.history', compact('reservations'));
    }

}