<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use App\Models\Customers;
use App\Models\Rooms;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['customer', 'room', 'payment'])->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $customers = Customers::all();
        $rooms = Rooms::where('status', 'available')->get();
        return view('reservations.create', compact('customers', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Rooms::find($request->room_id);
        $totalDays = (new \DateTime($request->check_out))->diff(new \DateTime($request->check_in))->days;
        $totalHarga = $room->harga * $totalDays;

        $reservation = Reservation::create([
            'customer_id' => $request->customer_id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        // Update room status to booked
        $room->status = 'booked';
        $room->save();

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function show($id)
    {
        $reservation = Reservation::with(['customer', 'room', 'payment'])->findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $customers = Customers::all();
        $rooms = Rooms::where('status', 'available')->orWhere('id', $reservation->room_id)->get();
        return view('reservations.edit', compact('reservation', 'customers', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);
        $reservation = Reservation::findOrFail($id);
        $room = Rooms::find($request->room_id);
        $totalDays = (new \DateTime($request->check_out))->diff(new \DateTime($request->check_in))->days;
        $totalHarga = $room->harga * $totalDays;
        $reservation->update([
            'customer_id' => $request->customer_id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_harga' => $totalHarga,
        ]);
        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $room = Rooms::find($reservation->room_id);
        // Update room status to available
        if ($room) {
            $room->status = 'available';
            $room->save();
        }
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
    
}
