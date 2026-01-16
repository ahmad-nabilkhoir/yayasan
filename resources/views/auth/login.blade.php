@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required autofocus placeholder="contoh@email.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required placeholder="••••••••">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>

        <!-- Submit Button -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Masuk</button>
        </div>

        <!-- Forgot Password -->
        @if (Route::has('password.request'))
            <div class="text-center">
                <a href="{{ route('password.request') }}" class="text-decoration-none small">
                    Lupa kata sandi?
                </a>
            </div>
        @endif
    </form>
@endsection
