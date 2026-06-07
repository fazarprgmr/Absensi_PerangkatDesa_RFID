<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    Route::get('/kehadiran/cetak', [KehadiranController::class, 'cetak'])->name('kehadiran.cetak');
    Route::get('rekap-absensi/cetak', [RekapController::class, 'cetak'])->name('rekap.cetak');

    Route::get('/rekap-absensi/{id}/detail', [RekapController::class, 'show'])->name('rekap.show');
    Route::get('/rekap-absensi/{id}/cetak-detail', [RekapController::class, 'cetakDetail'])->name('rekap.cetakDetail');

    Route::resource('perangkat-desa', PerangkatDesaController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('alamat', AlamatController::class);
    Route::resource('kehadiran', KehadiranController::class);

    Route::get('/get-temp-rfid', function () {
        return response()->json(['rfid_uid' => Cache::get('temp_rfid')]);
    });

    Route::get('/clear-temp-rfid', function () {
        Cache::forget('temp_rfid');

        return response()->json(['message' => 'Cache cleared']);
    });

    Route::get('/rekap-absensi', [RekapController::class, 'index'])->name('rekap.index');
});

require __DIR__.'/auth.php';
