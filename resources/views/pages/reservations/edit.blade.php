@extends('layouts.app')

@section('title', 'Edit Reservation')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Edit Reservation</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Guests --}}
            <div class="mb-3">
                <label class="form-label">Guests</label>
                <input type="number" name="guests" class="form-control" 
                       value="{{ old('guests', $reservation->guests) }}" min="1" required>
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            {{-- Buttons --}}
            <button type="submit" class="btn btn-dark w-100">Update Reservation</button>
        </form>
    </div>
</div>
@endsection
