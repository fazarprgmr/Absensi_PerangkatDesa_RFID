@extends('layouts.app')

@section('title', 'Edit Alamat')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <h4 class="page-title">Edit Alamat</h4>
                <p class="text-muted">Isi informasi di bawah ini untuk mengedit alamat</p>
            </div>
        </div>
        <!-- Form Tabs -->
        <div class="dashboard-row">
            <div class="dashboard-grid grid-cols-1">
                <div class="dashboard-card">
                    <div class="dashboard-card-body">
                        <!-- Tab Content -->
                        <div class="tab-content" id="alamatFormTabContent">
                            <!-- Basic Information Tab -->
                            <div class="tab-pane fade show active" id="basic" role="tabpanel"
                                aria-labelledby="basic-tab">
                                <form class="needs-validation" novalidate method="POST"
                                    action="{{ route('alamat.update', $alamat->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row gx-4 gy-3">
                                        <div class="col-md-12 px-2">
                                            <div class="mb-4">
                                                <label for="dusun" class="form-label">Nama Dusun <span class="text-danger">*</span></label>
                                                <input type="text" name="dusun" class="form-control @error('dusun') is-invalid @enderror"
                                                    id="dusun" placeholder="Masukan Nama Dusun"
                                                    value="{{ $alamat->dusun }}" required>

                                                @error('dusun')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 px-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-circle me-2"></i>Simpan
                                            </button>
                                            <button type="button" class="btn btn-secondary ms-2"
                                                onclick="window.location.href='{{ route('alamat.index') }}'">
                                                <i class="bi bi-x-circle me-2"></i>Cancel
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
    @endsection
