<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('admin_app');
});




Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/profile', [ProfileSekolahController::class, 'index'])->name('admin.profile');
Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita');
Route::get('/ekstrakulikuler', [GuruController::class, 'index'])->name('admin.ekstrakulikuler');
Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
Route::get('/guru', [GuruController::class, 'index'])->name('admin.guru');
Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::post('/login', [SiswaController::class, 'index'])->name('admin.login');
