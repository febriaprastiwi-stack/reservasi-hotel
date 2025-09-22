@extends('home.layouts.app')

@section('title', 'Our Rooms')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">OUR ROOMS</h2>
    <p class="text-center text-muted">{{ $rooms->count() }} Rooms Available</p>

    <div class="row">
    {{-- Sidebar Filter --}}
    <div class="col-md-3 mb-4">
        <div class="card p-3 shadow-sm sticky-top" style="top: 80px; z-index: 100;">
            <h5 class="mb-3">FILTERS</h5>
            <form method="GET" action="{{ route('home.rooms.index') }}">
                <div class="mb-3">
                    <label class="form-label">Check-in</label>
                    <input type="date" name="check_in" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Check-out</label>
                    <input type="date" name="check_out" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">How many person?</label>
                    <input type="number" name="person" class="form-control" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-dark w-100">SEARCH</button>
            </form>
        </div>
    </div>

        {{-- Room Grid --}}
        <div class="col-md-9">
            <div class="row">
                @forelse ($rooms as $room)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            {{-- Gambar kamar --}}
                            @if ($room->gambar_kasur)
                                <img src="{{ asset('storage/' . $room->gambar_kasur) }}" 
                                     class="card-img-top room-image" 
                                     alt="{{ $room->jenis_kamar }}">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" 
                                     class="card-img-top room-image" 
                                     alt="No Image">
                            @endif

                            {{-- Detail kamar --}}
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $room->jenis_kamar }}</h5>
                                <p class="mb-1"><strong>No:</strong> {{ $room->nomor_kamar }}</p>
                                <p class="mb-1"><strong>Beds:</strong> {{ $room->jumlah_kasur }}</p>
                                <p class="mb-1"><strong>Fasilitas:</strong> {{ $room->fasilitas_kamar ?? '-' }}</p>
                                <p class="mb-1"><strong>Fitur:</strong> {{ $room->features }}</p>
                                <p class="mb-2 text-success fw-bold">Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }} / night</p>

                                <div class="mt-auto d-flex gap-2">
                                    {{-- Booking --}}
                                    <a href="{{ route('home.reservations.create', ['room_id' => $room->id]) }}" 
                                       class="btn btn-outline-dark btn-sm w-50">Book Now</a>
                                    {{-- Detail kamar --}}
                                    <a href="{{ route('home.rooms.show', $room->id) }}" 
                                       class="btn btn-dark btn-sm w-50">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center">No rooms available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- CSS Custom biar gambar rapi --}}
<style>
    .room-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-top-left-radius: .375rem;
        border-top-right-radius: .375rem;
    }
</style>
@endsection
