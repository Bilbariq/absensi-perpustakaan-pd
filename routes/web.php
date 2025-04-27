<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;

// Halaman Home
Route::get('/', [AbsenController::class, 'home'])->name('home');

// Form tambah absen
Route::get('/absen/create', [AbsenController::class, 'create'])->name('absen.create');

// Proses simpan absen
Route::post('/absen/store', [AbsenController::class, 'store'])->name('absen.store');

// Halaman rekap absen
Route::get('/absen/rekap', [AbsenController::class, 'rekap'])->name('absen.rekap');
