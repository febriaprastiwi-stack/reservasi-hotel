<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        // Semua reservasi (dari semua user)
        $reservations = Reservation::with('room')->latest()->get();
        return view('pages.admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        return view('pages.admin.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        return view('pages.admin.reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.reservations.index')
                         ->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index')
                         ->with('success', 'Reservation deleted successfully.');
    }
}
