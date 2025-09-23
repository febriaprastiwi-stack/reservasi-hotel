@extends('home.layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center my-4">OUR ROOMS</h2>
        <p class="text-center">20 Rooms Available</p>
        <div class="row">

            <!-- Rooms -->
            <div class="col-md-9">
                @foreach ($rooms as $room)
                    <div class="card mb-4">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $room->image) }}" class="img-fluid rounded-start"
                                    alt="Room">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5>{{ $room->name }} ({{ $room->number }})</h5>
                                    <p>Guests: {{ $room->capacity }}</p>
                                    <p>Fitur: {{ $room->features }}</p>
                                    <p>Fasilitas: {{ $room->facilities }}</p>
                                    <h6 class="text-success">IDR {{ number_format($room->harga, 0, ',', '.') }} / night</h6>
                                    <div class="d-flex">
                                    <a href="{{ route('home.reservations.create', ['room_id' => $room->id]) }}" 
                                        class="btn btn-outline-dark btn-sm w-50">Book Now</a>

                                        <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-dark">More details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
