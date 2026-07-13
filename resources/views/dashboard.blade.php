@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 font-bold">Dashboard Absensi</h1>
                    <p class="text-muted text-sm">Ringkasan data kehadiran perangkat desa hari ini.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('kehadiran.cetak') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-printer me-2"></i>Cetak Laporan
                    </a>
                </div>
            </div>
        </div>

        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-4">

                <div class="dashboard-card">
                    <div class="dashboard-card-body text-center">
                        <div class="mb-3">
                            <div class="stat-icon-large bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-people-fill" style="font-size: 24px; color: #0d6efd;"></i>
                            </div>
                        </div>
                        <div class="stat-value text-primary fw-bold mb-1" style="font-size: 2rem;">{{ $totalPerangkatDesa }}
                        </div>
                        <div class="stat-label text-muted mb-2">Total Perangkat Desa</div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="dashboard-card-body text-center">
                        <div class="mb-3">
                            <div class="stat-icon-large bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-check-circle-fill" style="font-size: 24px; color: #198754;"></i>
                            </div>
                        </div>
                        <div class="stat-value text-success fw-bold mb-1" style="font-size: 2rem;">{{ $totalHadirHariIni }}
                        </div>
                        <div class="stat-label text-muted mb-2">Hadir Hari Ini</div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="dashboard-card-body text-center">
                        <div class="mb-3">
                            <div class="stat-icon-large bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-envelope-paper-fill" style="font-size: 24px; color: #ffc107;"></i>
                            </div>
                        </div>
                        <div class="stat-value text-warning fw-bold mb-1" style="font-size: 2rem;">
                            {{ $totalSakitIzinHariIni }}
                        </div>
                        <div class="stat-label text-muted mb-2">Sakit & Izin</div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="dashboard-card-body text-center">
                        <div class="mb-3">
                            <div class="stat-icon-large bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-x-circle-fill" style="font-size: 24px; color: #dc3545;"></i>
                            </div>
                        </div>
                        <div class="stat-value text-danger fw-bold mb-1" style="font-size: 2rem;">
                            {{ $totalTidakHadirHariIni }}
                        </div>
                        <div class="stat-label text-muted mb-2">Tidak Hadir (Alpa)</div>
                    </div>
                </div>

            </div>
        </div>

        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-2">

                <div class="dashboard-card">
                    <div class="dashboard-card-header d-flex justify-content-between align-items-center">
                        <h5 class="dashboard-card-title mb-0">Live Kamera: Absensi Terbaru</h5>
                        <a href="{{ route('kehadiran.index') }}" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
                    </div>
                    <div class="dashboard-card-body">
                        <div class="list-group list-group-flush">
                            @forelse($absensiTerbaru as $absen)
                                <div class="list-group-item d-flex align-items-center px-0 py-3">
                                    <div class="me-3">
                                        @if ($absen->foto_bukti)
                                            <img src="{{ asset('storage/absensi/' . $absen->foto_bukti) }}" alt="Foto"
                                                style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover; border: 1px solid #ddd;">
                                        @else
                                            <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px; border-radius: 8px;">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $absen->perangkatDesa->nama ?? 'Tanpa Nama' }}</h6>
                                        <small
                                            class="text-muted">{{ $absen->perangkatDesa->jabatan->nama_jabatan ?? 'Perangkat Desa' }}</small>

                                        @if ($absen->status_kehadiran == 'hadir')
                                            <div class="small text-muted">
                                                <i class="bi bi-clock me-1"></i> Jam Masuk:
                                                {{ $absen->jam_masuk ?? '--:--' }}
                                            </div>
                                        @endif
                                    </div>

                                    <div>
                                        @if ($absen->status_kehadiran == 'hadir')
                                            <span class="badge bg-success text-white">Hadir</span>
                                        @elseif ($absen->status_kehadiran == 'sakit')
                                            <span class="badge bg-warning text-white">Sakit</span>
                                        @elseif ($absen->status_kehadiran == 'izin')
                                            <span class="badge bg-primary text-white">Izin</span>
                                        @else
                                            <span class="badge bg-danger text-white" style="text-transform: capitalize;">
                                                {{ $absen->status_kehadiran }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1"></i>
                                    <p class="mt-2">Belum ada data absensi hari ini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="dashboard-card-header">
                        <h5 class="dashboard-card-title mb-0">Grafik Kehadiran (7 Hari Terakhir)</h5>
                    </div>
                    <div class="dashboard-card-body">
                        <div class="chart-container" style="position: relative; height:300px; width:100%">
                            <canvas id="attendanceChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('attendanceChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartLabels ?? []) !!},
                        datasets: [{
                            label: 'Jumlah Hadir',
                            data: {!! json_encode($chartData ?? []) !!},
                            borderColor: '#0d6efd',
                            backgroundColor: 'rgba(13, 110, 253, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                } // Agar angka desimal tidak muncul di sumbu y (orang ga mungkin 1.5)
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
