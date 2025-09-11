@extends('layouts.app')

@section('title', 'Detail Reservasi')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Detail Reservasi</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Reservasi #{{ $reservation->id }}</h5>
                <p><strong>Customer:</strong> {{ $reservation->customer->name ?? '-' }}</p>
                <p><strong>Email:</strong> {{ $reservation->customer->email ?? '-' }}</p>
                <p><strong>No. Telepon:</strong> {{ $reservation->customer->phone ?? '-' }}</p>

                <p><strong>Kamar:</strong> {{ $reservation->room->name ?? '-' }} ({{ $reservation->room->type ?? '-' }})</p>
                <p><strong>Harga per Malam:</strong> Rp {{ number_format($reservation->room->price ?? 0, 0, ',', '.') }}</p>

                <p><strong>Check In:</strong> {{ $reservation->check_in }}</p>
                <p><strong>Check Out:</strong> {{ $reservation->check_out }}</p>
                <p><strong>Total Harga:</strong> Rp {{ number_format($reservation->total_harga, 0, ',', '.') }}</p>

                <p><strong>Status:</strong>
                    @if ($reservation->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @else
                        <span class="badge bg-success">Confirmed</span>
                    @endif
                </p>
            </div>
        </div>

        <a href="{{ route('reservations.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
