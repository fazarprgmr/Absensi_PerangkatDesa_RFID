@extends('layouts.app')

@section('title', 'Alamat')

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
                    <h1 class="h3 mb-0 text-gray-800">Data Alamat</h1>
                    <p class="text-muted mb-0">Kelola data alamat</p>
                </div>
            </div>
        </div>

        <!-- Alamat DataTable -->
        <div class="dashboard-card">
            <div class="dashboard-card-header py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Alamat</h5>
                <a href="{{ route('alamat.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus me-1"></i>Tambah Data
                </a>
            </div>
            <div class="dashboard-card-body px-4 py-4">
                <table id="dataTableDesa" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dusun</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alamats as $alamat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-uppercase">{{ $alamat->dusun }}</td>
                                <td>
                                    <a href="{{ route('alamat.edit', $alamat->id) }}" class="btn-action btn-edit"
                                        title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form id="delete-form-{{ $alamat->id }}" method="POST"
                                        action="{{ route('alamat.destroy', $alamat->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $alamat->id }})"
                                            class="btn-action btn-delete" title="Delete"><i
                                                class="bi bi-trash"></i></button>
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
