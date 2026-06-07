@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <h4 class="page-title">Pengaturan Sistem</h4>
                <p class="text-muted">Atur parameter jam kerja desa dan informasi penandatanganan dokumen resmi.</p>
            </div>
        </div>

        <!-- Form Tabs -->
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <div class="dashboard-card">
                    <div class="dashboard-card-body">
                        @php
                            $accountTabActive = session('active_tab') == 'account';
                        @endphp
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs mb-4" id="studentFormTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ !$accountTabActive ? 'active' : '' }}" id="basic-tab"
                                    data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab"
                                    aria-controls="basic" aria-selected="true">
                                    <i class="bi bi-clock me-2"></i>Konfigurasi Jam Kerja
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $accountTabActive ? 'active' : '' }}" id="account-tab"
                                    data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab"
                                    aria-controls="account" aria-selected="false">
                                    <i class="bi bi-person-lines-fill me-2"></i>Informasi Penandatangan Laporan
                                </button>
                            </li>
                        </ul>
                        <form action="{{ route('pengaturan.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="active_tab_input" name="active_tab"
                                value="{{ $accountTabActive ? 'account' : 'basic' }}">
                            <div class="tab-content" id="studentFormTabContent">
                                {{-- ===================== --}}
                                {{-- FORM EDIT JAM KERJA --}}
                                {{-- ===================== --}}
                                <div class="tab-pane fade {{ !$accountTabActive ? 'show active' : '' }}" id="basic"
                                    role="tabpanel" aria-labelledby="basic-tab">
                                    <div class="row gx-4 gy-3">
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label class="form-label font-14 fw-bold text-secondary">Jam Masuk</label>
                                                <input type="time" name="jam_masuk" class="form-control"
                                                    value="{{ $pengaturan->jam_masuk }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="md-4">
                                                <label class="form-label font-14 fw-bold text-secondary">Jam Pulang
                                                    Kerja</label>
                                                <input type="time" name="jam_pulang" class="form-control"
                                                    value="{{ $pengaturan->jam_pulang }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label class="form-label font-14 fw-bold text-secondary">Batas Toleransi
                                                    Terlambat</label>
                                                <input type="time" name="jam_toleransi" class="form-control"
                                                    value="{{ $pengaturan->jam_toleransi }}" required>
                                                <div class="form-text font-12 text-warning">Lewat dari jam ini otomatis
                                                    dihitung
                                                    Terlambat.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12 px-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- ===================== --}}
                                {{-- FORM EDIT NAMA KEPALA DESA --}}
                                {{-- ===================== --}}
                                <div class="tab-pane fade {{ $accountTabActive ? 'show active' : '' }}" id="account"
                                    role="tabpanel" aria-labelledby="account-tab">
                                    <div class="row gx-4 gy-3">
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label class="form-label font-14 fw-bold text-secondary">Nama Kepala
                                                    Desa</label>
                                                <input type="text" name="nama_kades" class="form-control"
                                                    value="{{ $pengaturan->nama_kades }}" required
                                                    placeholder="Contoh: Mista Rangun">
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-2">
                                            <div class="mb-4">
                                                <label class="form-label font-14 fw-bold text-secondary">NIP Kepala
                                                    Desa</label>
                                                <input type="text" name="nip_kades" class="form-control"
                                                    value="{{ $pengaturan->nip_kades }}"
                                                    placeholder="Beri tanda '-' jika tidak ada">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12 px-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('basic-tab')
                .addEventListener('click', function() {
                    document.getElementById('active_tab_input').value = 'basic';
                });

            document.getElementById('account-tab')
                .addEventListener('click', function() {
                    document.getElementById('active_tab_input').value = 'account';
                });

        });
    </script>
@endsection
