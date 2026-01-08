<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - SD IT Baitul Insan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            --primary: #0d6efd;
            --primary-light: #e8f4ff;
            --primary-dark: #0b5ed7;
            --secondary: #6c757d;
            --success: #28a745;
            --success-light: #d4edda;
            --warning: #ffc107;
            --warning-light: #fff3cd;
            --danger: #dc3545;
            --danger-light: #f8d7da;
            --info: #17a2b8;
            --purple: #6f42c1;
            --gray-50: #f8f9fa;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --sidebar-width: 260px;
            --sidebar-collapsed: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: var(--gray-700);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== ADMIN CONTAINER ===== */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fb 0%, #f0f2f5 100%);
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1050;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
        }

        .sidebar-content {
            flex: 1;
            padding: 1.5rem 0;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }

        .sidebar-content::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .logo-wrapper {
            display: inline-block;
            position: relative;
            margin-bottom: 1rem;
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid rgba(59, 130, 246, 0.3);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        .logo-circle:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .logo-circle img {
            width: 38px;
            height: auto;
        }

        .school-name {
            font-size: 0.9rem;
            font-weight: 700;
            color: white;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            background: linear-gradient(90deg, #fff, #e0f2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .school-subtitle {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 400;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            display: inline-block;
        }

        /* Navigation Links */
        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.9rem;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #60a5fa;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-link:hover::before {
            transform: translateX(0);
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.2), rgba(96, 165, 250, 0.1));
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .nav-link.active::before {
            transform: translateX(0);
            background: #3b82f6;
        }

        .nav-link i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1rem;
            text-align: center;
        }

        .nav-text {
            flex: 1;
            font-weight: 500;
        }

        .badge-count {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            min-width: 20px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Sidebar Footer (Logout) */
        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
            background: rgba(0, 0, 0, 0.05);
        }

        .logout-btn {
            width: 100%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: white;
            padding: 0.75rem;
            border-radius: 10px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-1px);
        }

        /* ===== MAIN CONTENT AREA ===== */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        /* Topbar */
        .topbar {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1040;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .topbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title h1 {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-title i {
            color: var(--primary);
            background: var(--primary-light);
            padding: 0.5rem;
            border-radius: 10px;
            font-size: 1.2rem;
        }

        .datetime-info {
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .datetime-info>div {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 0.4rem 0.8rem;
            background: var(--gray-50);
            border-radius: 8px;
            border: 1px solid var(--gray-200);
        }

        .datetime-info i {
            color: var(--primary);
        }

        /* Main Content Area */
        .content-area {
            flex: 1;
            padding: 2rem;
            background-color: transparent;
        }

        /* ===== CARD STYLES ===== */
        .admin-card {
            background: white;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .admin-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .admin-card .card-header {
            background: transparent;
            border-bottom: 1px solid var(--gray-200);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: var(--gray-800);
            font-size: 1.1rem;
        }

        .admin-card .card-body {
            padding: 1.5rem;
        }

        .admin-card .card-footer {
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            padding: 1rem 1.5rem;
        }

        /* ===== BUTTON STYLES ===== */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
        }

        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* ===== TABLE STYLES ===== */
        .admin-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .admin-table thead {
            background: linear-gradient(90deg, var(--primary-light), #e3f2fd);
        }

        .admin-table th {
            font-weight: 600;
            color: var(--gray-700);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            padding: 1rem 1.25rem;
            border-bottom: 2px solid var(--primary-light);
        }

        .admin-table td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--gray-100);
        }

        .admin-table tbody tr {
            transition: all 0.2s ease;
        }

        .admin-table tbody tr:hover {
            background-color: var(--primary-light);
        }

        /* ===== BADGE STYLES ===== */
        .badge {
            padding: 0.35em 0.75em;
            font-weight: 600;
            font-size: 0.75rem;
            border-radius: 20px;
        }

        .badge-success {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
        }

        .badge-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: #212529;
        }

        .badge-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
        }

        .badge-info {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 992px) {
            .sidebar {
                width: var(--sidebar-collapsed);
                padding: 1rem 0.5rem;
            }

            .sidebar-content {
                padding: 0.5rem;
            }

            .school-name,
            .school-subtitle,
            .nav-text {
                display: none;
            }

            .logo-circle {
                width: 50px;
                height: 50px;
            }

            .logo-circle img {
                width: 28px;
            }

            .nav-link {
                padding: 0.75rem;
                justify-content: center;
                border-radius: 8px;
            }

            .nav-link i {
                margin: 0;
                font-size: 1.2rem;
            }

            .nav-link .badge-count {
                position: absolute;
                top: -5px;
                right: -5px;
                min-width: 18px;
                height: 18px;
                padding: 0;
                font-size: 0.6rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .main-content {
                margin-left: var(--sidebar-collapsed);
            }

            .topbar {
                padding: 1rem;
            }

            .content-area {
                padding: 1.25rem;
            }
        }

        @media (max-width: 768px) {
            .datetime-info {
                display: none;
            }

            .page-title h1 {
                font-size: 1.2rem;
            }

            .content-area {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .topbar {
                padding: 0.75rem;
            }

            .page-title {
                gap: 8px;
            }

            .page-title i {
                padding: 0.35rem;
                font-size: 1rem;
            }
        }

        /* ===== UTILITIES ===== */
        .animate-fade-in {
            animation: fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .animate-slide-up {
            animation: slideUp 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading animation */
        .loader {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid var(--gray-300);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, var(--primary), var(--purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Custom alerts */
        .alert-custom {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .alert-success {
            background: linear-gradient(135deg, var(--success-light), #d1f7e5);
            color: #155724;
            border-left: 4px solid var(--success);
        }

        .alert-warning {
            background: linear-gradient(135deg, var(--warning-light), #fff8e1);
            color: #856404;
            border-left: 4px solid var(--warning);
        }

        .alert-danger {
            background: linear-gradient(135deg, var(--danger-light), #ffe6e6);
            color: #721c24;
            border-left: 4px solid var(--danger);
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1, #e8f7fa);
            color: #0c5460;
            border-left: 4px solid var(--info);
        }
    </style>

    @stack('styles')
</head>

<body class="h-full">
    <div class="admin-wrapper">
        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-content">
                {{-- Logo & School Info --}}
                <div class="sidebar-header">
                    <div class="logo-wrapper">
                        <div class="logo-circle">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo SD IT Baitul Insan">
                        </div>
                    </div>
                    <div class="school-info mt-3">
                        <div class="school-name">SD IT BAITUL INSAN</div>
                        <div class="school-subtitle">
                            <i class="bi bi-shield-check me-1"></i> ADMIN PANEL
                        </div>
                    </div>
                </div>

                {{-- Navigation Menu --}}
                <ul class="nav-links">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.registrations.index') }}"
                            class="nav-link {{ request()->is('admin/ppdb*') ? 'active' : '' }}">
                            <i class="bi bi-person-plus"></i>
                            <span class="nav-text">PPDB</span>
                            @if ($stats['pending'] ?? 0 > 0)
                                <span class="badge-count">{{ $stats['pending'] ?? 0 }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.artikel.index') }}"
                            class="nav-link {{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-text"></i>
                            <span class="nav-text">Artikel</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.galeri.index') }}"
                            class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                            <i class="bi bi-images"></i>
                            <span class="nav-text">Galeri</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.prestasi.index') }}"
                            class="nav-link {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">
                            <i class="bi bi-trophy"></i>
                            <span class="nav-text">Prestasi</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.staff.index') }}"
                            class="nav-link {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span class="nav-text">Staff</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.tentang.index') }}"
                            class="nav-link {{ request()->routeIs('admin.tentang.*') ? 'active' : '' }}">
                            <i class="bi bi-building"></i>
                            <span class="nav-text">Profil</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.kegiatan.index') }}"
                            class="nav-link {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}">
                            <i class="bi bi-calendar-event"></i>
                            <span class="nav-text">Kegiatan</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Logout Section --}}
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-left"></i>
                        <span class="nav-text">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="main-content">
            {{-- Topbar --}}
            <header class="topbar">
                <div class="topbar-content">
                    <div class="page-title">
                        <i class="bi @yield('page-icon', 'bi-speedometer2')"></i>
                        <h1>@yield('page-title', 'Dashboard Admin')</h1>
                    </div>
                    <div class="datetime-info">
                        <div>
                            <i class="bi bi-calendar3 me-1"></i>
                            <span id="current-date">{{ now()->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div>
                            <i class="bi bi-clock me-1"></i>
                            <span id="current-time">{{ now()->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content Area --}}
            <main class="content-area">
                @if (session('success'))
                    <div class="alert alert-success alert-custom animate-slide-up mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-custom animate-slide-up mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Real-time Clock
        function updateRealTimeClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const dayName = days[now.getDay()];
            const date = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();

            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');

            document.getElementById('current-date').textContent = `${dayName}, ${date} ${monthName} ${year}`;
            document.getElementById('current-time').textContent = `${hours}:${minutes}`;
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Update clock immediately
            updateRealTimeClock();
            // Update every minute
            setInterval(updateRealTimeClock, 60000);

            // Logout confirmation
            document.getElementById('logoutForm')?.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi Logout',
                    text: "Anda yakin ingin keluar dari sistem?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'animate-fade-in'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.5s';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });

        // Global loading function
        function showLoading(element) {
            const originalHTML = element.innerHTML;
            element.innerHTML = '<span class="loader me-2"></span> Memproses...';
            element.disabled = true;
            return originalHTML;
        }

        function hideLoading(element, originalHTML) {
            element.innerHTML = originalHTML;
            element.disabled = false;
        }
    </script>

    @stack('scripts')
</body>

</html>
