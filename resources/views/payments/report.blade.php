@extends('layouts.app')

@section('title', 'Laporan Pembayaran Bulanan')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">📊 Laporan Pembayaran Bulanan</h2>

        {{-- Filter Form --}}
        <form action="{{ route('payments.report') }}" method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}">
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('payments.report') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        {{-- Grafik Chart.js --}}
        <canvas id="paymentChart" height="100"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('paymentChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($months),
                    datasets: [{
                        label: 'Total Pembayaran (Rp)',
                        data: @json($totals),
                        borderWidth: 1,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        </script>

        {{-- Tabel Detail Pembayaran --}}
        <div class="mt-5">
            <h4>Detail Semua Pembayaran</h4>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Reservasi</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allPayments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->reservation->customer->name ?? '-' }}</td>
                            <td>#{{ $payment->reservation_id }}</td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($payment->payment_method) }}</td>
                            <td>
                                @if ($payment->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-danger">Unpaid</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pembayaran</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
