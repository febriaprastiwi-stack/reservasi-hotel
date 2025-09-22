<div class="d-flex flex-column p-3 bg-light" style="height: 100vh;">
    <h5 class="mb-4">Menu</h5>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('home.reservations.index') }}"
                class="nav-link {{ request()->is('reservations*') ? 'active' : '' }}">
                Daftar Reservasi
            </a>
        </li>
    </ul>
</div>
