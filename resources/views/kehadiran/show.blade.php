@extends('layouts.app')

@section('title', 'Detail Kehadiran')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Detail Bukti Kehadiran</h1>
                <p class="text-muted mb-0">Halaman verifikasi data teks dan bukti foto asli</p>
            </div>
            <a href="{{ route('kehadiran.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Tabel
            </a>
        </div>

        <div class="row">
            <!-- KOLOM KIRI: Tabel Data Teks -->
            <div class="col-md-7 mb-4">
                <div class="dashboard-card h-100">
                    <div class="dashboard-card-header py-3 px-4">
                        <h5 class="mb-0">Data Kehadiran</h5>
                    </div>
                    <div class="dashboard-card-body px-4 py-4">
                        <table class="table table-borderless">
                            <tr>
                                <th width="35%">Nama</th>
                                <td width="5%">:</td>
                                <td><strong>{{ $kehadiran->perangkatDesa->nama }}</strong></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>:</td>
                                <td>{{ \Carbon\Carbon::parse($kehadiran->tanggal)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td class="text-uppercase">
                                    @php
                                        $statusClass = match ($kehadiran->status_kehadiran) {
                                            'hadir' => 'bg-success',
                                            'sakit' => 'bg-warning text-dark',
                                            'izin' => 'bg-info text-dark',
                                            'alpa' => 'bg-danger',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span
                                        class="badge {{ $statusClass }} px-3 py-2">{{ $kehadiran->status_kehadiran }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Jam Masuk</th>
                                <td>:</td>
                                <td>{{ $kehadiran->jam_masuk ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jam Pulang</th>
                                <td>:</td>
                                <td>{{ $kehadiran->jam_pulang ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Ketepatan Waktu</th>
                                <td>:</td>
                                <td class="text-capitalize">{{ $kehadiran->status_ketepatan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>:</td>
                                <td>{{ $kehadiran->keterangan ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: Dokumentasi Foto (Masuk & Pulang) -->
            <div class="col-md-5 mb-4">
                <div class="dashboard-card h-100">
                    <div class="dashboard-card-header py-3 px-4">
                        <h5 class="mb-0">Bukti Foto Kehadiran</h5>
                    </div>
                    <div class="dashboard-card-body px-4 py-4">

                        <!-- 1. BAGIAN FOTO MASUK / SURAT IZIN -->
                        <div class="mb-4">
                            <h6 class="text-muted fw-bold mb-2">
                                <i class="bi bi-box-arrow-in-right text-primary me-1"></i>
                                {{ in_array($kehadiran->status_kehadiran, ['izin', 'sakit']) ? 'Bukti Surat Izin / Sakit' : 'Foto Absen Masuk' }}
                            </h6>

                            @if ($kehadiran->foto_bukti)
                                <div class="p-2 bg-white shadow-sm rounded text-center" style="border: 1px solid #dee2e6;">
                                    <img src="{{ asset('storage/absensi/' . $kehadiran->foto_bukti) }}"
                                        alt="Foto Bukti Masuk" class="img-fluid rounded"
                                        style="max-height: 230px; object-fit: contain;">
                                </div>
                                <div class="mt-1 text-muted text-center" style="font-size: 11px;">
                                    <i class="bi bi-file-earmark-image"></i> {{ $kehadiran->foto_bukti }}
                                </div>
                            @else
                                <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center p-3 text-center"
                                    style="min-height: 150px; border: 2px dashed #ccc;">
                                    <i class="bi bi-camera-video-off text-muted" style="font-size: 2rem;"></i>
                                    <span class="text-muted small mt-1">Belum ada foto absen masuk / surat izin.</span>
                                </div>
                            @endif
                        </div>

                        <!-- 2. BAGIAN FOTO PULANG (Hanya Muncul Jika Status 'Hadir' atau Fotonya Ada) -->
                        @if ($kehadiran->status_kehadiran === 'hadir' || $kehadiran->foto_bukti_pulang)
                            <hr class="text-muted my-3">
                            <div>
                                <h6 class="text-muted fw-bold mb-2">
                                    <i class="bi bi-box-arrow-left text-success me-1"></i> Foto Absen Pulang
                                </h6>

                                @if ($kehadiran->foto_bukti_pulang)
                                    <div class="p-2 bg-white shadow-sm rounded text-center"
                                        style="border: 1px solid #dee2e6;">
                                        <img src="{{ asset('storage/absensi/' . $kehadiran->foto_bukti_pulang) }}"
                                            alt="Foto Bukti Pulang" class="img-fluid rounded"
                                            style="max-height: 230px; object-fit: contain;">
                                    </div>
                                    <div class="mt-1 text-muted text-center" style="font-size: 11px;">
                                        <i class="bi bi-file-earmark-image"></i> {{ $kehadiran->foto_bukti_pulang }}
                                    </div>
                                @else
                                    <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center p-3 text-center"
                                        style="min-height: 150px; border: 2px dashed #ccc;">
                                        <i class="bi bi-clock-history text-muted" style="font-size: 2rem;"></i>
                                        <span class="text-muted small mt-1 fw-bold">Belum Absen Pulang</span>
                                        <span class="text-muted" style="font-size: 11px;">Foto akan muncul otomatis setelah
                                            tap kartu pulang.</span>
                                    </div>
                                @endif
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
