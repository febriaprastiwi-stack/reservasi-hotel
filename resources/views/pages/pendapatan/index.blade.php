@extends('layouts.app')

@section('title', 'Pendapatan - Grand Royal Hotel')

@section('content')
<div class="container-fluid" style="margin-left: 0px; padding-top: 80px;">
    <h2 class="mb-4 fw-bold text-primary">📑 Laporan Pendapatan</h2>

    <!-- Row Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary p-3">
                <h6>Reservasi Bulan Ini</h6>
                <h4>{{ $reservasi_bulan_ini }}</h4>
            </div>
        </div>
        <div class="col-md-3">                 
            <div class="card text-white bg-success p-3">
                <h6>Total Pendapatan</h6>
                <h4>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning p-3">
                <h6>Kamar Tersedia</h6>
                <h4>{{ $kamar_tersedia }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger p-3">
                <h6>Kamar Terisi</h6>
                <h4>{{ $status_kamar['Terisi'] }}</h4>
            </div>
        </div>
    </div>

    <!-- Row Charts -->
    <div class="row">
        <div class="col-md-8">
            <div class="card p-3">
                <h6>📊 Grafik Reservasi Bulanan</h6>
                <canvas id="reservasiChart"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h6>💰 Sumber Pendapatan</h6>
                <canvas id="pendapatanChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Reservasi Bulanan
    var ctx1 = document.getElementById('reservasiChart').getContext('2d');
    var reservasiChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [{
                label: 'Jumlah Reservasi',
                data: @json($reservasi_bulanan),
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Grafik Sumber Pendapatan
    var ctx2 = document.getElementById('pendapatanChart').getContext('2d');
    var pendapatanChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Kamar', 'Makanan', 'Event', 'Lainnya'],
            datasets: [{
                label: 'Pendapatan',
                data: [60, 25, 10, 5], // ini bisa diganti dari controller kalau mau dinamis
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ]
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1500,
                easing: 'easeOutBounce'
            }
        }
    });
</script>
@endpush
