<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('login.login');
})->name('login');

Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');

Route::post('/admin/profil-sekolah/save', [ProfileSekolahController::class, 'save'])->name('admin.profil-sekolah.save');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dashboard');
Route::get('/profile', [ProfileSekolahController::class, 'index'])->name('admin.profile');
Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita');
Route::get('/ekstrakulikuler', [EkstrakulikulerController::class, 'index'])->name('admin.ekstrakulikuler');
Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri');

Route::get('/guru', [GuruController::class, 'index'])->name('admin.guru');
Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');

// CRUD Siswa
Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/form/{id?}', [SiswaController::class, 'addEdit'])->name('siswa.form');
Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/delete/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');