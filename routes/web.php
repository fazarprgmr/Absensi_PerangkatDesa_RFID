<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\ProfileController;
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
});

require __DIR__.'/auth.php';
