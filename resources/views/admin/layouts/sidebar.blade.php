<div class="sidebar d-flex flex-column p-3 shadow-lg">
    <!-- Logo / Brand -->
    <div class="d-flex align-items-center justify-content-center mb-4 sidebar-brand-wrapper">
        <img src="{{ asset('img/logo.jpg') }}" alt="Hotel Logo" class="sidebar-logo me-2">
        <span class="sidebar-brand-text fw-bold">GRAND ROYAL HOTEL</span>
    </div>
    <hr class="sidebar-divider">

    <!-- Navigation -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link sidebar-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('rooms.index') }}"
               class="nav-link sidebar-link {{ request()->is('rooms*') ? 'active' : '' }}">
                <i class="bi bi-door-closed me-2"></i> Kelola Kamar
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('fasilitas.index') }}"
               class="nav-link sidebar-link {{ request()->is('fasilitas*') ? 'active' : '' }}">
                <i class="bi bi-building me-2"></i> Kelola Fasilitas
            </a>
        </li>
    </ul>
    <hr class="sidebar-divider">

    <!-- Logout -->
    <div class="mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn w-100 sidebar-logout fw-bold">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>
</div>

<style>
    /* Sidebar Container - Soft Cream */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        background: rgba(255, 250, 240, 0.85); /* soft cream */
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-right: 1px solid rgba(212, 175, 55, 0.2);
        border-radius: 0 20px 20px 0;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        display: flex;
        flex-direction: column;
        padding: 1.5rem;
        transition: all 0.3s ease;
        color: #1e1e2f;
    }

    /* Logo + Brand Flex */
    .sidebar-brand-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .sidebar-logo {
        width: 50px;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
        margin-right: 10px;
    }

    .sidebar-logo:hover {
        transform: scale(1.05);
    }

    .sidebar-brand-text {
        font-size: 1.2rem;
        font-weight: 700;
        color: #d4af37; /* gold */
        text-shadow: 0 0 6px rgba(212, 175, 55, 0.5);
        letter-spacing: 1px;
    }

    /* Sidebar Links */
    .sidebar-link {
        color: #1e1e2f;
        font-weight: 500;
        padding: 12px 20px;
        border-radius: 30px;
        margin: 6px 0;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .sidebar-link i {
        font-size: 1.2rem;
    }

    .sidebar-link:hover {
        background: rgba(212, 175, 55, 0.15);
        color: #d4af37;
        transform: translateX(5px);
    }

    .sidebar-link.active {
        background: #d4af37; /* gold highlight */
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
    }

    /* Logout Button */
    .sidebar-logout {
        background: #e74c3c;
        border: none;
        color: #fff;
        border-radius: 30px;
        padding: 10px 15px;
        transition: 0.3s ease;
    }

    .sidebar-logout:hover {
        background: #ff6b6b;
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(231, 76, 60, 0.3);
    }

    /* Divider */
    .sidebar-divider {
        border-top: 1px solid rgba(212, 175, 55, 0.2);
        margin: 1rem 0;
    }

    /* Konten geser kanan */
    .content {
        margin-left: 260px;
        padding: 80px 20px 20px;
    }

    /* Responsif */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            border-radius: 0;
        }
        .content {
            margin-left: 0;
            padding-top: 20px;
        }
        .sidebar-logo {
            width: 40px;
        }
        .sidebar-brand-text {
            font-size: 1rem;
        }
    }
</style>
