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

            <div class="col-md-5 mb-4">
                <div class="dashboard-card h-100">
                    <div class="dashboard-card-header py-3 px-4">
                        <h5 class="mb-0">Foto Bukti</h5>
                    </div>
                    <div
                        class="dashboard-card-body px-4 py-4 text-center d-flex flex-column align-items-center justify-content-center">
                        @if ($kehadiran->foto_bukti)
                            <div class="p-2 bg-white shadow-sm rounded" style="border: 1px solid #dee2e6;">
                                <img src="{{ asset('storage/absensi/' . $kehadiran->foto_bukti) }}"
                                    alt="Foto Bukti Kehadiran" class="img-fluid rounded"
                                    style="max-width: 100%; max-height: 450px; object-fit: contain;">
                            </div>
                            <div class="mt-3 text-muted small">
                                <i class="bi bi-file-earmark-image"></i> Nama File: {{ $kehadiran->foto_bukti }}
                            </div>
                        @else
                            <div class="bg-light rounded d-flex flex-column align-items-center justify-content-center w-100"
                                style="min-height: 350px; border: 2px dashed #ccc;">
                                <i class="bi bi-camera-video-off text-muted" style="font-size: 4rem;"></i>
                                <h5 class="text-muted mt-3">Tidak Ada Bukti Foto</h5>
                                <p class="text-muted small px-4 text-center">Data ini diinput manual tanpa melampirkan file
                                    gambar atau ESP32-CAM tidak mengirimkan gambar.</p>
                                <a href="{{ route('kehadiran.edit', $kehadiran->id) }}"
                                    class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="bi bi-plus-circle"></i> Upload Foto Melalui Form Edit
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
