<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // List semua reservasi user login
    public function index()
    {
        $reservations = Reservation::with('room')
            ->where('email', auth()->user()->email ?? session('reservation_email'))
            ->latest()
            ->get();

        return view('home.reservations.history', compact('reservations'));
    }

    // Detail reservasi
    public function show(Reservation $reservation)
    {
        return view('home.reservations.show', compact('reservation'));
    }

    // Edit reservasi
    public function edit(Reservation $reservation)
    {
        return view('home.reservations.edit', compact('reservation'));
    }

    // Update reservasi
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'guests' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update($request->only('guests', 'status'));

        return redirect()->route('reservations.index')
                         ->with('success', 'Reservation updated successfully.');
    }

    // Hapus reservasi
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')
                         ->with('success', 'Reservation deleted successfully.');
    }
}
