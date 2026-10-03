<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;


// =====================================================
// LOGIN
// =====================================================
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', function () {
    return view('login.login');
})->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])
    ->name('login.process');
// =====================================================
// SEMUA HALAMAN ADMIN
// =====================================================
Route::middleware('auth')->group(function () {
    // =================================================
    // LOGOUT
    // =================================================
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');

    // =================================================
    // DASHBOARD
    // =================================================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dashboard');


    // =================================================
    // PROFILE SEKOLAH
    // =================================================
    Route::get('/profile', [ProfileSekolahController::class, 'index'])->name('admin.profile');
    Route::get('/profile/edit', [ProfileSekolahController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/store', [ProfileSekolahController::class, 'save'])->name('profile.store');
    Route::put('/profile/update', [ProfileSekolahController::class, 'save'])->name('profile.update');

  // GURU
Route::get('/guru', [GuruController::class, 'index']) ->name('admin.guru');
Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
Route::put('/guru/{id}', [GuruController::class, 'update'])->name('guru.update');
Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');
// URL detail tanpa ID
Route::get('/guru/detail', function () {
    return redirect()->route('admin.guru');
})->name('guru.detail.empty');
// DETAIL GURU
Route::get('/guru/{id}/detail', [GuruController::class, 'show'])->name('admin.guru.show');

    // =================================================
    // SISWA
    // =================================================
    Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/form/{id?}', [SiswaController::class, 'addEdit'])->name('siswa.form');
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/delete/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::get('/siswa/{id}/detail', [SiswaController::class, 'show'])->name('admin.siswa.show');


    // =================================================
    // BERITA
    // =================================================
    Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
    Route::get('/berita/detail/{id}', [BeritaController::class, 'detail']) ->name('admin.berita.detail');
    Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');


// =====================================================
// EKSTRAKULIKULER
// =====================================================

Route::get('/ekstrakulikuler', [EkstrakulikulerController::class, 'index'])
    ->name('admin.ekstrakulikuler');

Route::get('/eskul/tambah', [EkstrakulikulerController::class, 'create'])
    ->name('eskul.create');

Route::post('/eskul', [EkstrakulikulerController::class, 'store'])
    ->name('eskul.store');

Route::get('/eskul/{id}/edit', [EkstrakulikulerController::class, 'edit'])
    ->name('eskul.edit');

Route::put('/eskul/{id}', [EkstrakulikulerController::class, 'update'])
    ->name('eskul.update');

Route::delete('/eskul/{id}', [EkstrakulikulerController::class, 'destroy'])
    ->name('eskul.destroy');


// =====================================================
// DETAIL TANPA ID
// /ekstrakulikuler/detail
// =====================================================

Route::get('/ekstrakulikuler/detail', function () {
    return redirect()
        ->route('admin.ekstrakulikuler')
        ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
})->name('eskul.detail.empty');


// =====================================================
// DETAIL DENGAN ID TERENKRIPSI
// =====================================================

Route::get('/ekstrakulikuler/detail/{id}', [EkstrakulikulerController::class, 'show'])
    ->where('id', '.*')
    ->name('admin.ekstrakulikuler.show');


    // =================================================
    // GALERI
    // =================================================

    Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
    Route::get('/galeri/{id}/detail', [GaleriController::class, 'show'])->name('admin.galeri.detail');

});