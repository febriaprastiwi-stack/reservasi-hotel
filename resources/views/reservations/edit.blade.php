@extends('layouts.app')

@section('title', 'Edit Reservasi')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Edit Reservasi</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"
                            {{ $reservation->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="room_id" class="form-label">Kamar</label>
                <select name="room_id" id="room_id" class="form-control" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ $reservation->room_id == $room->id ? 'selected' : '' }}>
                            {{ $room->name }} - Rp {{ number_format($room->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="check_in" class="form-label">Check In</label>
                <input type="date" name="check_in" id="check_in" class="form-control"
                    value="{{ $reservation->check_in }}" required>
            </div>

            <div class="mb-3">
                <label for="check_out" class="form-label">Check Out</label>
                <input type="date" name="check_out" id="check_out" class="form-control"
                    value="{{ $reservation->check_out }}" required>
            </div>

            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" name="total_harga" id="total_harga" class="form-control"
                    value="{{ $reservation->total_harga }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
