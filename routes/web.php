<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
});

require __DIR__.'/auth.php';
