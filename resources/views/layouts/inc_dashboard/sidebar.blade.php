<div class="d-flex flex-column p-3 sidebar shadow" 
     style="height: calc(100vh - 60px); width: 207px; position: fixed; top: 63px; left: 0; border-radius: 0 12px 12px 0; overflow-y: auto;">
    <h4 class="text-white mb-4">Menu</h4>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('reservations.index') }}" class="nav-link text-white {{ request()->is('reservations*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check me-2"></i> Reservations
            </a>
        </li>
        <li>
            <a href="{{ url('/pendapatan') }}" class="nav-link text-white {{ request()->is('pendapatan*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line me-2"></i> Pendapatan
            </a>
        </li>
    </ul>
</div>
