<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard bisa diakses semua yang berhasil login (Admin & Kades)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // ====================================================================
    // 🔴 AKSES KHUSUS: HANYA ADMIN (Manipulasi Data & Pengaturan Sistem)
    // ====================================================================
    Route::middleware('role:admin')->group(function () {

        // Pengaturan Sistem
        Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

        // Modul Kehadiran (Khusus Manipulasi: Tambah, Edit, Hapus)
        Route::get('/kehadiran/create', [KehadiranController::class, 'create'])->name('kehadiran.create');

        // Memproses simpan data baru
        Route::post('/kehadiran', [KehadiranController::class, 'store'])->name('kehadiran.store');

        // Menampilkan form edit
        Route::get('/kehadiran/{id}/edit', [KehadiranController::class, 'edit'])->name('kehadiran.edit');

        // Memproses update data
        Route::put('/kehadiran/{id}', [KehadiranController::class, 'update'])->name('kehadiran.update');

        // Memproses hapus data
        Route::delete('/kehadiran/{id}', [KehadiranController::class, 'destroy'])->name('kehadiran.destroy');

        // Master Data (Hanya Admin yang bisa kelola data inti desa)
        Route::resource('perangkat-desa', PerangkatDesaController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('user', UserController::class);

        // Fitur RFID (Untuk pendaftaran Perangkat Desa baru oleh Admin)
        Route::get('/get-temp-rfid', function () {
            return response()->json(['rfid_uid' => Cache::get('temp_rfid')]);
        });

        Route::get('/clear-temp-rfid', function () {
            Cache::forget('temp_rfid');

            return response()->json(['message' => 'Cache cleared']);
        });

    });

    // ====================================================================
    // 🟢 AKSES BERSAMA: ADMIN & KADES (Hanya Lihat dan Cetak Laporan)
    // ====================================================================

    // Kelola Profil Akun Masing-masing
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Modul Kehadiran (Khusus Lihat & Cetak)
    Route::get('/kehadiran/cetak', [KehadiranController::class, 'cetak'])->name('kehadiran.cetak');
    // Menampilkan daftar tabel kehadiran
    Route::get('/kehadiran', [KehadiranController::class, 'index'])->name('kehadiran.index');
    // Menampilkan detail 1 data (PENTING: Rute {id} wajib di urutan paling bawah!)
    Route::get('/kehadiran/{id}', [KehadiranController::class, 'show'])->name('kehadiran.show');

    // Modul Rekap Absensi (Semua bisa akses penuh karena murni laporan)
    Route::get('/rekap-absensi', [RekapController::class, 'index'])->name('rekap.index');
    Route::get('/rekap-absensi/cetak', [RekapController::class, 'cetak'])->name('rekap.cetak');
    Route::get('/rekap-absensi/{id}/detail', [RekapController::class, 'show'])->name('rekap.show');
    Route::get('/rekap-absensi/{id}/cetak-detail', [RekapController::class, 'cetakDetail'])->name('rekap.cetakDetail');
});

require __DIR__.'/auth.php';
