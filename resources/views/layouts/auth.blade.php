<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Edukasi Anemia') }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Custom styling for branding -->
    <style>
        body {
            background: linear-gradient(135deg, #f9f7fe, #eef2ff);
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .auth-card {
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            max-width: 460px;
            width: 100%;
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            background-color: #e0e7ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.8rem;
            color: #4f46e5;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            border-color: #4338ca;
        }
    </style>
</head>

<body class="d-flex align-items-center py-5">
    <div class="container">
        <div class="auth-card p-sm-5 mx-auto bg-white p-4">
            <div class="brand-logo">A+</div>
            <h2 class="fw-bold mb-1 text-center">Halo!</h2>
            <p class="text-muted mb-4 text-center">Masuk untuk melanjutkan</p>

            @yield('content')
        </div>

        <div class="text-muted small mt-4 text-center">
            &copy; {{ date('Y') }} Edukasi Pencegahan Anemia. All rights reserved.
        </div>
    </div>

    <!-- Bootstrap JS (for form validation feedback, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
