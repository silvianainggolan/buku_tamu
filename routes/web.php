<?php

use App\Http\Controllers\TamuUserController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Models\Tamu;
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
Route::get('/edit-pegawai/{x}', [PegawaiController::class, 'edit'])->middleware(['auth', 'verified'])->name('pegawai.edit');
Route::post('/update-pegawai/{x}', [PegawaiController::class, 'update'])->middleware(['auth', 'verified'])->name('pegawai.update');
Route::delete('/hapus-pegawai/{id}', [PegawaiController::class, 'hapus'])->middleware(['auth', 'verified'])->name('pegawai.hapus');




Route::get('/tamu', [TamuController::class, 'index'])->middleware(['auth', 'verified'])->name('tamu');
Route::get('/tambah-tamu', [TamuController::class, 'tambah'])->middleware(['auth', 'verified'])->name('tamu.tambah');
Route::post('/simpan-tamu', [TamuController::class, 'simpan'])->middleware(['auth', 'verified'])->name('tamu.simpan');
Route::get('/edit-tamu/{x}', [TamuController::class, 'edit'])->middleware(['auth', 'verified'])->name('tamu.edit');
Route::post('/update-tamu/{x}', [TamuController::class, 'update'])->middleware(['auth', 'verified'])->name('tamu.update');
Route::delete('/hapus-tamu/{id}', [TamuController::class, 'hapus'])->middleware(['auth', 'verified'])->name('tamu.hapus');



Route::get('/user', function () {
    return view('user');
});


Route::post('/tamu/simpan', [TamuUserController::class, 'store'])->name('tamu.simpan');
Route::put('/update-tamu/{id}', [TamuController::class, 'update'])->name('tamu.update');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/update-tamu/{id}', [TamuController::class, 'update'])->name('tamu.update');
});

require __DIR__.'/auth.php';
