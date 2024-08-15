<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/tamu', function () {
    return view('tamu');
})->middleware(['auth', 'verified'])->name('tamu');

Route::get('/user', function () {
    return view('user');
});
Route::get('/admins', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('admins');
Route::get('/admins/create', [adminController::class, 'create'])->middleware(['auth', 'verified'])->name('admins.create');

Route::post('/admins/{x}', [adminController::class, 'update'])->middleware(['auth', 'verified'])->name('update');
Route::delete('/admins.hapus/{id}', [adminController::class, 'hapus'])->middleware(['auth', 'verified'])->name('admins.hapus');

Route::post('/admins/edit/{id}', [AdminController::class, 'edit'])->name('admins.edit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
