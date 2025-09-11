@extends('layouts.app')

@section('title', 'Tambah Reservasi')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Tambah Reservasi</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    <option value="">-- Pilih Customer --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="room_id" class="form-label">Kamar</label>
                <select name="room_id" id="room_id" class="form-control" required>
                    <option value="">-- Pilih Kamar --</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }} - Rp
                            {{ number_format($room->price, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="check_in" class="form-label">Check In</label>
                <input type="date" name="check_in" id="check_in" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="check_out" class="form-label">Check Out</label>
                <input type="date" name="check_out" id="check_out" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga</label>
                <input type="number" name="total_harga" id="total_harga" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
