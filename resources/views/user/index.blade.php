@extends('layouts.app')

@section('title', 'User')

@push('styles')
    <link rel="stylesheet" crossorigin href="{{ asset('template/assets/data-table-D3bj5bdn.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('css/custom-css-table.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">User</h1>
                    <p class="text-muted mb-0">Kelola akun Admin dan Kepala Desa (Kades)</p>
                </div>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="dashboard-card">
            <div class="dashboard-card-header py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Akun Sistem</h5>
                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus me-1"></i>Tambah Data
                </a>
            </div>
            <div class="dashboard-card-body px-4 py-4">
                <table id="dataTableDesa" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Hak Akses</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">
                                    @if($user->role === 'admin')
                                        <span class="badge bg-success px-2 py-1 text-uppercase">Admin</span>
                                    @else
                                        <span class="badge bg-primary px-2 py-1 text-uppercase">Kades</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn-action btn-edit"
                                        title="Edit"><i class="bi bi-pencil"></i></a>
                                    
                                    @if($user->id !== auth()->id()) <form id="delete-form-{{ $user->id }}" method="POST"
                                        action="{{ route('user.destroy', $user->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $user->id }})"
                                            class="btn-action btn-delete" title="Delete"><i class="bi bi-trash"></i>
                                        </button>
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