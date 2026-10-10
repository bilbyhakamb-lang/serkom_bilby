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

    // Menampilkan detail guru
    public function show($id)
    {
        $id = $this->decryptId($id);

        // Jika ID tidak valid
        if (!$id) {
            return redirect()->route('admin.guru');
        }

        // Cari guru
        $guru = Guru::find($id);

        // Jika data tidak ditemukan
        if (!$guru) {
            return redirect()->route('admin.guru');
        }

        $title = 'Detail Guru';

        return view('guru.detail', compact('guru', 'title'));
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
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $data = $request->only([
            'nama_guru',
            'nip',
            'mapel',
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('guru', 'public');
        }

        Guru::create($data);

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    // Mendekripsi ID guru
    private function decryptId($id)
    {
        try {
            return Crypt::decryptString($id);

        } catch (DecryptException $e) {
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    // Menampilkan form edit guru
    public function edit($id)
    {
        $id = $this->decryptId($id);

        // Jika ID tidak valid
        if (!$id) {
            return redirect()->route('admin.guru');
        }

        // Cari guru
        $guru = Guru::find($id);

        // Jika guru tidak ditemukan
        if (!$guru) {
            return redirect()->route('admin.guru');
        }

        $title = 'Edit Guru';

        return view('guru.add-edit', compact('guru', 'title'));
    }

    // Memperbarui data guru
    public function update(Request $request, $id)
    {
        $id = $this->decryptId($id);

        // Jika ID tidak valid
        if (!$id) {
            return redirect()->route('admin.guru');
        }

        // Cari guru
        $guru = Guru::find($id);

        // Jika guru tidak ditemukan
        if (!$guru) {
            return redirect()->route('admin.guru');
        }

        $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip' => 'required|string|max:15',
            'mapel' => 'required|string|max:40',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hapus_foto' => 'nullable|boolean',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $data = $request->only([
            'nama_guru',
            'nip',
            'mapel',
        ]);

        // Jika memilih foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')
                ->store('guru', 'public');
        }

        // Jika memilih hapus foto
        elseif ($request->boolean('hapus_foto')) {

            // Hapus foto lama
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }

            $data['foto'] = null;
        }

        // Update data
        $guru->update($data);

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil diubah.');
    }

    // Menghapus data guru
    public function destroy($id)
    {
        $id = $this->decryptId($id);

        // Jika ID tidak valid
        if (!$id) {
            return redirect()->route('admin.guru');
        }

        // Cari guru
        $guru = Guru::find($id);

        // Jika guru tidak ditemukan
        if (!$guru) {
            return redirect()->route('admin.guru');
        }

        // Hapus foto
        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        // Hapus data
        $guru->delete();

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil dihapus.');
    }

    public function detail($slug)
    {
        $guru = Guru::where('slug', $slug)->firstOrFail();
        $profil = \App\Models\ProfileSekolah::first();

        return view('landing.guru-detail', compact('guru', 'profil'));
    }
    
}