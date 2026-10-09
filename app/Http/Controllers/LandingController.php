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
    // Menampilkan halaman utama landing
    public function index()
    {
        // Mengambil data profil sekolah
        $profil = ProfileSekolah::first();

        // Mengambil semua data guru
        $guru = Guru::latest()->get();

        // Mengambil semua data siswa
        $siswa = Siswa::latest()->get();

        // Menghitung jumlah siswa
        $jumlahSiswa = $siswa->count();

        // Mengambil semua data berita
        $berita = Berita::latest()->get();

        // Mengambil semua data ekstrakurikuler
        $eskul = Ekstrakulikuler::latest()->get();

        // Mengambil semua data galeri
        $galeri = Galeri::latest()->get();

        // Mengirim data ke halaman landing
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

    // Menampilkan detail ekstrakurikuler
    public function detailEskul($id)
    {
        // Mengambil data profil sekolah
        $profil = ProfileSekolah::first();

        // Mengambil data ekstrakurikuler berdasarkan ID
        $eskul = Ekstrakulikuler::where('id_ekskul', $id)->first();

        // Jika data tidak ditemukan, kembali ke halaman utama
        if (!$eskul) {
            return redirect()->route('landing');
        }

        // Menampilkan halaman biodata ekstrakurikuler
        return view('landing.eskul-detail', compact(
            'profil',
            'eskul'
        ));
    }

    // Menampilkan detail galeri
    public function detailGaleri($id)
    {
        // Mengambil profil sekolah
        $profil = ProfileSekolah::first();

        // Mengambil data galeri berdasarkan ID
        $galeri = Galeri::where('id_galeri', $id)->first();

        // Jika data tidak ditemukan, kembali ke bagian galeri
        if (!$galeri) {
            return redirect()->to(route('landing') . '#galeri')
                ->with('error', 'Data galeri tidak ditemukan.');
        }

        // Menampilkan halaman detail galeri
        return view('landing.galeri-detail', compact(
            'profil',
            'galeri'
        ));
    }
}