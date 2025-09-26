<div class="sidebar d-flex flex-column p-3 text-white shadow-lg">
    <!-- Logo / Brand -->
    <h4 class="text-center fw-bold mb-4 sidebar-brand">
        <i class="bi bi-gem"></i> GRAND ROYAL HOTEL
    </h4>
    <hr class="border-light">

    <!-- Navigation -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link sidebar-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rooms.index') }}"
               class="nav-link sidebar-link {{ request()->is('rooms*') ? 'active' : '' }}">
                <i class="bi bi-door-closed"></i> Kelola Kamar
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('fasilitas.index') }}"
               class="nav-link sidebar-link {{ request()->is('fasilitas*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Kelola Fasilitas
            </a>
        </li>
    </ul>
    <hr class="border-light">

    <!-- Logout -->
    <div class="mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn w-100 sidebar-logout fw-bold">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>

<style>
    /* Sidebar Container */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        background: linear-gradient(180deg, #1b1b1b, #2a2a2a);
    
    }

    /* Brand / Logo */
    .sidebar-brand {
        color: #d4af37;
        text-shadow: 0 0 8px rgba(212, 175, 55, 0.7);
        letter-spacing: 1px;
    }

    /* Links */
    .sidebar-link {
        color: #ddd;
        font-weight: 500;
        padding: 12px 15px;
        border-radius: 30px;
        margin: 5px 0;
        transition: all 0.3s ease;
    }

    /* Hover efek */
    .sidebar-link:hover {
        background: rgba(212, 175, 55, 0.1);
        color: #d4af37;
        transform: translateX(5px);
    }

    /* Aktif menu */
    .sidebar-link.active {
        background: linear-gradient(90deg, #d4af37, #b8860b);
        color: #fff !important;
        font-weight: 600;
        box-shadow: 0 3px 10px rgba(212, 175, 55, 0.5);
    }

    /* Logout Button */
    .sidebar-logout {
        background: linear-gradient(135deg, #c0392b, #e74c3c);
        border: none;
        color: #fff;
        border-radius: 30px;
        transition: 0.3s ease;
    }

    .sidebar-logout:hover {
        background: linear-gradient(135deg, #e74c3c, #ff6b6b);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(231, 76, 60, 0.5);
    }

    /* Konten agar geser ke kanan */
    .content {
        margin-left: 260px;
        padding: 80px 20px 20px;
    }
</style>
