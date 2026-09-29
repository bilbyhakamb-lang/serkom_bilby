<?php

namespace App\Http\Controllers;

use App\Models\ProfileSekolah;
use Illuminate\Http\Request;

class ProfileSekolahController extends Controller
{
    // Menampilkan profil sekolah
    public function index()
    {
        $profilSekolah = ProfileSekolah::first();

        $data = [
            'title' => 'Profile Sekolah',
            'profilSekolah' => $profilSekolah,
        ];

        return view('profile.profile', $data);
    }

    // Menyimpan dan memperbarui profil sekolah
    public function save(Request $request)
    {
        // Validasi data
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

        // Mengambil data profil sekolah
        $profilSekolah = ProfileSekolah::first();

        if (!$profilSekolah) {
            $profilSekolah = new ProfileSekolah();
        }

        // Mengisi data profil
        $profilSekolah->fill($request->only([
            'nama_sekolah',
            'kepala_sekolah',
            'npsn',
            'alamat',
            'kontak',
            'visi_misi',
            'tahun_berdiri',
            'deskripsi',
        ]));

        // Upload logo sekolah
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')
                ->store('profil-sekolah', 'public');

            $profilSekolah->logo = $logo;
        }

        // Upload foto sekolah
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')
                ->store('profil-sekolah', 'public');

            $profilSekolah->foto = $foto;
        }

        // Simpan ke database
        $profilSekolah->save();

        // Kembali ke halaman profil
        return redirect('/profile')
            ->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}