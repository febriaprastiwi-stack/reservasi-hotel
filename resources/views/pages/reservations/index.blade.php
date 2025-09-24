@extends('layouts.app')

@section('title', 'My Reservations')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">My Reservations</h2>

    @if ($reservations->isEmpty())
        <div class="alert alert-info">
            You have no reservations yet. 
            <a href="{{ route('home.rooms.index') }}" class="btn btn-primary btn-sm ms-2">Book a Room</a>
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Guests</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Booked At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $reservation->room->jenis_kamar ?? '-' }} 
                                ({{ $reservation->room->nomor_kamar ?? '' }})
                            </td>
                            <td>{{ \Carbon\Carbon::parse($reservation->checkin)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->checkout)->format('d M Y') }}</td>
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
                            <td>{{ $reservation->created_at->format('d M Y H:i') }}</td>
                            <td class="text-center">
                                {{-- Detail --}}
                                <a href="{{ route('reservations.show', $reservation->id) }}" 
                                   class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('reservations.edit', $reservation->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
