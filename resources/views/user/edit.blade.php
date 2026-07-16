@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container-fluid">
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <h4 class="page-title">Edit Akun User</h4>
                <p class="text-muted">Kelola informasi akun user, hak akses, dan password. Pastikan data
                    selalu terbaru untuk keamanan sistem.
                </p>
            </div>
        </div>

        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <div class="dashboard-card">
                    <div class="dashboard-card-body">

                        @php
                            // Mengecek apakah ada error di form password agar tab password otomatis terbuka
                            $passwordTabActive = $errors->has('password') || session('active_tab') == 'account';
                        @endphp

                        <ul class="nav nav-tabs mb-4" id="userFormTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ !$passwordTabActive ? 'active' : '' }}" id="basic-tab"
                                    data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab"
                                    aria-controls="basic" aria-selected="true">
                                    <i class="bi bi-person-circle me-2"></i>Profil & Akses
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $passwordTabActive ? 'active' : '' }}" id="account-tab"
                                    data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab"
                                    aria-controls="account" aria-selected="false">
                                    <i class="bi bi-shield-lock me-2"></i>Ganti Password
                                </button>
                            </li>
                        </ul>

                        {{-- ======================================================== --}}
                        {{-- SATU FORM UNTUK MEMBUNGKUS SEMUA TAB --}}
                        {{-- ======================================================== --}}
                        <form action="{{ route('user.update', $user->id) }}" method="POST" class="mb-5">
                            @csrf
                            @method('PUT')

                            <div class="tab-content" id="userFormTabContent">

                                <div class="tab-pane fade {{ !$passwordTabActive ? 'show active' : '' }}" id="basic"
                                    role="tabpanel" aria-labelledby="basic-tab">

                                    <div class="row gx-4 gy-3">
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="namaGroup" class="form-label">Nama <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="namaGroup" placeholder="Masukkan nama" name="name"
                                                        value="{{ old('name', $user->name) }}" required>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="emailGroup" class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="emailGroup" placeholder="Masukkan email" name="email"
                                                        value="{{ old('email', $user->email) }}" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 px-2">
                                            <div class="mb-4">
                                                <label for="roleGroup" class="form-label">Role / Hak Akses <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-briefcase"></i></span>

                                                    <select name="role"
                                                        class="form-select @error('role') is-invalid @enderror"
                                                        id="roleGroup" {{ $user->id === auth()->id() ? 'disabled' : '' }}
                                                        required>
                                                        <option value="admin"
                                                            {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                                            Admin (Akses Penuh)</option>
                                                        <option value="kades"
                                                            {{ old('role', $user->role) == 'kades' ? 'selected' : '' }}>
                                                            Kades (Hanya Lihat & Cetak)</option>
                                                    </select>

                                                    @error('role')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                @if ($user->id === auth()->id())
                                                    <input type="hidden" name="role" value="{{ $user->role }}">
                                                    <small class="text-warning mt-1 d-block">
                                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Anda tidak bisa
                                                        mengubah hak akses akun yang sedang Anda gunakan.
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12 px-2">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="bi bi-check-circle me-2"></i>Simpan Perubahan</button>
                                            <a href="{{ route('user.index') }}"
                                                class="btn btn-outline-secondary ms-2"><i
                                                    class="bi bi-x-circle me-2"></i>Batal</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade {{ $passwordTabActive ? 'show active' : '' }}" id="account"
                                    role="tabpanel" aria-labelledby="account-tab">

                                    <div class="alert alert-info border-0 bg-info bg-opacity-10 mb-4">
                                        <i class="bi bi-info-circle me-2"></i>Kosongkan form di bawah ini jika tidak ingin
                                        mengubah password akun ini.
                                    </div>

                                    <div class="row gx-4 gy-3">
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="passwordbaruGroup" class="form-label">Password Baru</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="passwordbaruGroup" placeholder="Ketik password baru"
                                                        name="password" autocomplete="new-password">
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="passwordkonfirmasiGroup" class="form-label">Konfirmasi
                                                    Password Baru</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="bi bi-check2-circle"></i></span>
                                                    <input type="password" class="form-control"
                                                        id="passwordkonfirmasiGroup" placeholder="Ulangi password baru"
                                                        name="password_confirmation" autocomplete="new-password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12 px-2">
                                            <button type="submit" class="btn btn-warning text-dark fw-bold"><i
                                                    class="bi bi-key me-2"></i>Update Password</button>
                                            <a href="{{ route('user.index') }}"
                                                class="btn btn-outline-secondary ms-2">Batal</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        {{-- END OF FORM --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
