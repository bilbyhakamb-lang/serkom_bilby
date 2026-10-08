<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware;


/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIC
|--------------------------------------------------------------------------
*/

// Halaman utama / landing page
Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

// Detail berita untuk halaman landing
Route::get('/berita-detail/{id}', [BeritaController::class, 'show'])
    ->name('landing.berita.detail');

// Halaman login
Route::get('/login', function () {
    return view('login.login');
})->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'processLogin'])
    ->name('login.process');


/*
|--------------------------------------------------------------------------
| HALAMAN ADMIN
|--------------------------------------------------------------------------
|
| Semua route di bawah ini hanya bisa diakses oleh user
| yang sudah login karena menggunakan middleware auth.
|
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', function () {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.dashboard');


    /*
    |--------------------------------------------------------------------------
    | PROFILE SEKOLAH
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileSekolahController::class, 'index'])->name('admin.profile');
    Route::get('/profile/edit', [ProfileSekolahController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/store', [ProfileSekolahController::class, 'save'])->name('profile.store');
    Route::put('/profile/update', [ProfileSekolahController::class, 'save'])->name('profile.update');


    /*
    |--------------------------------------------------------------------------
    | GURU
    |--------------------------------------------------------------------------
    */
    // Menampilkan semua data guru
    Route::get('/guru', [GuruController::class, 'index'])->name('admin.guru');
    // Menampilkan form tambah guru
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    // Menyimpan data guru
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    // Menampilkan form edit guru
    Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    // Mengupdate data guru
    Route::put('/guru/{id}', [GuruController::class, 'update'])->name('guru.update');
    // Menghapus data guru
    Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');
    // Jika URL /guru/detail tidak memiliki ID
    Route::get('/guru/detail', function () {
        return redirect()->route('admin.guru');})->name('guru.detail.empty');
    // Detail guru
    Route::get('/guru/{id}/detail', [GuruController::class, 'show'])->name('admin.guru.show');
    // Detail guru untuk halaman landing
    Route::get('/guru/{id}', [GuruController::class, 'detail'])->name('landing.guru.detail');


    /*
    |--------------------------------------------------------------------------
    | SISWA
    |--------------------------------------------------------------------------
    */
    // Menampilkan data siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
    // Menyimpan data siswa
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    // Form tambah dan edit siswa
    Route::get('/siswa/form/{id?}', [SiswaController::class, 'addEdit'])->name('siswa.form');
    // Mengupdate data siswa
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    // Menghapus data siswa
    Route::delete('/siswa/delete/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    // Detail siswa
    Route::get('/siswa/{id}/detail', [SiswaController::class, 'show'])->name('admin.siswa.show');


    /*
    |--------------------------------------------------------------------------
    | BERITA
    |--------------------------------------------------------------------------
    */

    // Menampilkan semua berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita');
    // Form tambah berita
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    // Menyimpan berita
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    // Form edit berita
    Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    // Mengupdate berita
    Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    // Menghapus berita
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
    // Detail berita
    Route::get('/berita/detail/{id}', [BeritaController::class, 'detail'])->name('admin.berita.detail');
    // Menampilkan berita berdasarkan ID
    Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');


    /*
    |--------------------------------------------------------------------------
    | EKSTRAKULIKULER
    |--------------------------------------------------------------------------
    */

    // Menampilkan semua ekstrakurikuler
    Route::get('/ekstrakulikuler', [EkstrakulikulerController::class, 'index'])->name('admin.ekstrakulikuler');
    // Form tambah ekstrakurikuler
    Route::get('/eskul/tambah', [EkstrakulikulerController::class, 'create'])->name('eskul.create');
    // Menyimpan ekstrakurikuler
    Route::post('/eskul', [EkstrakulikulerController::class, 'store']) ->name('eskul.store');
    // Form edit ekstrakurikuler
    Route::get('/eskul/{id}/edit', [EkstrakulikulerController::class, 'edit'])->name('eskul.edit');
    // Mengupdate ekstrakurikuler
    Route::put('/eskul/{id}', [EkstrakulikulerController::class, 'update'])->name('eskul.update');
    // Menghapus ekstrakurikuler
    Route::delete('/eskul/{id}', [EkstrakulikulerController::class, 'destroy'])->name('eskul.destroy');
    // Detail ekstrakurikuler
    Route::get('/ekstrakulikuler/detail/{id?}', [EkstrakulikulerController::class, 'show'])->where('id', '.*')->name('admin.ekstrakulikuler.show');


    /*
    |--------------------------------------------------------------------------
    | GALERI
    |--------------------------------------------------------------------------
    */
    // Menampilkan semua galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
    // Form tambah galeri
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    // Menyimpan galeri
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    // Form edit galeri
    Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    // Mengupdate galeri
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    // Menghapus galeri
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
    // Detail galeri
    Route::get('/galeri/{id}/detail', [GaleriController::class, 'show'])->name('admin.galeri.detail');


    /*
    |--------------------------------------------------------------------------
    | DATA USER - KHUSUS ADMIN
    |--------------------------------------------------------------------------
    |
    | Route di bawah ini menggunakan AdminMiddleware.
    | Hanya user dengan role Admin yang dapat mengaksesnya.
    |
    */

    Route::middleware(AdminMiddleware::class)->group(function () {

        // Menampilkan data user
        Route::get('/user', [UserController::class, 'index'])->name('admin.user');
        // Form tambah user
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        // Menyimpan user
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        // Form edit user
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        // Mengupdate user
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        // Menghapus user
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

});