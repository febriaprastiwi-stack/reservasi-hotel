<?php

namespace App\Http\Controllers;
use App\Models\Payments;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'status' => 'required|string',
        ]);

        $payment = Payments::create($request->all());

        // Update reservation status to 'confirmed' after payment
        $reservation = Reservation::find($request->reservation_id);
        $reservation->status = 'confirmed';
        $reservation->save();

        return response()->json(['message' => 'Payment processed successfully', 'payment' => $payment], 201);
    }
    public function show($id)
    {
        $payment = Payments::with('reservation')->findOrFail($id);
        return view('payments.show', compact('payment'));
    }
}
