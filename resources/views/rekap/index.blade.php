@extends('layouts.app')

@section('title', 'Rekap Absensi Bulanan')

@push('styles')
    <link rel="stylesheet" crossorigin href="{{ asset('template/assets/data-table-D3bj5bdn.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('css/custom-css-table.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Rekap Absensi</h1>
                <p class="text-muted mb-0 font-14">Laporan rangkuman kehadiran perangkat desa per bulan</p>
            </div>
        </div>

        <div class="dashboard-card mb-4">
            <div class="dashboard-card-body py-3 px-4">
                <form action="{{ route('rekap.index') }}" method="GET"
                    class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <label for="bulan" class="form-label mb-0 fw-bold text-secondary font-14">
                            Bulan :
                        </label>

                        <select name="bulan" id="bulan" class="form-select form-select-sm" style="width: 160px;">
                            @foreach ($listBulan as $key => $value)
                                <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>

                        <label for="tahun" class="form-label mb-0 fw-bold text-secondary font-14">
                            Tahun :
                        </label>

                        <select name="tahun" id="tahun" class="form-select form-select-sm" style="width: 110px;">
                            @for ($t = date('Y'); $t >= date('Y') - 3; $t--)
                                <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>
                                    {{ $t }}
                                </option>
                            @endfor
                        </select>

                        <button type="submit" class="btn btn-primary btn-sm px-3">
                            <i class="bi bi-filter me-1"></i> Filter
                        </button>
                    </div>

                    <div>
                        <a href="{{ route('rekap.cetak', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                            class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Cetak PDF
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="dashboard-card-header py-4 px-4">
                <h5 class="mb-0 text-dark fw-bold">Rangkuman Absensi — {{ $listBulan[$bulan] }} {{ $tahun }}</h5>
            </div>
            <div class="dashboard-card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0 align-middle">
                        <thead class="table-secondary font-14 fw-bold text-secondary">
                            <tr>
                                <th class="px-4 py-3">Nama Perangkat Desa</th>
                                <th class="text-center py-3">Total Hari Aktif</th>
                                <!-- Diubah menjadi "Hadir" saja agar mencakup Tepat Waktu & Terlambat -->
                                <th class="text-center py-3 text-success">Hadir</th>
                                <th class="text-center py-3 text-warning">Terlambat</th>
                                <th class="text-center py-3 text-primary">Izin</th>
                                <th class="text-center py-3 text-info">Sakit</th>
                                <th class="text-center py-3 text-danger">Alpa</th>
                                <th class="text-center px-4 py-3">Persentase</th>
                                <th class="text-center px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="font-14">
                            @forelse ($rekaps as $rekap)
                                <tr>
                                    <td class="px-4 py-3 fw-bold text-dark">{{ $rekap->nama }}</td>
                                    <td class="text-center py-3">{{ $rekap->total_hari }} Hari</td>
                                    <td class="text-center py-3 fw-bold text-success">{{ $rekap->hadir }}</td>
                                    <td class="text-center py-3 fw-bold text-warning">{{ $rekap->terlambat }}</td>
                                    <td class="text-center py-3 fw-bold text-primary">{{ $rekap->izin }}</td>
                                    <td class="text-center py-3 fw-bold text-info">{{ $rekap->sakit }}</td>
                                    <td class="text-center py-3 fw-bold text-danger">{{ $rekap->alpa }}</td>
                                    <td class="text-center px-4 py-3">
                                        @php
                                            $badgeColor = 'bg-success';
                                            if ($rekap->persentase < 50) {
                                                $badgeColor = 'bg-danger';
                                            } elseif ($rekap->persentase < 80) {
                                                $badgeColor = 'bg-warning text-dark';
                                            }
                                        @endphp
                                        <span
                                            class="badge {{ $badgeColor }} px-2.5 py-1.5 fs-7">{{ $rekap->persentase }}%</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('rekap.show', ['id' => $rekap->id, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                            class="btn-action btn-view" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <!-- Diubah dari 8 menjadi 9 agar pas menutup seluruh kolom -->
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="bi bi-calendar-x d-block fs-2 mb-2"></i>
                                        Belum ada rekaman data kehadiran pada bulan ini.
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
