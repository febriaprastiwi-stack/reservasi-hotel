<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Halaman daftar semua reservasi (khusus admin/resepsionis)
    public function index(Request $request)
    {
        $query = Reservation::with('room');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhereHas('room', function($q) use ($search) {
                    $q->where('jenis_kamar', 'like', "%$search%")
                        ->orWhere('nomor_kamar', 'like', "%$search%");
                });
        }

        $reservations = $query->latest()->get();

        return view('pages.reservations.index', compact('reservations'));
    }

    // Detail reservasi
    public function show(Reservation $reservation)
    {
        return view('pages.reservations.show', compact('reservation'));
    }

    // Edit reservasi
    public function edit(Reservation $reservation)
    {
        return view('pages.reservations.edit', compact('reservation'));
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
