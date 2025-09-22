@extends('home.layouts.app')

@section('title', 'Book Room')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Book Room</h2>

    @if ($room)
        <div class="alert alert-info">
            Booking for: <strong>{{ $room->jenis_kamar }} ({{ $room->nomor_kamar }})</strong>
        </div>
    @endif

    <form action="{{ route('home.reservations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id ?? '' }}">

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Check-in</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Check-out</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Guests</label>
            <input type="number" name="guests" class="form-control" min="1" value="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select name="payment" class="form-control" required>
                <option value="">-- Select Payment --</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Cash">Cash</option>
            </select>
        </div>

        {{-- Opsional: jika ingin input total harga manual --}}
        {{-- <div class="mb-3">
            <label class="form-label">Total Price</label>
            <input type="number" name="total_price" class="form-control" required>
        </div> --}}

        <button type="submit" class="btn btn-dark">Confirm Booking</button>
    </form>
</div>
@endsection
