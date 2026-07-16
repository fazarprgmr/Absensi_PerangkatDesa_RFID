@extends('layouts.app')

@section('title', 'Jabatan')

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
                    <h1 class="h3 mb-0 text-gray-800">Data Jabatan</h1>
                    <p class="text-muted mb-0">Kelola data jabatan</p>
                </div>
            </div>
        </div>

        <!-- Jabatan DataTable -->
        <div class="dashboard-card">
            <div class="dashboard-card-header py-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Data Jabatan</h5>
                <a href="{{ route('jabatan.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Data
                </a>
            </div>
            <div class="dashboard-card-body px-4 py-4">
                <table id="dataTableDesa" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Jabatan</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Updated At</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jabatans as $jabatan)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-uppercase text-center">{{ $jabatan->nama_jabatan }}</td>
                                <td class="text-center">{{ $jabatan->created_at }}</td>
                                <td class="text-center">{{ $jabatan->updated_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('jabatan.edit', $jabatan->id) }}" class="btn-action btn-edit"
                                        title="Edit"><i class="bi bi-pencil"></i></a>

                                    <form id="delete-form-{{ $jabatan->id }}" method="POST"
                                        action="{{ route('jabatan.destroy', $jabatan->id) }}" class="form-hapus d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <!-- Perbaikan: Mengirimkan data-nama, data-dipakai, dan merapikan sintaks HTML button -->
                                        <button type="button" onclick="confirmDelete(this, {{ $jabatan->id }})"
                                            class="btn-action btn-delete" title="Delete"
                                            data-nama="{{ $jabatan->nama_jabatan }}"
                                            data-dipakai="{{ $jabatan->perangkat_desas_count ?? 0 }}">
                                            <i class="bi bi-trash"></i>
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
    <!-- Pastikan SweetAlert2 sudah di-load di layout utama, jika belum, uncomment baris di bawah ini -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" crossorigin src="{{ asset('template/assets/data-table-DNS4anqs.js') }}"></script>

    <script>
        function confirmDelete(button, id) {
            // Ambil data dari atribut tombol yang diklik
            const namaJabatan = button.getAttribute('data-nama');
            const jumlahDipakai = parseInt(button.getAttribute('data-dipakai')) || 0;

            let swalOptions = {};

            // LOGIKA 1: Jika jabatan sedang DIPAKAI oleh perangkat desa (Template Peringatan Keras)
            if (jumlahDipakai > 0) {
                swalOptions = {
                    title: "⚠️ PERINGATAN KERAS!",
                    html: `
                    <div style="background-color: #ffe6e6; border-left: 5px solid #d33; padding: 12px; text-align: left; margin-bottom: 15px; border-radius: 4px;">
                        <span style="color: #d33; font-weight: bold;">JABATAN SEDANG DIGUNAKAN!</span><br>
                        Jabatan <b>"${namaJabatan}"</b> saat ini sedang dipakai oleh <b>${jumlahDipakai} Perangkat Desa</b>.
                    </div>
                    <p style="color: #b00020; font-size: 15px; margin-bottom: 10px;">
                        <b>⚡ BAHAYA:</b> Karena sistem terhubung, jika Anda menghapus jabatan ini, maka <b><u>SELURUH DATA PERANGKAT DESA</u> yang menggunakan jabatan ini akan IKUT TERHAPUS PERMANEN!</b>
                    </p>
                    <p style="font-size: 14px; color: #555;">
                        Apakah Anda benar-benar yakin tetap ingin menghapus jabatan ini beserta semua perangkat desanya?
                    </p>
                `,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#b00020",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Ya, Hapus Semuanya!",
                    cancelButtonText: "Batal",
                    focusCancel: true
                };
            }
            // LOGIKA 2: Jika jabatan KOSONG / tidak dipakai (Template Hapus Biasa Bawaanmu)
            else {
                swalOptions = {
                    title: "Apakah Anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                };
            }

            // Tampilkan SweetAlert sesuai pilihan logika di atas
            Swal.fire(swalOptions).then((result) => {
                if (result.isConfirmed) {
                    // Loading animasi saat menghapus data
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
