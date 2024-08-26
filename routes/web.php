<?php
use App\Http\Controllers\EventController;
use App\Http\Controllers\TamuUserController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Models\Tamu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


 // Disable registration route
// Disable public registration route


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
Route::get('/formulir-konfirmasi-tamu/{x}', [TamuController::class, 'formKonfirmasi'])->middleware(['auth', 'verified'])->name('tamu.konfirmasi');
Route::put('/konfirmasi-tamu/{x}', [TamuController::class, 'konfirmasi'])->middleware(['auth', 'verified'])->name('tamu.simpan_konfirmasi');

Route::get('/user', [TamuUserController::class, 'formTamu'])->name('form.tamu');

Route::get('/admins', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('admins');
Route::get('/admins/create', [AdminController::class, 'create'])->middleware(['auth', 'verified'])->name('admins.create');
Route::post('/admins/store', [AdminController::class, 'simpan'])->middleware(['auth', 'verified'])->name('admins.store');


Route::post('/tamu/simpan', [TamuUserController::class, 'store'])->name('tamu.simpan');
Route::put('/update-tamu/{id}', [TamuController::class, 'update'])->name('tamu.update');

// Route::post('/admins/{x}', [AdminController::class, 'update'])->middleware(['auth', 'verified'])->name('update');
Route::delete('/admins.hapus/{id}', [AdminController::class, 'hapus'])->middleware(['auth', 'verified'])->name('admins.hapus');

Route::get('/admins/edit/{id}', [AdminController::class, 'edit'])->name('admins.edit');
Route::put('/admins/update/{id}', [AdminController::class, 'update'])->name('admins.update');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/update-tamu/{id}', [TamuController::class, 'update'])->name('tamu.update');


    Route::get('/events', [EventController::class, 'getEvents']);
    Route::post('/events', [EventController::class, 'store']);
Route::patch('/events/{id}', [EventController::class, 'update']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);
// routes/web.php
Route::get('/events', [EventController::class, 'index']);
// Di web.php atau api.php
Route::resource('events', EventController::class);





    
});

require __DIR__.'/auth.php';
