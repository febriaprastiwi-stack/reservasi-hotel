@extends('home.layouts.app')

@section('title', 'Book Room')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-center bg-dark text-white rounded-top-4">
                    <h4 class="mb-0">Book Room</h4>
                </div>
                <div class="card-body p-4">

                    {{-- Info Kamar --}}
                    <div class="alert alert-info text-center mb-3 rounded-3">
                        Booking for: <strong>{{ $room->jenis_kamar }} ({{ $room->nomor_kamar }})</strong>
                    </div>

                    {{-- Harga per Malam --}}
                    <div class="card bg-light shadow-sm border-0 mb-4">
                        <div class="card-body text-center">
                            <h6 class="mb-1 text-muted">Price per Night</h6>
                            <h4 class="fw-bold text-dark">
                                {{ number_format($room->harga_per_malam, 0, ',', '.') }} IDR
                            </h4>
                        </div>
                    </div>

                    <form action="{{ route('home.reservations.store') }}" method="POST">
                        @csrf


                        {{-- Full Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" 
                                   class="form-control rounded-3" 
                                   value="{{ old('name', auth()->user()->name ?? '') }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" 
                                   class="form-control rounded-3" 
                                   value="{{ old('email', auth()->user()->email ?? '') }}" required>
                        </div>

                        <div class="row">
                            {{-- Check-in --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Check-in</label>
                                <input type="date" name="check_in" 
                                       class="form-control rounded-3" required>
                            </div>
                            {{-- Check-out --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Check-out</label>
                                <input type="date" name="check_out" 
                                       class="form-control rounded-3" required>
                            </div>
                        </div>

                        {{-- Guests --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Guests</label>
                            <input type="number" name="guests" 
                                   class="form-control rounded-3" 
                                   min="1" value="1" required>
                        </div>

                        {{-- Total Price --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Total Price</label>
                            <input type="text" id="total_price_display" 
                                   class="form-control rounded-3 bg-light" value="Rp 0" readonly>
                        </div>

                        {{-- Payment Method --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Payment Method</label>
                            <select name="payment" class="form-select rounded-3" required>
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

                        <button type="submit" class="btn btn-dark w-100 rounded-3 py-2">
                            <i class="bi bi-check-circle me-2"></i>Confirm Booking
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const checkInInput = document.querySelector('input[name="check_in"]');
    const checkOutInput = document.querySelector('input[name="check_out"]');
    const pricePerNight = parseInt("{{ $room->harga_per_malam }}");

    function hitungTotal() {
        let checkIn = new Date(checkInInput.value);
        let checkOut = new Date(checkOutInput.value);

        if (checkIn && checkOut) {
            // Hitung selisih hari
            let diffTime = checkOut - checkIn;
            let nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            // Minimal 1 malam, meskipun tanggal sama
            if (nights <= 0) {
                nights = 1;
            }

            let total = nights * pricePerNight;

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
@endsection