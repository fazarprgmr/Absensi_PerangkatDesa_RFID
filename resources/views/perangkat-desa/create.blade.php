@extends('layouts.app')

@section('title', 'Tambah Perangkat Desa')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <h4 class="page-title">Tambah Perangkat Desa</h4>
                <p class="text-muted">Isi informasi di bawah ini untuk menambahkan perangkat desa baru ke dalam sistem</p>
            </div>
        </div>

        <!-- Form Tabs -->
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <div class="dashboard-card">
                    <div class="dashboard-card-body">

                        <!-- Tab Content -->
                        <div class="tab-content" id="studentFormTabContent">
                            <!-- Basic Information Tab -->
                            <div class="tab-pane fade show active" id="basic" role="tabpanel"
                                aria-labelledby="basic-tab">
                                <form class="needs-validation" novalidate method="POST"
                                    action="{{ route('perangkat-desa.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row gx-4 gy-3">
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="nik" class="form-label">NIK <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="nik"
                                                    class="form-control @error('nik') is-invalid @enderror" id="nik"
                                                    placeholder="Masukkan NIK" value="{{ old('nik') }}" required>
                                                @error('nik')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="nama" class="form-label">Nama <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="nama"
                                                    class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                    placeholder="Masukkan nama" value="{{ old('nama') }}" required>
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="rfid_uid" class="form-label">RFID UID <span
                                                        class="text-danger">*</span></label>

                                                <div class="input-group">
                                                    <input type="text" name="rfid_uid"
                                                        class="form-control @error('rfid_uid') is-invalid @enderror"
                                                        id="rfid_uid" placeholder="Tap Kartu ke alat pembaca..."
                                                        value="{{ old('rfid_uid') }}" readonly required>
                                                    <button class="btn btn-warning" type="button" id="btn-reset-rfid"
                                                        onclick="clearRFID()">
                                                        <i class="bi bi-arrow-clockwise"></i>Reset
                                                    </button>
                                                </div>
                                                @error('rfid_uid')
                                                    <div class="invalid-feedback d-block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="jabatan" class="form-label">Jabatan <span
                                                        class="text-danger">*</span></label>
                                                <select name="jabatan_id"
                                                    class="form-select @error('jabatan_id') is-invalid @enderror"
                                                    id="jabatan" required>
                                                    <option value="" selected disabled>Pilih jabatan</option>

                                                    @foreach ($jabatans as $jabatan)
                                                        <option value="{{ $jabatan->id }}"
                                                            {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                                                            {{ $jabatan->nama_jabatan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('jabatan_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="alamat_id" class="form-label">Alamat <span
                                                        class="text-danger">*</span></label>
                                                <select name="alamat_id"
                                                    class="form-select @error('alamat_id') is-invalid @enderror"
                                                    id="alamat_id" required>
                                                    <option value="" selected disabled>Pilih Alamat</option>
                                                    @foreach ($alamats as $alamat)
                                                        <option value="{{ $alamat->id }}"
                                                            {{ old('alamat_id') == $alamat->id ? 'selected' : '' }}>
                                                            {{ $alamat->dusun }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('alamat_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="no_hp" class="form-label">Nomor HP <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" name="no_hp"
                                                    class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                                    placeholder="Enter phone number" value="{{ old('no_hp') }}" required>
                                                @error('no_hp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                                        class="text-danger">*</span></label>
                                                <select name="jenis_kelamin"
                                                    class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                                    id="jenis_kelamin" required>
                                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                    <option value="Laki-laki"
                                                        {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                        Laki-Laki</option>
                                                    <option value="Perempuan"
                                                        {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 px-2">
                                            <div class="mb-4">
                                                <label for="foto" class="form-label">Foto</label>
                                                <input name="foto"
                                                    class="form-control @error('foto') is-invalid @enderror"
                                                    type="file" id="foto" accept="image/*">
                                                <div class="form-text">Accepted formats: JPG, PNG (Max 2MB)</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 px-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-circle me-2"></i>Simpan
                                            </button>
                                            <button type="button" class="btn btn-secondary ms-2"
                                                onclick="window.location.href='{{ route('perangkat-desa.index') }}'">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hapus sisa cache saat halaman pertama kali dibuka
            $.get("{{ url('/clear-temp-rfid') }}");

            // Polling: Cek ke server setiap 1 detik
            setInterval(function() {
                let currentRfid = $('#rfid_uid').val();

                // Kalau inputan masih kosong, minta data ke server
                if (!currentRfid) {
                    $.ajax({
                        url: "{{ url('/get-temp-rfid') }}",
                        type: "GET",
                        success: function(response) {
                            if (response.rfid_uid) {
                                // Jika ada UID masuk, isi ke dalam form
                                $('#rfid_uid').val(response.rfid_uid);
                                $('#rfid_uid').addClass('is-valid');
                            }
                        }
                    });
                }
            }, 1000); // 1000ms = 1 detik
        });

        // Fungsi tombol reset
        function clearRFID() {
            $('#rfid_uid').val(''); // Kosongkan form
            $('#rfid_uid').removeClass('is-valid'); // Hilangkan efek hijau
            $.get("{{ url('/clear-temp-rfid') }}"); // Hapus data di server
        }
    </script>
@endpush
