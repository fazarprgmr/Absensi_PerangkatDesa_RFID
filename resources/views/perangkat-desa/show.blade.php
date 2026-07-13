@extends('layouts.app')

@section('title', 'Detail Perangkat Desa')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Profil Perangkat Desa</h1>
                <p class="text-muted mb-0">Informasi biodata lengkap dan jabatan aparatur desa</p>
            </div>
            <a href="{{ route('perangkat-desa.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="dashboard-card text-center h-100 py-4 px-3">
                    <div class="dashboard-card-body d-flex flex-column align-items-center justify-content-center">
                        
                        @if($perangkatDesa->foto)
                            <div class="mb-3">
                                <img src="{{ asset('storage/perangkat_desa_profil/' . $perangkatDesa->foto) }}" 
                                     alt="Foto {{ $perangkatDesa->nama }}" 
                                     class="rounded-circle shadow-sm"
                                     style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #0d6efd;">
                            </div>
                        @else
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mb-3 shadow-sm" 
                                 style="width: 100px; height: 100px; font-size: 3rem; font-weight: bold;">
                                {{ strtoupper(substr($perangkatDesa->nama, 0, 1)) }}
                            </div>
                        @endif
                        <h4 class="mb-1 text-gray-800">{{ $perangkatDesa->nama }}</h4>
                        <span class="badge bg-primary px-3 py-2 rounded-pill text-uppercase mb-2">
                            {{ $perangkatDesa->jabatan->nama_jabatan ?? 'Belum Ada Jabatan' }}
                        </span>
                        <p class="text-muted small mb-4">ID RFID / UID: <code class="text-danger">{{ $perangkatDesa->rfid_uid ?? '-' }}</code></p>
                        
                        <div class="d-flex gap-2 w-100 justify-content-center">
                            <a href="{{ route('perangkat-desa.edit', $perangkatDesa->id) }}" class="btn btn-sm btn-outline-primary px-3">
                                <i class="bi bi-pencil me-1"></i> Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mb-4">
                <div class="dashboard-card h-100">
                    <div class="dashboard-card-header py-3 px-4">
                        <h5 class="mb-0"><i class="bi bi-person-lines-fill me-2 text-primary"></i>Biodata Lengkap</h5>
                    </div>
                    <div class="dashboard-card-body px-4 py-4">
                        <table class="table table-borderless fs-6">
                            <tr class="border-bottom">
                                <th width="30%" class="py-3 text-muted">Nama Lengkap</th>
                                <td width="5%" class="py-3">:</td>
                                <td class="py-3 text-gray-800 fw-bold">{{ $perangkatDesa->nama }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="py-3 text-muted">Nomor Induk (NIP/NIK)</th>
                                <th class="py-3">:</th>
                                <td class="py-3 fw-semibold text-primary">{{ $perangkatDesa->nip ?? $perangkatDesa->nik ?? '-' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="py-3 text-muted">Jabatan Struktur</th>
                                <td class="py-3">:</td>
                                <td class="py-3 fw-semibold text-primary">{{ $perangkatDesa->jabatan->nama_jabatan ?? '-' }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="py-3 text-muted">No. Telepon / WA</th>
                                <td class="py-3">:</td>
                                <td class="py-3">
                                    @if($perangkatDesa->no_hp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $perangkatDesa->no_hp) }}" target="_blank" class="text-decoration-none">
                                            {{ $perangkatDesa->no_hp }} <i class="bi bi-whatsapp text-success ms-1"></i>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <th class="py-3 text-muted">Alamat Tempat Tinggal</th>
                                <td class="py-3">:</td>
                                <td class="py-3 fw-semibold text-primary">
                                    {{ $perangkatDesa->alamat->dusun ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="py-3 text-muted">Terdaftar Pada Sistem</th>
                                <td class="py-3">:</td>
                                <td class="py-3 text-muted small">
                                    {{ $perangkatDesa->created_at ? $perangkatDesa->created_at->translatedFormat('d F Y (H:i)') : '-' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection