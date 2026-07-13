@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="container-fluid">
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <h4 class="page-title">Tambah User Baru</h4>
                <p class="text-muted">Isi informasi di bawah ini untuk membuat akun akses sistem baru</p>
            </div>
        </div>

        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <div class="dashboard-card">
                    <div class="dashboard-card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('user.store') }}">
                            @csrf
                            <div class="row gx-4 gy-3">
                                
                                <div class="col-md-6 px-2">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                            id="name" placeholder="Masukkan nama" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-2">
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                            id="email" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-2">
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                            id="password" placeholder="Minimal 8 karakter" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 px-2">
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control" 
                                            id="password_confirmation" placeholder="Ulangi password" required>
                                    </div>
                                </div>

                                <div class="col-md-12 px-2">
                                    <div class="mb-4">
                                        <label for="role" class="form-label">Role / Hak Akses <span class="text-danger">*</span></label>
                                        <select name="role" class="form-select @error('role') is-invalid @enderror" id="role" required>
                                            <option value="" selected disabled>Pilih Hak Akses</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Akses Penuh)</option>
                                            <option value="kades" {{ old('role') == 'kades' ? 'selected' : '' }}>Kades (Hanya Lihat & Cetak)</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-12 px-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-2"></i>Simpan
                                    </button>
                                    <button type="button" class="btn btn-secondary ms-2"
                                        onclick="window.location.href='{{ route('user.index') }}'">
                                        <i class="bi bi-x-circle me-2"></i>Batal
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
    </script>
@endpush