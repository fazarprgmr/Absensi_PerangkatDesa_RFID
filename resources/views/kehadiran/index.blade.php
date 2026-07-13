@extends('layouts.app')

@section('title', 'Kehadiran')

@push('styles')
    <link rel="stylesheet" crossorigin href="{{ asset('template/assets/data-table-D3bj5bdn.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('css/custom-css-table.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Data Kehadiran</h1>
                    <p class="text-muted mb-0">Kelola data kehadiran perangkat desa</p>
                </div>
            </div>
        </div>

        <!-- Kehadiran DataTable -->
        <div class="dashboard-card">
            <div class="dashboard-card-header py-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Daftar Kehadiran</h5>
                    <small class="mb-0">
                        {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l / d-m-Y') }}
                    </small>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('kehadiran.cetak') }}" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Cetak PDF
                    </a>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('kehadiran.create') }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus me-1"></i>Tambah Data
                        </a>
                    @endif
                </div>
            </div>
            <div class="text-center dashboard-card-body px-4 py-4">
                <table id="dataTableDesa" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jam Masuk</th>
                            <th class="text-center">Jam Pulang</th>
                            <th class="text-center">Kehadiran</th>
                            <th class="text-center">Ketepatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kehadirans as $kehadiran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kehadiran->perangkatDesa->nama }}</td>
                                <td>{{ $kehadiran->jam_masuk ?? '-' }}</td>
                                <td>{{ $kehadiran->jam_pulang ?? '-' }}</td>
                                @php
                                    $statusKehadiranClass = match ($kehadiran->status_kehadiran) {
                                        'hadir' => 'bg-success',
                                        'sakit' => 'bg-warning',
                                        'izin' => 'bg-info',
                                        'alpa' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };

                                    $statusKetepatanClass = match ($kehadiran->status_ketepatan) {
                                        'tepat waktu' => 'status-active',
                                        'terlambat' => 'status-pending',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <td class="text-uppercase">
                                    <span class="badge {{ $statusKehadiranClass }}">
                                        {{ $kehadiran->status_kehadiran }}
                                    </span>
                                </td>
                                <td class="text-capitalize">
                                    @if ($kehadiran->status_ketepatan)
                                        <span class="status-badge {{ $statusKetepatanClass }}">
                                            {{ $kehadiran->status_ketepatan }}
                                        </span>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('kehadiran.show', $kehadiran->id) }}" class="btn-action btn-view"
                                        title="Lihat Detail & Foto"><i class="bi bi-eye"></i>
                                    </a>
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('kehadiran.edit', $kehadiran->id) }}" class="btn-action btn-edit"
                                            title="Edit"><i class="bi bi-pencil"></i>
                                        </a>
                                        <form id="delete-form-{{ $kehadiran->id }}" method="POST"
                                            action="{{ route('kehadiran.destroy', $kehadiran->id) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $kehadiran->id }})"
                                                class="btn-action btn-delete" title="Delete"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module" crossorigin src="{{ asset('template/assets/data-table-DNS4anqs.js') }}"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {

                    Swal.fire({
                        title: "Menghapus data...",
                        text: "Mohon tunggu sebentar...",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
