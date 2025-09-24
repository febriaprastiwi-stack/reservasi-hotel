<div class="sidebar d-flex flex-column p-3 bg-dark text-white">
    <h4 class="text-center mb-4">GRAND ROYAL HOTEL</h4>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link text-white {{ request()->is('dashboard*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rooms.index') }}"
                class="nav-link text-white {{ request()->is('rooms*') ? 'active' : '' }}">
                <i class="bi bi-door-closed"></i> Kelola Kamar
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('fasilitas.index') }}"
                class="nav-link text-white {{ request()->is('fasilitas*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Kelola Fasilitas
            </a>
        </li>
    </ul>
    <hr>
    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        /* lebar sidebar */
        overflow-y: auto;
        z-index: 1020;
    }

    .content {
        margin-left: 250px;
        /* supaya konten geser ke kanan */
        padding: 80px 20px 20px;
        /* 80px biar tidak ketutup navbar */
    }
</style>
