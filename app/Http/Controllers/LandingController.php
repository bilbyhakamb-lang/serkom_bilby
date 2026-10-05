<?php

namespace App\Http\Controllers;

use App\Models\ProfileSekolah;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Berita;
use App\Models\Ekstrakulikuler;
use App\Models\Galeri;

class LandingController extends Controller
{
    public function index()
    {
        // Mengambil data profil sekolah
        $profil = ProfileSekolah::first();

        // Mengambil semua data guru
        $guru = Guru::latest()->get();

        // Mengambil semua data siswa
        $siswa = Siswa::latest()->get();

        // Menghitung jumlah siswa untuk statistik
        $jumlahSiswa = $siswa->count();

        // Mengambil semua berita
        $berita = Berita::latest()->get();

        // Mengambil semua ekstrakurikuler
        $eskul = Ekstrakulikuler::latest()->get();

        // Mengambil semua galeri
        $galeri = Galeri::latest()->get();

        // Mengirim semua data ke landing.index
        return view('landing.index', compact(
            'profil',
            'guru',
            'siswa',
            'jumlahSiswa',
            'berita',
            'eskul',
            'galeri'
        ));
    }
}