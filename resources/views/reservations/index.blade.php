@extends('layouts.app')

@section('title', 'Daftar Reservasi')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Daftar Reservasi</h2>
        <a href="{{ route('reservations.create') }}" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle"></i> Tambah Reservasi
        </a>

        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nama Customer</th>
                    <th>Kamar</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->customer->name ?? '-' }}</td>
                        <td>{{ $reservation->room->name ?? '-' }}</td>
                        <td>{{ $reservation->check_in }}</td>
                        <td>{{ $reservation->check_out }}</td>
                        <td>Rp {{ number_format($reservation->total_harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if ($reservation->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-success">Confirmed</span>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- Tombol Detail --}}
                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Detail
                            </a>

                            {{-- Tombol Edit --}}
                            <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus reservasi ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada reservasi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
