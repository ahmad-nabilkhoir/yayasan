<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Superadmin Panel')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fc;
        }

        .sidebar {
            height: 100vh;
            background: #2c3e50;
            color: white;
        }

        .sidebar a {
            color: #ecf0f1;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #34495e;
        }

        .main-content {
            background: #f8f9fc;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="mb-4 text-center">Superadmin</h4>
            <a href="{{ route('superadmin.dashboard') }}"
                class="{{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a href="{{ route('profile.edit') }}">
                <i class="fas fa-user me-2"></i> Profil Saya
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
