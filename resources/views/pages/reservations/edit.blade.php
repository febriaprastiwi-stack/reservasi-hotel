@extends('layouts.app')

@section('title', 'Edit Reservation')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Edit Reservation Status</h2>

    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Guest Name</label>
            <input type="text" class="form-control" value="{{ $reservation->name }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Room</label>
            <input type="text" class="form-control" value="{{ $reservation->room->jenis_kamar ?? '-' }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
