@extends('layouts.guest')

@section('title', 'Login')
@section('content')

    <div class="auth-header">
        <div class="brand-logo">
            <i class="bi-clipboard-check"></i>
        </div>
        <h1 class="h3 mb-2 fw-bold">Absensi Desa</h1>
        <p class="text-muted"></p>
    </div>

    <form id="loginForm" novalidate method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" class="form-control" id="username" name="email" placeholder="Masukkan email" value="{{ old('email') }}"
                    required aria-label="Email Address" aria-describedby="emailHelp" required>
            </div>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" value="{{ old('password') }}"
                    required aria-label="Password" aria-describedby="passwordHelp" required>
            </div>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg" type="submit">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Log in
            </button>
        </div>
    </form>
@endsection
