@extends('home.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">History Booking</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($reservations->isEmpty())
        <div class="alert alert-info">Belum ada booking.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kamar</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Tamu</th>
                    <th>Pembayaran</th>
                    <th>Total Harga</th>
                    <th>Dipesan pada</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $index => $reservation)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $reservation->room->nama_kamar ?? '-' }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d/m/Y') }}</td>
                        <td>{{ $reservation->guests }}</td>
                        <td>{{ $reservation->payment_method }}</td>
                        <td>Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                        <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
