<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('reservation')->get();
        return view('payments.index', compact('payments'));
    }

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
        public function report(Request $request)
{
    $startDate = $request->start_date;
    $endDate = $request->end_date;

    // Query dengan filter tanggal (jika ada)
    $query = \App\Models\Payment::where('status', 'paid');

    if ($startDate && $endDate) {
        $query->whereBetween('payment_date', [$startDate, $endDate]);
    }

    $payments = $query->selectRaw('MONTH(payment_date) as month, SUM(amount) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Siapkan data untuk Chart.js
    $months = [];
    $totals = [];
    foreach ($payments as $p) {
        $months[] = date("F", mktime(0, 0, 0, $p->month, 1)); // ex: January
        $totals[] = $p->total;
    }

    // Ambil detail semua pembayaran untuk tabel
    $allPayments = $query->with('reservation.customer')->orderBy('payment_date', 'desc')->get();

    return view('payments.report', compact('months', 'totals', 'allPayments', 'startDate', 'endDate'));
}
}