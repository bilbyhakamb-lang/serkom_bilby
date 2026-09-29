<?php

namespace App\Http\Controllers;

use App\Models\ProfileSekolah;
use Illuminate\Http\Request;

class ProfileSekolahController extends Controller
{
    public function index()
    {
        $profilSekolah = ProfileSekolah::first();

        $data = [
            'title' => 'Profile Sekolah',
            'profilSekolah' => $profilSekolah
        ];

        return view('profile.profile', $data);
    }

    public function save(Request $request)
{
    $request->validate([
        'nama_sekolah' => 'required|string|max:40',
        'kepala_sekolah' => 'required|string|max:40',
        'npsn' => 'required|string|max:10',
        'alamat' => 'required',
        'kontak' => 'required|string|max:15',
        'visi_misi' => 'required',
        'tahun_berdiri' => 'required|integer',
        'deskripsi' => 'required',
    ]);

    $profilSekolah = ProfileSekolah::first();

    if (!$profilSekolah) {
        $profilSekolah = new ProfileSekolah();
    }

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

    $profilSekolah->save();

    return redirect('/profile')->with('success', 'Profil sekolah berhasil diperbarui!');
}
}