@extends('layouts.app')

@section('title', 'Dashboard - Grand Royal Hotel')

@section('content')
    <div class="container-flui**d" style="margin-left: 0px; padding-top: 80px;">
    <h2 class="mb-4 fw-bold text-primary">📊 Dashboard</h2>

    <!-- Row Cards -->
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary p-3">
                <h6>Total Reservasi</h6>
                <h4>120</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success p-3">
                <h6>Total Pendapatan</h6>
                <h4>Rp 85.000.000</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning p-3">
                <h6>Kamar Tersedia</h6>
                <h4>45</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger p-3">
                <h6>Kamar Terpakai</h6>
                <h4>75</h4>
            </div>
        </div>
    </div>

    <!-- Row Charts -->
    <div class="row">
        <div class="col-md-8">
            <div class="card p-3">
                <h6>Earnings Overview</h6>
                <canvas id="earningsChart"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h6>Revenue Sources</h6>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Chart 1: Earnings per Month
        var ctx1 = document.getElementById('earningsChart').getContext('2d');
        var earningsChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Earnings (Rp)',
                    data: [2000000, 4000000, 4000000, 6000000, 2000000, 3000000, 5000000, 4000000, 4500000,
                        3000000, 3500000, 5000000
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.6)'
                }]
            }
        });

        // Chart 2: Revenue Sources
        var ctx2 = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Room', 'Food', 'Event', 'Other'],
                datasets: [{
                    label: 'Revenue',
                    data: [60, 25, 10, 5],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ]
                }]
            }
        });
    </script>
@endpush
