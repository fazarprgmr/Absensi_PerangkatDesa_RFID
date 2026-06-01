@extends('layouts.app')

@section('title', 'Tambah Jabatan')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <h4 class="page-title">Tambah Jabatan</h4>
                <p class="text-muted">Isi informasi di bawah ini untuk menambahkan jabatan baru ke dalam sistem</p>
            </div>
        </div>
        <!-- Form Tabs -->
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <div class="dashboard-card">
                    <div class="dashboard-card-body">
                        <!-- Tab Content -->
                        <div class="tab-content" id="jabatanFormTabContent">
                            <!-- Basic Information Tab -->
                            <div class="tab-pane fade show active" id="basic" role="tabpanel"
                                aria-labelledby="basic-tab">
                                <form class="needs-validation" novalidate method="POST"
                                    action="{{ route('jabatan.store') }}">
                                    @csrf
                                    <div class="row gx-4 gy-3">
                                        <div class="col-md-12 px-2">
                                            <div class="mb-4">
                                                <label for="nama_jabatan" class="form-label">Nama
                                                    Jabatan <span class="text-danger">*</span></label>
                                                <input type="text" name="nama_jabatan"
                                                    class="form-control @error('nama_jabatan') is-invalid @enderror"
                                                    id="nama_jabatan" placeholder="Masukan Nama Jabatan"
                                                    value="{{ old('nama_jabatan') }}" required>

                                                @error('nama_jabatan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
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
                                                onclick="window.location.href='{{ route('jabatan.index') }}'">
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
