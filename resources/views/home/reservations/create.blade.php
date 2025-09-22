@extends('home.layouts.app')

@section('title', 'Book Room')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Book Room</h2>

    <div class="card shadow-sm p-4">
        <div class="alert alert-info">
            Booking for: <strong>{{ $room->jenis_kamar }} ({{ $room->nomor_kamar }})</strong>
        </div>

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            {{-- Full Name --}}
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name ?? '') }}" required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}" required>
            </div>

            {{-- Check-in --}}
            <div class="mb-3">
                <label class="form-label">Check-in</label>
                <input type="date" name="check_in" class="form-control" required>
            </div>

            {{-- Check-out --}}
            <div class="mb-3">
                <label class="form-label">Check-out</label>
                <input type="date" name="check_out" class="form-control" required>
            </div>

            {{-- Guests --}}
            <div class="mb-3">
                <label class="form-label">Guests</label>
                <input type="number" name="guests" class="form-control" min="1" value="1" required>
            </div>

            {{-- Payment Method --}}
            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <select name="payment_method" class="form-select" required>
                    <option value="">-- Select Payment Method --</option>
                    <option value="transfer">Bank Transfer</option>
                    <option value="ewallet">E-Wallet (OVO, Gopay, Dana)</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="cash">Pay at Hotel</option>
                </select>
            </div>

            {{-- Total Price --}}
            <div class="mb-3">
                <label class="form-label">Total Price</label>
                <input type="text" class="form-control" 
                       value="Rp {{ number_format($room->harga_kamar, 0, ',', '.') }}" readonly>
            </div>

            {{-- Hidden data --}}
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" name="price" value="{{ $room->harga_kamar }}">

            <button type="submit" class="btn btn-dark w-100">Confirm Booking</button>
        </form>
    </div>
</div>
@endsection
