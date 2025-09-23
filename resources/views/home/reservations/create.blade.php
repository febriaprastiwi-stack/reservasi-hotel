@extends('home.layouts.app')

@section('title', 'Book Room')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Book Room</h2>

    <div class="card shadow-sm p-4">
        <div class="alert alert-info">
            Booking for: <strong>{{ $room->jenis_kamar }} ({{ $room->nomor_kamar }})</strong>
        </div>

        <form action="{{ route('home.reservations.store') }}" method="POST">
            @csrf

            {{-- Full Name --}}
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name ?? '') }}" required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}" required>
            </div>

            {{-- Check-in --}}
            <div class="mb-3">
                <label class="form-label">Check-in</label>
                <input type="date" name="check_in" class="form-control" required>
            </div>

            {{-- Check-out --}}
            <div class="mb-3">
                <label class="form-label">Check-out</label>
                <input type="date" name="check_out" class="form-control" required>
            </div>

            {{-- Guests --}}
            <div class="mb-3">
                <label class="form-label">Guests</label>
                <input type="number" name="guests" class="form-control" min="1" value="1" required>
            </div>

            {{-- Total Price --}}
            <div class="mb-3">
            <label class="form-label">Total Price</label>
            {{-- Untuk ditampilkan ke user (readonly) --}}
            <input type="text" id="total_price_display" class="form-control" value="Rp 0" readonly>

            {{-- Payment Method --}}
            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <select name="payment" class="form-select" required>
                    <option value="">-- Select Payment Method --</option>
                    <option value="transfer">Bank Transfer</option>
                    <option value="ewallet">E-Wallet (OVO, Gopay, Dana)</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="cash">Pay at Hotel</option>
                </select>
            </div>

            {{-- Hidden data --}}
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" id="price_per_night" value="{{ $room->harga_per_malam }}">
            <input type="hidden" name="total_price" id="total_price">

            <button type="submit" class="btn btn-dark w-100">Confirm Booking</button>
        </form>

@push('scripts')
<script>
    const checkInInput = document.querySelector('input[name="check_in"]');
    const checkOutInput = document.querySelector('input[name="check_out"]');
    const pricePerNight = parseInt("{{ $room->harga_per_malam }}");

    function hitungTotal() {
        let checkIn = new Date(checkInInput.value);
        let checkOut = new Date(checkOutInput.value);

        if (checkIn && checkOut && checkOut > checkIn) {
            let diffTime = Math.abs(checkOut - checkIn);
            let nights = Math.max(1, Math.ceil(diffTime / (1000 * 60 * 60 * 24)));

            let total = nights * pricePerNight;

            // Format rupiah
            let formatted = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(total);

            document.getElementById('total_price_display').value = formatted;
            document.getElementById('total_price').value = total;
        } else {
            document.getElementById('total_price_display').value = "Rp 0";
            document.getElementById('total_price').value = 0;
        }
    }

    checkInInput.addEventListener('change', hitungTotal);
    checkOutInput.addEventListener('change', hitungTotal);
</script>
@endpush

</div>
</div>
@endsection
