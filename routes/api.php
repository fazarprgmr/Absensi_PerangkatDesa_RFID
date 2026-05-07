<?php

use App\Http\Controllers\Api\KehadiranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tap-rfid', [KehadiranController::class, 'tapRFID']);