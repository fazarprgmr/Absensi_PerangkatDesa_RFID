@extends('layouts.app')

@section('title', 'Detail Kehadiran')

@push('styles')
    <link rel="stylesheet" crossorigin href="{{ asset('template/assets/data-table-D3bj5bdn.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('css/custom-css-table.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Detail Riwayat Kehadiran</h1>
                <p class="text-muted mb-0 font-14">Periode: {{ $namaBulan }} {{ $tahun }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('rekap.cetakDetail', ['id' => $perangkatDesa->id, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                    class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-file-earmark-pdf me-1"></i> Cetak PDF Detail
                </a>
                <a href="{{ route('rekap.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Rekap
                </a>
            </div>
        </div>

        <div class="dashboard-card mb-4 border-left-primary">
            <div class="dashboard-card-body py-3 px-4">
                <h5 class="mb-1 fw-bold">{{ $perangkatDesa->nama }}</h5>
                <p class="mb-0 text-muted">
                    NIK: {{ $perangkatDesa->nik ?? '-' }} | Jabatan: {{ $perangkatDesa->jabatan->nama_jabatan ?? '-' }}
                </p>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="dashboard-card-header py-3 px-4">
                <h6 class="mb-0 fw-bold">Daftar Kehadiran Harian</h6>
            </div>
            <div class="dashboard-card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="py-3 text-center">Status Kehadiran</th>
                                <th class="py-3 text-center">Status Ketepatan</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kehadirans as $k)
                                <tr>
                                    <!-- 1. Tanggal -->
                                    <td class="px-4 py-3 fw-medium">
                                        {{ \Carbon\Carbon::parse($k->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                    </td>

                                    <!-- 2. Status Kehadiran -->
                                    <td class="px-4 py-3 text-center">
                                        @php
                                            $color = match ($k->status_kehadiran) {
                                                'hadir' => 'bg-success',
                                                'izin' => 'bg-info text-dark',
                                                'sakit' => 'bg-warning text-dark',
                                                'alpa' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $color }} px-3 py-1 text-capitalize">
                                            {{ $k->status_kehadiran }}
                                        </span>
                                    </td>

                                    <!-- 3. Status Ketepatan -->
                                    <td class="px-4 py-3 text-capitalize text-center">
                                        @if ($k->status_ketepatan == 'terlambat')
                                            <span class="status-badge status-pending fw-bold"><i
                                                    class="bi bi-clock me-1"></i>Terlambat</span>
                                        @elseif ($k->status_ketepatan)
                                            <span class="status-badge status-active"><i
                                                    class="bi bi-clock me-1"></i>{{ $k->status_ketepatan }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <!-- 4. Aksi -->
                                    <td class="text-center">
                                        <a href="{{ route('kehadiran.show', $k->id) }}"
                                            class="btn-action btn-view" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <!-- Diubah dari 5 menjadi 4 agar pas dengan jumlah kolom di head -->
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        Belum ada catatan kehadiran di bulan ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
