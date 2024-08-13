<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pegawai', [PegawaiController::class, 'index'])->middleware(['auth', 'verified'])->name('pegawai');
Route::get('/tambah-pegawai', [PegawaiController::class, 'tambah'])->middleware(['auth', 'verified'])->name('pegawai.tambah');
Route::post('/simpan-pegawai', [PegawaiController::class, 'simpan'])->middleware(['auth', 'verified'])->name('pegawai.simpan');

Route::get('/tamu', function () {
    return view('tamu');
})->middleware(['auth', 'verified'])->name('tamu');

Route::get('/user', function () {
    return view('user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
