<div class="d-flex flex-column p-3 bg-light" style="width: 220px; height: 100vh;">
    <h5 class="mb-4">Menu</h5>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pages.dashboard.ketersediaan_kamar.index') }}" class="nav-link">Ketersediaan Kamar</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('reservations.index') }}" class="nav-link">Daftar Reservasi</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('payments.report') }}" class="d-block text-white mb-2">Laporan Pembayaran</a>
        </li>
    </ul>
</div>
