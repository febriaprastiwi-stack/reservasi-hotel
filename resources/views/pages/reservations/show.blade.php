@extends('layouts.app')

@section('title', 'Reservation Detail')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Reservation Detail</h2>

    <div class="card shadow-sm p-4">
        <h5 class="mb-3">Room Information</h5>
        <p><strong>Room:</strong> {{ $reservation->room->jenis_kamar ?? '-' }} ({{ $reservation->room->nomor_kamar ?? '' }})</p>
        <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($reservation->checkin)->format('d M Y') }}</p>
        <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($reservation->checkout)->format('d M Y') }}</p>
        <p><strong>Guests:</strong> {{ $reservation->guests }}</p>
        <p><strong>Total Price:</strong> Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</p>
        <p><strong>Status:</strong> 
            @if ($reservation->status == 'confirmed')
                <span class="badge bg-success">Confirmed</span>
            @elseif ($reservation->status == 'pending')
                <span class="badge bg-warning text-dark">Pending</span>
            @else
                <span class="badge bg-secondary">{{ ucfirst($reservation->status) }}</span>
            @endif
        </p>
        <p><strong>Booked At:</strong> {{ $reservation->created_at->format('d M Y H:i') }}</p>

        <div class="mt-3">
            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>
@endsection
