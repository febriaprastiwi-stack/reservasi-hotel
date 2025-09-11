@extends('layouts.app)

@section('title', 'Dashboard Admin')

@section('content')

    <div class="row">
        {{-- Statistik --}}
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Reservasi Bulan Ini</h6>
                <h4 class="text-primary">{{ $reservasi_bulan_ini }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Kamar Tersedia</h6>
                <h4 class="text-success">{{ $kamar_tersedia }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Total Customer</h6>
                <h4 class="text-info">{{ $total_customer }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Total Pendapatan</h6>
                <h4 class="text-warning">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- Grafik Reservasi --}}
        <div class="col-md-8">
            <div class="card p-3">
                <h6>Grafik Reservasi per Bulan</h6>
                <canvas id="reservasiChart"></canvas>
            </div>
        </div>

        {{-- Pie Chart Kamar --}}
        <div class="col-md-4">
            <div class="card p-3">
                <h6>Status Kamar</h6>
                <canvas id="kamarChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Data dari Laravel (Controller)
        const reservasiBulanan = @json($reservasi_bulanan); // array angka 12 bulan
        const statusKamar = @json($status_kamar); // contoh: ['Tersedia' => 30, 'Terisi' => 15]

        // Grafik Reservasi per Bulan
        new Chart(document.getElementById('reservasiChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Reservasi',
                    data: reservasiBulanan,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                }]
            }
        });

        // Grafik Status Kamar
        new Chart(document.getElementById('kamarChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(statusKamar),
                datasets: [{
                    data: Object.values(statusKamar),
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            }
        });
    </script>
@endsection
