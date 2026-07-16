@extends('layouts.app')

@section('title', 'Edit Kehadiran')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <h4 class="page-title">Edit Kehadiran</h4>
                <p class="text-muted">Isi informasi di bawah ini untuk mengedit kehadiran yang sudah ada</p>
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
                                <form method="POST" action="{{ route('kehadiran.update', $kehadiran->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row gx-4 gy-3">
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="perangkat_desa_id" class="form-label">Perangkat Desa <span
                                                        class="text-danger">*</span></label>
                                                <select name="perangkat_desa_id"
                                                    class="form-select @error('perangkat_desa_id') is-invalid @enderror"
                                                    id="perangkat_desa_id" required>
                                                    <option value="" selected disabled>Pilih Perangkat Desa
                                                    </option>
                                                    @foreach ($perangkatDesa as $pd)
                                                        <option value="{{ $pd->id }}"
                                                            {{ old('perangkat_desa_id', $kehadiran->perangkat_desa_id) == $pd->id ? 'selected' : '' }}>
                                                            {{ $pd->nama }}</option>
                                                    @endforeach
                                                </select>
                                                @error('perangkat_desa_id')
                                                    <div class="invalid-feedback d-block">
                                                        {{ $message }} </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="tanggal" class="form-label">Tanggal <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" name="tanggal"
                                                    class="form-control @error('tanggal') is-invalid @enderror"
                                                    id="tanggal" value="{{ old('tanggal', $kehadiran->tanggal) }}"
                                                    required>
                                                @error('tanggal')
                                                    <div class="invalid-feedback d-block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="status_kehadiran" class="form-label">Status Kehadiran <span
                                                        class="text-danger">*</span></label>
                                                <select name="status_kehadiran"
                                                    class="form-select @error('status_kehadiran') is-invalid @enderror"
                                                    id="status_kehadiran" required>
                                                    <option value="" selected disabled>Pilih Status Kehadiran
                                                    </option>
                                                    <option value="hadir"
                                                        {{ old('status_kehadiran', $kehadiran->status_kehadiran) == 'hadir' ? 'selected' : '' }}>
                                                        Hadir
                                                    </option>
                                                    <option value="izin"
                                                        {{ old('status_kehadiran', $kehadiran->status_kehadiran) == 'izin' ? 'selected' : '' }}>
                                                        Izin
                                                    </option>
                                                    <option value="sakit"
                                                        {{ old('status_kehadiran', $kehadiran->status_kehadiran) == 'sakit' ? 'selected' : '' }}>
                                                        Sakit
                                                    </option>
                                                    <option value="alpa"
                                                        {{ old('status_kehadiran', $kehadiran->status_kehadiran) == 'alpa' ? 'selected' : '' }}>
                                                        Alpa
                                                    </option>
                                                </select>
                                                @error('status_kehadiran')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="jam_masuk" class="form-label">Jam Masuk</label>
                                                <input type="time" name="jam_masuk"
                                                    class="form-control @error('jam_masuk') is-invalid @enderror"
                                                    id="jam_masuk" value="{{ old('jam_masuk', $kehadiran->jam_masuk) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="jam_pulang" class="form-label">Jam Pulang</label>
                                                <input type="time" name="jam_pulang"
                                                    class="form-control @error('jam_pulang') is-invalid @enderror"
                                                    id="jam_pulang"
                                                    value="{{ old('jam_pulang', $kehadiran->jam_pulang) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label for="status_ketepatan" class="form-label">Status Ketepatan</label>
                                                <select name="status_ketepatan"
                                                    class="form-select @error('status_ketepatan') is-invalid @enderror"
                                                    id="status_ketepatan">
                                                    <option value="" selected disabled>Pilih Status Ketepatan
                                                    </option>
                                                    <option value="tepat waktu"
                                                        {{ old('status_ketepatan', $kehadiran->status_ketepatan) == 'tepat waktu' ? 'selected' : '' }}>
                                                        Tepat Waktu
                                                    </option>
                                                    <option value="terlambat"
                                                        {{ old('status_ketepatan', $kehadiran->status_ketepatan) == 'terlambat' ? 'selected' : '' }}>
                                                        Terlambat
                                                    </option>
                                                </select>
                                                @error('status_ketepatan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 px-2">
                                            <div class="mb-4">
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                                    rows="3" placeholder="Masukkan Keterangan">{{ old('keterangan', $kehadiran->keterangan) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 px-2 mb-4">
                                            <label for="foto_bukti" class="form-label">Foto Bukti (Kosongkan jika tidak
                                                ingin mengubah foto)</label>
                                            <input type="file"
                                                class="form-control @error('foto_bukti') is-invalid @enderror"
                                                id="foto_bukti" name="foto_bukti" accept="image/*">
                                            <small class="text-muted">Format yang didukung: JPG, JPEG, PNG. Maksimal
                                                2MB.</small>
                                            @error('foto_bukti')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if ($kehadiran->foto_bukti)
                                                <div class="mt-2">
                                                    <p class="text-muted mb-1" style="font-size: 13px;">Foto Bukti Saat
                                                        Ini:</p>
                                                    <img src="{{ asset('storage/absensi/' . $kehadiran->foto_bukti) }}"
                                                        class="img-thumbnail" style="max-height: 100px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 px-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                                            </button>
                                            <button type="button" class="btn btn-secondary ms-2"
                                                onclick="window.location.href='{{ route('kehadiran.index') }}'">
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
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // LOGIKA CUSTOM UNTUK FORM KEHADIRAN
                const statusKehadiran = document.getElementById('status_kehadiran');
                const jamMasuk = document.getElementById('jam_masuk');
                const jamPulang = document.getElementById('jam_pulang');
                const statusKetepatan = document.getElementById('status_ketepatan');

                // Ambil batas jam toleransi dari database (Default: 08:30)
                const batasJamMasuk = "{{ substr($pengaturan->jam_toleransi ?? '08:30:00', 0, 5) }}";

                // Fungsi untuk mengatur form berdasarkan status kehadiran
                function aturInputKehadiran() {
                    const status = statusKehadiran.value;

                    // Jika statusnya Izin, Sakit, atau Alpa
                    if (status === 'izin' || status === 'sakit' || status === 'alpa') {
                        // Disable input waktu dan ketepatan
                        jamMasuk.readOnly = true;
                        jamPulang.readOnly = true;

                        jamMasuk.style.backgroundColor = '#e9ecef';
                        jamPulang.style.backgroundColor = '#e9ecef';

                        // Pakai teknik CSS pointer-events agar dropdown terlihat disable tapi nilainya bisa kosong
                        statusKetepatan.style.pointerEvents = 'none';
                        statusKetepatan.style.backgroundColor = '#e9ecef'; // Warna abu-abu ala bootstrap

                        // Kosongkan nilainya
                        jamMasuk.value = '';
                        jamPulang.value = '';
                        statusKetepatan.value = '';
                    } else {
                        // Jika statusnya Hadir (atau belum milih)
                        jamMasuk.readOnly = false;
                        jamPulang.readOnly = false;

                        jamMasuk.style.backgroundColor = '#fff';
                        jamPulang.style.backgroundColor = '#fff';

                        statusKetepatan.style.pointerEvents = 'auto';
                        statusKetepatan.style.backgroundColor = '#fff';
                    }
                }

                // Fungsi untuk otomatis set status ketepatan
                function cekKetepatanWaktu() {
                    if (jamMasuk.value) {
                        // Logika batasnya sekarang DINAMIS mengikuti database
                        if (jamMasuk.value <= batasJamMasuk) {
                            statusKetepatan.value = 'tepat waktu';
                        } else {
                            statusKetepatan.value = 'terlambat';
                        }
                    } else {
                        statusKetepatan.value = ''; // Kosongkan jika jam dihapus
                    }
                }

                // Pasang pendengar event (Event Listener)
                statusKehadiran.addEventListener('change', aturInputKehadiran);
                jamMasuk.addEventListener('input', cekKetepatanWaktu);

                // Jalankan sekali saat halaman pertama kali dibuka
                // (Berguna saat di halaman Edit atau saat ada error validasi old() value)
                aturInputKehadiran();
                cekKetepatanWaktu(); // <-- TAMBAHAN PENTING UNTUK EDIT: agar mengecek status saat data dimuat
            });
        </script>
    @endpush
@endpush
