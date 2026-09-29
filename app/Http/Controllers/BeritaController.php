<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    // Menampilkan daftar berita
    public function index()
    {
        $berita = Berita::latest()->get();

        $title = 'Berita';

        return view('berita.berita', compact('berita', 'title'));
    }

    // Menampilkan form tambah berita
    public function create()
    {
        $berita = new Berita();

        $title = 'Tambah Berita';

        return view('berita.add-edit', compact('berita', 'title'));
    }

    // Menyimpan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'judul',
            'isi',
            'tanggal',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('berita', 'public');
        }

        // Mengambil ID user yang sedang login
        $data['id_user'] = Auth::id();

        Berita::create($data);

        return redirect()->route('admin.berita')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    // Menampilkan detail berita
    public function show(Berita $berita)
    {
        return view('berita.show', compact('berita'));
    }

    // Menampilkan form edit berita
    public function edit(Berita $berita)
    {
        $title = 'Edit Berita';

        return view('berita.add-edit', compact('berita', 'title'));
    }

    // Memperbarui berita
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'judul',
            'isi',
            'tanggal',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    // Menghapus berita
    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita')
            ->with('success', 'Berita berhasil dihapus.');
    }
}