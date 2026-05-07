@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="mb-3">
            <h1 class="h3 font-bold">Edit Profil</h1>
            <p class="text-muted text-sm">Kelola informasi akun Anda, termasuk nama, email, dan password. Pastikan data Anda
                selalu terbaru untuk pengalaman terbaik di platform kami.
            </p>
        </div>

        {{-- ✅ ALERT PROFIL --}}
        @if (session('status') === 'profile-updated')
            <div class="alert alert-success" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                Profil berhasil diperbarui!
            </div>
        @endif

        {{-- ===================== --}}
        {{-- FORM EDIT PROFIL --}}
        {{-- ===================== --}}
        <form action="{{ route('profile.update') }}" method="POST" class="mb-5">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="namaGroup" class="form-label">Nama</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text" class="form-control" id="namaGroup" placeholder="nama" name="name"
                        value="{{ old('name', $user->name) }}" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="emailGroup" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" class="form-control" id="emailGroup" placeholder="email" name="email"
                        value="{{ old('email', $user->email) }}" required>
                </div>
            </div>

            <button class="btn btn-primary">Simpan Profil</button>
        </form>


        {{-- ===================== --}}
        {{-- ALERT PASSWORD --}}
        {{-- ===================== --}}
        @if (session('status') === 'password-updated')
            <div class="alert alert-success" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                password berhasil diperbarui!
            </div>
        @endif

        {{-- ===================== --}}
        {{-- FORM GANTI PASSWORD --}}
        {{-- ===================== --}}
        <h3>Ganti Password</h3>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('put')

            {{-- <div class="mb-3">
                <label>Password Lama</label>
                <input type="password" name="current_password" class="form-control" value="{{ old('current_password') }}"
                    required>
                @error('current_password', 'updatePassword')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div> --}}

            <div class="form-group">
                <label for="passwordlamaGroup" class="form-label">Password Lama</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" class="form-control" id="passwordlamaGroup" placeholder="Password Lama"
                        name="current_password" value="{{ old('current_password') }}" required>
                </div>
                
                @error('current_password', 'updatePassword')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="passwordbaruGroup" class="form-label">Password Baru</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" class="form-control" id="passwordbaruGroup" placeholder="Password Baru"
                        name="password" value="{{ old('password') }}" required>
                    @error('password', 'updatePassword')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="passwordkonfirmasiGroup" class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" class="form-control" id="passwordkonfirmasiGroup"
                        placeholder="Konfirmasi Password" name="password_confirmation"
                        value="{{ old('password_confirmation') }}" required>
                </div>
            </div>

            <button class="btn btn-warning">Ganti Password</button>
        </form>

    </div>
@endsection
