@extends('layouts.app')

@section('title', 'Reservation Detail')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Reservation Detail</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Guest:</strong> {{ $reservation->name }} ({{ $reservation->email }})</p>
            <p><strong>Room:</strong> {{ $reservation->room->jenis_kamar ?? '-' }} ({{ $reservation->room->nomor_kamar ?? '' }})</p>
            <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}</p>
            <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}</p>
            <p><strong>Guests:</strong> {{ $reservation->guests }}</p>
            <p><strong>Total Price:</strong> Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($reservation->status) }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
