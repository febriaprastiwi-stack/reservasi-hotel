@extends('layouts.app')

@section('title', 'Reservations Management')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">All Reservations</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Guest Name</th>
                    <th>Email</th>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Guests</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->email }}</td>
                        <td>{{ $reservation->room->jenis_kamar ?? '-' }} ({{ $reservation->room->nomor_kamar ?? '' }})</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}</td>
                        <td>{{ $reservation->guests }}</td>
                        <td>Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                        <td>
                            @if ($reservation->status == 'confirmed')
                                <span class="badge bg-success">Confirmed</span>
                            @elseif ($reservation->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($reservation->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this reservation?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">No reservations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
