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
                                <form method="POST" action="{{ route('perangkat-desa.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row gx-4 gy-3">
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="nik" class="form-label">NIK <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="nik" inputmode="numeric" pattern="[0-9]{16}"
                                                    maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    class="form-control @error('nik')
is-invalid
@enderror" id="nik"
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
                                                <label for="no_hp" class="form-label">Nomor HP <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" name="no_hp"
                                                    class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                                    placeholder="Masukkan nomor HP" value="{{ old('no_hp') }}"
                                                    minlength="10" maxlength="15" inputmode="numeric"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                                                @error('no_hp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="dusun" class="form-label">Dusun <span
                                                        class="text-danger">*</span></label>
                                                <select name="dusun"
                                                    class="form-select @error('dusun') is-invalid @enderror" id="dusun"
                                                    required>
                                                    <option value="" selected disabled>Pilih Dusun</option>

                                                    @foreach ($dusuns as $dusun)
                                                        <option value="{{ $dusun }}"
                                                            {{ old('dusun') == $dusun ? 'selected' : '' }}>
                                                            {{ $dusun }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('dusun')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Input RT -->
                                        <div class="col-md-3 px-2">
                                            <div class="mb-4">
                                                <label for="rt" class="form-label">RT <span
                                                        class="text-danger">*</span></label>
                                                <select name="rt"
                                                    class="form-select @error('rt') is-invalid @enderror" id="rt"
                                                    required>
                                                    <option value="" selected disabled>Pilih RT</option>
                                                    <!-- Trik Blade: Generate otomatis angka 001 sampai 015 -->
                                                    @for ($i = 1; $i <= 30; $i++)
                                                        @php $valRT = str_pad($i, 3, '0', STR_PAD_LEFT); @endphp
                                                        <option value="{{ $valRT }}"
                                                            {{ old('rt', $perangkatDesa->rt ?? '') == $valRT ? 'selected' : '' }}>
                                                            {{ $valRT }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                @error('rt')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Input RW -->
                                        <div class="col-md-3 px-2">
                                            <div class="mb-4">
                                                <label for="rw" class="form-label">RW <span
                                                        class="text-danger">*</span></label>
                                                <select name="rw"
                                                    class="form-select @error('rw') is-invalid @enderror" id="rw"
                                                    required>
                                                    <option value="" selected disabled>Pilih RW</option>
                                                    <!-- Trik Blade: Generate otomatis angka 001 sampai 010 -->
                                                    @for ($i = 1; $i <= 9; $i++)
                                                        @php $valRW = str_pad($i, 3, '0', STR_PAD_LEFT); @endphp
                                                        <option value="{{ $valRW }}"
                                                            {{ old('rw', $perangkatDesa->rw ?? '') == $valRW ? 'selected' : '' }}>
                                                            {{ $valRW }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                @error('rw')
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
                                                <div class="form-text">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.
                                                </div>
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
