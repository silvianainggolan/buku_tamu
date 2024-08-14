<?php


use App\Http\Controllers\TamuController;
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




Route::get('/tamu', [TamuController::class, 'index'])->middleware(['auth', 'verified'])->name('tamu');
Route::get('/tambah-tamu', [TamuController::class, 'tambah'])->middleware(['auth', 'verified'])->name('tamu.tambah');
Route::post('/simpan-tamu', [TamuController::class, 'simpan'])->middleware(['auth', 'verified'])->name('tamu.simpan');


Route::get('/user', function () {
    return view('user');
});
Route::get('/admins', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('admins');
Route::get('/admins', [adminController::class, 'create'])->middleware(['auth', 'verified'])->name('admins');
Route::post('/admins', [adminController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit');
Route::post('/admins/{x}', [adminController::class, 'update'])->middleware(['auth', 'verified'])->name('update');
Route::delete('/admins.hapus/{id}', [adminController::class, 'hapus'])->middleware(['auth', 'verified'])->name('hapus');

    


Route::resource('/simpan-tamu_user', \App\Http\Controllers\Tamu_UserController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
