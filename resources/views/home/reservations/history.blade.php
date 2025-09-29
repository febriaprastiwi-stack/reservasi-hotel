@extends('home.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                <div class="card-header bg-success text-white text-center py-4">
                    <h3 class="mb-0">
                        <i class="bi bi-check-circle-fill me-2"></i> Pemesanan Berhasil!
                    </h3>
                    <p class="mb-0">Terima kasih telah memesan di Hotel Kami</p>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success text-center fw-bold mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($reservation)
                    <div class="row g-4">
                        {{-- Kolom Gambar --}}
                        <div class="col-md-5">
                            <div class="card border-0 h-100 shadow-sm">
                                @if ($reservation->room && $reservation->room->gambar_kasur)
                                    <img src="{{ asset('storage/' . $reservation->room->gambar_kasur) }}" 
                                         class="img-fluid rounded-start h-100 w-100"
                                         alt="{{ $reservation->room->jenis_kamar }}"
                                         style="object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" 
                                         class="img-fluid rounded-start h-100 w-100"
                                         alt="No Image"
                                         style="object-fit: cover;">
                                @endif
                            </div>
                        </div>

                        {{-- Kolom Detail --}}
                        <div class="col-md-7">
                            <h5 class="fw-bold text-secondary text-uppercase mb-3">Detail Pemesanan</h5>

                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <th class="text-muted w-25"><i class="bi bi-door-closed me-2"></i>Kamar :</th>
                                        <td>
                                            {{ $reservation->room->jenis_kamar ?? '-' }} 
                                            ({{ $reservation->room->nomor_kamar ?? '' }})
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-person-fill me-2"></i>Nama :</th>
                                        <td>{{ $reservation->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-envelope-fill me-2"></i>Email :</th>
                                        <td>{{ $reservation->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-calendar-check me-2"></i>Check-In :</th>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-calendar-x me-2"></i>Check-Out :</th>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-people-fill me-2"></i>Tamu :</th>
                                        <td>{{ $reservation->guests }} orang</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-wallet2 me-2"></i>Pembayaran :</th>
                                        <td>{{ ucfirst($reservation->payment) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-cash-coin me-2"></i>Total Harga :</th>
                                        <td class="fw-bold text-success fs-5">
                                            Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted"><i class="bi bi-clock-history me-2"></i>Pemesanan :</th>
                                        <td>{{ $reservation->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <a href="{{ route('home.rooms.index') }}" class="btn btn-primary btn-lg me-2">
                            <i class="bi bi-plus-circle me-1"></i> Pesan Lagi
                        </a>
                        <a href="{{ route('home.rooms.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
                        </a>
                    </div>

                    @else
                        <p class="text-muted text-center">Tidak ada data pemesanan ditemukan.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection