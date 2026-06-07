@extends('layouts.app')

@section('title', 'Detail Kehadiran')

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
                                <th class="px-4 py-3">Jam Masuk</th>
                                <th class="px-4 py-3">Jam Pulang</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kehadirans as $k)
                                <tr>
                                    <td class="px-4 py-3 fw-medium">
                                        {{ \Carbon\Carbon::parse($k->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                    </td>
                                    <td class="px-4 py-3">{{ $k->jam_masuk ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $k->jam_pulang ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @php
                                            $color = 'bg-secondary';
                                            if ($k->status_kehadiran == 'hadir') {
                                                $color = 'bg-success';
                                            }
                                            if ($k->status_kehadiran == 'izin') {
                                                $color = 'bg-info';
                                            }
                                            if ($k->status_kehadiran == 'sakit') {
                                                $color = 'bg-warning';
                                            }
                                            if ($k->status_kehadiran == 'alpa') {
                                                $color = 'bg-danger';
                                            }
                                        @endphp
                                        <span class="badge {{ $color }} px-2 py-1"
                                            style="text-transform: capitalize;">
                                            {{ $k->status_kehadiran }}
                                        </span>
                                        @if ($k->status_ketepatan == 'terlambat')
                                            <br><span class="badge bg-warning mt-1"
                                                style="font-size: 10px;">Terlambat</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $k->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
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
