@extends('layouts.app')

@section('title', 'Reservation Detail')

@section('content')
<div class="container-fluid min-vh-100 bg-white" style="padding-top: 80px;">
    <h2 class="mb-4 text-center fw-bold text-primary">Reservation Detail</h2>

    <div class="card shadow-lg border-0 rounded-4 p-4 mx-auto" style="max-width: 1000px;">
        <div class="row g-4 align-items-start">
            
            {{-- Kolom Gambar --}}
            <div class="col-md-5 text-center">
                @if ($reservation->room && $reservation->room->gambar_kasur)
                    <img src="{{ asset('storage/' . $reservation->room->gambar_kasur) }}" 
                         alt="{{ $reservation->room->jenis_kamar }}" 
                         class="img-fluid rounded shadow-sm" 
                         style="max-height: 240px; object-fit: cover; width:100%;">
                @else
                    <img src="{{ asset('images/no-image.png') }}" 
                         alt="No Image" 
                         class="img-fluid rounded shadow-sm" 
                         style="max-height: 240px; object-fit: cover; width:100%;">
                @endif
            </div>

            {{-- Kolom Informasi --}}
            <div class="col-md-7">
                <h5 class="fw-bold mb-3 text-secondary">Reservation Information</h5>
                <table class="table table-borderless mb-3">
                    <tr>
                        <th class="text-muted" style="width: 160px;">Room :</th>
                        <td>{{ $reservation->room->jenis_kamar ?? '-' }} (No. {{ $reservation->room->nomor_kamar ?? '' }})</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Name :</th>
                        <td>{{ $reservation->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Email :</th>
                        <td>{{ $reservation->email }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Check-in :</th>
                        <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Check-out :</th>
                        <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Guests :</th>
                        <td>{{ $reservation->guests }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Total Price :</th>
                        <td class="fw-bold text-success">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Payment :</th>
                        <td>{{ $reservation->payment ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Status :</th>
                        <td>
                            @if ($reservation->status == 'active')
                                <span class="badge bg-success px-3 py-2">Active</span>
                            @elseif ($reservation->status == 'canceled')
                                <span class="badge bg-danger px-3 py-2">Canceled</span>
                            @elseif ($reservation->status == 'completed')
                                <span class="badge bg-primary px-3 py-2">Completed</span>
                            @else
                                <span class="badge bg-secondary px-3 py-2">{{ ucfirst($reservation->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Booked At :</th>
                        <td>{{ $reservation->created_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>

                {{-- Fasilitas Kamar --}}
                <h5 class="fw-bold text-secondary mb-3">Room Facilities</h5>
                <ul class="list-unstyled d-flex flex-wrap gap-3">
                    @if ($reservation->room && $reservation->room->fasilitas_kamar)
                        @foreach (explode(',', $reservation->room->fasilitas_kamar) as $fasilitas)
                            <li class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success me-2"></i> 
                                {{ trim($fasilitas) }}
                            </li>
                        @endforeach
                    @else
                        <li class="text-muted">No facilities listed.</li>
                    @endif
                </ul>

                {{-- Tombol Aksi --}}
                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm shadow-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="{{ route('reservations.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
