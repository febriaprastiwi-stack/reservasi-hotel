@extends('layouts.app')

@section('title', 'Daftar Reservasi')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Daftar Reservasi</h2>
        <a href="{{ route('reservations.create') }}" class="btn btn-success mb-3">+ Tambah Reservasi</a>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Customer</th>
                    <th>Kamar</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->customer->name ?? '-' }}</td>
                        <td>{{ $reservation->room->name ?? '-' }}</td>
                        <td>{{ $reservation->check_in }}</td>
                        <td>{{ $reservation->check_out }}</td>
                        <td>Rp {{ number_format($reservation->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @if ($reservation->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-success">Confirmed</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('reservations.show', $reservation->id) }}"
                                class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('reservations.edit', $reservation->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus reservasi ini?')">Hapus</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
