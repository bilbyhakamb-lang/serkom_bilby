<?php

namespace App\Http\Controllers;

use App\Models\ProfileSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileSekolahController extends Controller
{
    // Menampilkan profil sekolah
    public function index()
    {
        $profilSekolah = ProfileSekolah::first();

        return view('profile.profile', [
            'title' => 'Profile Sekolah',
            'profilSekolah' => $profilSekolah,
        ]);
    }

    // Menampilkan form edit profil
    public function edit()
    {
        $profilSekolah = ProfileSekolah::first();

        if (!$profilSekolah) {
            $profilSekolah = new ProfileSekolah();
        }

        return view('profile.edit-profil', [
            'title' => 'Edit Profile Sekolah',
            'profilSekolah' => $profilSekolah,
        ]);
    }

    // Menyimpan / memperbarui profil
    public function save(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_sekolah' => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'npsn' => 'required|string|max:10',
            'alamat' => 'required',
            'kontak' => 'required|string|max:15',
            'visi_misi' => 'required',
            'tahun_berdiri' => 'required|integer',
            'deskripsi' => 'required',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Ambil data profil
        $profilSekolah = ProfileSekolah::first();

        // Jika belum ada, buat data baru
        if (!$profilSekolah) {
            $profilSekolah = new ProfileSekolah();
        }

        // Simpan data teks
        $profilSekolah->nama_sekolah = $request->nama_sekolah;
        $profilSekolah->kepala_sekolah = $request->kepala_sekolah;
        $profilSekolah->npsn = $request->npsn;
        $profilSekolah->alamat = $request->alamat;
        $profilSekolah->kontak = $request->kontak;
        $profilSekolah->visi_misi = $request->visi_misi;
        $profilSekolah->tahun_berdiri = $request->tahun_berdiri;
        $profilSekolah->deskripsi = $request->deskripsi;

        // =========================
        // UPLOAD LOGO
        // =========================
        if ($request->hasFile('logo')) {

            // Hapus logo lama
            if (
                $profilSekolah->logo &&
                Storage::disk('public')->exists($profilSekolah->logo)
            ) {
                Storage::disk('public')->delete($profilSekolah->logo);
            }

            // Simpan logo baru
            $profilSekolah->logo = $request->file('logo')
                ->store('profil-sekolah', 'public');
        }

        // =========================
        // UPLOAD FOTO
        // =========================
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if (
                $profilSekolah->foto &&
                Storage::disk('public')->exists($profilSekolah->foto)
            ) {
                Storage::disk('public')->delete($profilSekolah->foto);
            }

            // Simpan foto baru
            $profilSekolah->foto = $request->file('foto')
                ->store('profil-sekolah', 'public');
        }

        // Simpan ke database
        $profilSekolah->save();

        return redirect()
            ->route('admin.profile')
            ->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}