@extends('layouts.app')

@section('title', 'Perangkat Desa')

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
                    <h1 class="h3 mb-0 text-gray-800">Data Perangkat Desa</h1>
                    <p class="text-muted mb-0">Kelola data perangkat desa</p>
                </div>
            </div>
        </div>

        <!-- Perangkat Desa DataTable -->
        <div class="dashboard-card">
            <div class="dashboard-card-header py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Perangkat Desa</h5>
                <a href="{{ route('perangkat-desa.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus me-1"></i>Tambah Data
                </a>
            </div>
            <div class="dashboard-card-body px-4 py-4">
                <table id="dataTableDesa" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Alamat</th>
                            <th>RFID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perangkatDesa as $pd)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pd->nama }}</td>
                                <td>{{ $pd->jabatan->nama_jabatan }}</td>
                                <td>{{ $pd->alamat->dusun }}</td>
                                <td>{{ $pd->rfid_uid }}</td>
                                <td>
                                    <button class="btn-action btn-view" title="View"><i class="bi bi-eye"></i></button>
                                    <a href="{{ route('perangkat-desa.edit', $pd->id) }}" class="btn-action btn-edit"
                                        title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form id="delete-form-{{ $pd->id }}" method="POST"
                                        action="{{ route('perangkat-desa.destroy', $pd->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $pd->id }})"
                                            class="btn-action btn-delete" title="Delete"><i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
