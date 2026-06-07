    @extends('layouts.app')

    @section('title', 'Edit Profil')

    @section('content')
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="dashboard-row">
                <div class="dashboard-grid grid-cols-1">
                    <h4 class="page-title">Edit Profil</h4>
                    <p class="text-muted">Kelola informasi akun Anda, termasuk nama, email, dan password. Pastikan data Anda
                        selalu terbaru untuk pengalaman terbaik di platform kami.
                    </p>
                </div>
            </div>

            <div class="dashboard-row">
                <div class="dashboard-grid grid-cols-1">
                    <div class="dashboard-card">
                        <div class="dashboard-card-body">

                            @php
                                $passwordTabActive =
                                    $errors->updatePassword->any() || session('active_tab') == 'account';
                            @endphp

                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs mb-4" id="studentFormTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ !$passwordTabActive ? 'active' : '' }}" id="basic-tab"
                                        data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab"
                                        aria-controls="basic" aria-selected="true">
                                        <i class="bi bi-person-circle me-2"></i>Edit Profil
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

                            {{-- ===================== --}}
                            {{-- FORM EDIT PROFIL --}}
                            {{-- ===================== --}}
                            <div class="tab-content" id="studentFormTabContent">
                                <!-- Basic Information Tab -->
                                <div class="tab-pane fade {{ !$passwordTabActive ? 'show active' : '' }}" id="basic"
                                    role="tabpanel" aria-labelledby="basic-tab">
                                    <form action="{{ route('profile.update') }}" method="POST" class="mb-5">
                                        @csrf
                                        @method('patch')

                                        <div class="row gx-4 gy-3">
                                            <div class="col-md-6 px-2">
                                                <div class="mb-4">
                                                    <label for="namaGroup" class="form-label">Nama</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-person"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="namaGroup"
                                                            placeholder="nama" name="name"
                                                            value="{{ old('name', $user->name) }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 px-2">
                                                <div class="mb-4">
                                                    <label for="emailGroup" class="form-label">Email</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-envelope"></i>
                                                        </span>
                                                        <input type="email" class="form-control" id="emailGroup"
                                                            placeholder="email" name="email"
                                                            value="{{ old('email', $user->email) }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12 px-2">
                                                <button class="btn btn-primary">Simpan Profil</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- ===================== --}}
                                {{-- FORM GANTI PASSWORD --}}
                                {{-- ===================== --}}
                                <div class="tab-pane fade {{ $passwordTabActive ? 'show active' : '' }}" id="account"
                                    role="tabpanel" aria-labelledby="account-tab">
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

                                        <div class="row gx-4 gy-3">
                                            <div class="col-md-6 px-2">
                                                <div class="mb-4">
                                                    <label for="passwordlamaGroup" class="form-label">Password Lama</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-lock"></i>
                                                        </span>
                                                        <input type="password" class="form-control" id="passwordlamaGroup"
                                                            placeholder="Password Lama" name="current_password"
                                                            value="{{ old('current_password') }}" required>
                                                    </div>

                                                    @error('current_password', 'updatePassword')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 px-2">
                                                <div class="mb-4">
                                                    <label for="passwordbaruGroup" class="form-label">Password
                                                        Baru</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-lock"></i>
                                                        </span>
                                                        <input type="password" class="form-control"
                                                            id="passwordbaruGroup" placeholder="Password Baru"
                                                            name="password" required>
                                                    </div>
                                                    @error('password', 'updatePassword')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 px-2">
                                                <div class="mb-4">
                                                    <label for="passwordkonfirmasiGroup" class="form-label">Konfirmasi
                                                        Password</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-lock"></i>
                                                        </span>
                                                        <input type="password" class="form-control"
                                                            id="passwordkonfirmasiGroup" placeholder="Konfirmasi Password"
                                                            name="password_confirmation"
                                                            required>
                                                    </div>
                                                    @error('password', 'updatePassword')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-4">
                                            <div class="col-12 px-2">
                                                <button class="btn btn-warning">Ganti Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
