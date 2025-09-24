@extends('home.layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white text-center">
            <h4 class="mb-0">Pemesanan Berhasil!</h4>
        </div>
        <div class="card-body text-center">

            {{-- Pesan sukses dari session --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($reservation)
                <h5 class="mb-3">Detail Pemesanan Anda</h5>

                <ul class="list-group mb-4 text-start">
                    <li class="list-group-item">
                        <strong>Kamar:</strong> {{ $reservation->room->nama_kamar ?? '-' }}
                    </li>
                    <li class="list-group-item">
                        <strong>Nama:</strong> {{ $reservation->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong> {{ $reservation->email }}
                    </li>
                    <li class="list-group-item">
                        <strong>Check-In:</strong> {{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Check-Out:</strong> {{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Tamu:</strong> {{ $reservation->guests }} orang
                    </li>
                    <li class="list-group-item">
                        <strong>Metode Pembayaran:</strong> {{ ucfirst($reservation->payment) }}
                    </li>
                    <li class="list-group-item">
                        <strong>Total Harga:</strong> Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Tanggal Pemesanan:</strong> {{ $reservation->created_at->format('d M Y H:i') }}
                    </li>
                </ul>

                <a href="{{ route('home.rooms.index') }}" class="btn btn-primary">
                    Pesan Lagi
                </a>
                <a href="{{ route('home.rooms.index') }}" class="btn btn-outline-secondary">
                    Kembali ke Beranda
                </a>

            @else
                <p class="text-muted">Tidak ada data pemesanan ditemukan.</p>
            @endif
        </div>
    </div>
</div>
@endsection
