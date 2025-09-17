{{-- resources/views/home/rooms/index.blade.php --}}
@extends('home.layouts.app')

@section('title', 'Our Rooms')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4">OUR ROOMS</h2>
        <p class="text-center text-muted">{{ $rooms->count() }} Rooms Available</p>

        <div class="row">
            {{-- Sidebar Filter --}}
            <div class="col-md-3 mb-4">
                <div class="card p-3 shadow-sm">
                    <h5 class="mb-3">FILTERS</h5>

                    <form method="GET" action="{{ route('rooms.index') }}">
                        {{-- Check availability --}}
                        <div class="mb-3">
                            <label class="form-label">Check-in</label>
                            <input type="date" name="checkin" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Check-out</label>
                            <input type="date" name="checkout" class="form-control">
                        </div>

                        {{-- Person --}}
                        <div class="mb-3">
                            <label class="form-label">How many person?</label>
                            <input type="number" name="person" class="form-control" value="1" min="1">
                        </div>

                        <button type="submit" class="btn btn-dark w-100">SEARCH</button>
                    </form>
                </div>
            </div>

            {{-- Room List --}}
            <div class="col-md-9">
                <div class="row">
                    @forelse ($rooms as $room)
                        <div class="col-md-12 mb-4">
                            <div class="card shadow-sm">
                                <div class="row g-0">
                                    {{-- Gambar kamar --}}
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/' . $room->image) }}" class="img-fluid rounded-start"
                                            alt="{{ $room->name }}">
                                    </div>

                                    {{-- Detail kamar --}}
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $room->name }} ({{ $room->room_number }})</h5>
                                            <p class="mb-1"><strong>Guests:</strong> {{ $room->capacity }}</p>
                                            <p class="mb-1"><strong>Features:</strong> {{ $room->features }}</p>
                                            <p class="mb-1"><strong>Facilities:</strong> {{ $room->facilities }}</p>
                                            <p class="text-success fw-bold">IDR
                                                {{ number_format($room->price, 0, ',', '.') }}</p>

                                            <div class="d-flex gap-2">
                                                <a href="{{ route('reservations.create', $room->id) }}"
                                                    class="btn btn-outline-dark btn-sm">Book Now</a>
                                                <a href="{{ route('rooms.show', $room->id) }}"
                                                    class="btn btn-dark btn-sm">More details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No rooms available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
