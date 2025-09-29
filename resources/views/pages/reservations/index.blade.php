@extends('layouts.app')

@section('title', 'Data Reservasi')

@section('content')
<div class="container-fluid" style="margin-left: 0px; padding-top: 80px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📋 Data Reservasi</h2>
        <form action="{{ route('reservations.index') }}" method="GET" class="d-flex">
        <input type="text" name="search" class="form-control me-2" 
            placeholder="Cari reservasi..." value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i> Cari
        </button>
    </form>
    </div>

    @if ($reservations->isEmpty())
        <div class="alert alert-info shadow-sm">
            Anda belum memiliki reservasi. 
            <a href="{{ route('home.rooms.index') }}" class="fw-bold text-decoration-none">Pesan sekarang!</a>
        </div>
    @else
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-nowrap">
                        <thead class="table-primary">
                            <tr>
                                <th style="width: 40px;">No</th>
                                <th style="width: 140px;">Room</th>
                                <th style="width: 120px;">Nama</th>
                                <th style="width: 200px;">Email</th>
                                <th style="width: 110px;">Check-in</th>
                                <th style="width: 110px;">Check-out</th>
                                <th style="width: 80px;">Guests</th>
                                <th style="width: 120px;">Payment</th>
                                <th style="width: 130px;">Total Price</th>
                                <th style="width: 120px;">Status</th>
                                <th style="width: 140px;">Booked At</th>
                                <th style="width: 100px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $reservation->room->jenis_kamar ?? '-' }}</strong><br>
                                        <small class="text-muted">No: {{ $reservation->room->nomor_kamar ?? '' }}</small>
                                    </td>
                                    <td>{{ $reservation->name }}</td>
                                    <td class="text-truncate" style="max-width: 180px;" title="{{ $reservation->email }}">
                                        {{ $reservation->email }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}</td>
                                    <td class="text-center">{{ $reservation->guests }}</td>
                                    <td>{{ ucfirst($reservation->payment ?? '-') }}</td>
                                    <td class="fw-bold text-success">
                                        Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @if ($reservation->status == 'active')
                                            <span class="badge bg-success px-3 py-2">Active</span>
                                        @elseif ($reservation->status == 'completed')
                                            <span class="badge bg-primary px-3 py-2">Completed</span>
                                        @elseif ($reservation->status == 'canceled')
                                            <span class="badge bg-danger px-3 py-2">Canceled</span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">{{ ucfirst($reservation->status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $reservation->created_at->format('d M Y H:i') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('reservations.show', $reservation->id) }}" 
                                            class="btn btn-info btn-sm shadow-sm" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('reservations.edit', $reservation->id) }}" 
                                            class="btn btn-warning btn-sm shadow-sm" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" 
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus reservasi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm shadow-sm" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
