<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class GuruController extends Controller
{
    // Menampilkan data guru
    public function index()
    {
        $guru = Guru::all();

        return view('guru.guru', compact('guru'));
    }

    // Menampilkan form tambah guru
    public function create()
    {
        $guru = new Guru();
        $title = 'Tambah Guru';

        return view('guru.add-edit', compact('guru', 'title'));
    }

    // Menyimpan data guru
    public function store(Request $request)
{
        $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip' => 'required|string|max:15',
            'mapel' => 'required|string|max:40',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'foto.required' => 'Foto guru wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $data = $request->only([
            'nama_guru',
            'nip',
            'mapel',
        ]);

    $data['foto'] = $request->file('foto')
        ->store('guru', 'public');

    Guru::create($data);

    return redirect()->route('admin.guru')
        ->with('success', 'Data guru berhasil ditambahkan.');
}

    // Mendekripsi ID guru
    private function decryptId($id)
    {
        try {
            return Crypt::decryptString($id);
        } catch (DecryptException $e) {
            abort(404, 'ID guru tidak valid.');
        }
    }

    // Menampilkan form edit guru
    public function edit($id)
    {
        $id = $this->decryptId($id);

        $guru = Guru::findOrFail($id);
        $title = 'Edit Guru';

        return view('guru.add-edit', compact('guru', 'title'));
    }

    // Memperbarui data guru
    public function update(Request $request, $id)
    {
        $id = $this->decryptId($id);
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip' => 'required|string|max:15',
            'mapel' => 'required|string|max:40',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hapus_foto' => 'nullable|boolean',
    ]);

        $data = $request->only([
            'nama_guru',
            'nip',
            'mapel',
    ]);

    // Jika memilih foto baru
    if ($request->hasFile('foto')) {
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }

        $data['foto'] = $request->file('foto')
            ->store('guru', 'public');
    }
    // Jika ingin menghapus foto lama
        elseif ($request->boolean('hapus_foto')) {
            if ($guru->foto) {
             Storage::disk('public')->delete($guru->foto);
        }

        $data['foto'] = null;
    }

    $guru->update($data);

    return redirect()->route('admin.guru')
        ->with('success', 'Data guru berhasil diubah.');
    }

    // Menghapus data guru
    public function destroy($id)
    {
        $id = $this->decryptId($id);
        $guru = Guru::findOrFail($id);

        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('admin.guru')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}