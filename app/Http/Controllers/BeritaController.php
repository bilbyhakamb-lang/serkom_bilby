<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class BeritaController extends Controller
{
    // =====================================================
    // MENAMPILKAN DAFTAR BERITA
    // =====================================================
    public function index()
    {
        $berita = Berita::latest()->get();
        $title = 'Berita';

        return view('berita.berita', compact('berita', 'title'));
    }


    // =====================================================
    // MENAMPILKAN FORM TAMBAH BERITA
    // =====================================================
    public function create()
    {
        $berita = new Berita();
        $title = 'Tambah Berita';

        return view('berita.add-edit', compact('berita', 'title'));
    }


    // =====================================================
    // MENYIMPAN BERITA BARU
    // =====================================================
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.max' => 'Judul berita maksimal 50 karakter.',
            'isi.required' => 'Isi berita wajib diisi.',
            'tanggal.required' => 'Tanggal berita wajib diisi.',
            'tanggal.date' => 'Tanggal berita tidak valid.',
            'gambar.required' => 'Gambar berita wajib dipilih.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $data = $request->only([
            'judul',
            'isi',
            'tanggal',
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('berita', 'public');
        }

        // Menyimpan user yang membuat berita
        $data['id_user'] = Auth::id();

        Berita::create($data);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil ditambahkan.');
    }


    // =====================================================
    // DETAIL BERITA
    // ID TERENKRIPSI
    // =====================================================
    public function show($id)
    {
        try {
            // Dekripsi ID
            $idBerita = Crypt::decryptString($id);

        } catch (DecryptException $e) {

            // Jika enkripsi rusak / tidak valid
            return redirect()
                ->route('admin.berita')
                ->with('error', 'Link berita tidak valid.');

        } catch (\Exception $e) {

            // Jika terjadi error lain
            return redirect()
                ->route('admin.berita')
                ->with('error', 'Link berita tidak valid.');
        }

        // Cari berita
        $berita = Berita::find($idBerita);

        // Jika berita tidak ditemukan
        if (!$berita) {
            return redirect()
                ->route('admin.berita')
                ->with('error', 'Berita tidak ditemukan.');
        }

        $title = 'Detail Berita';

        return view('berita.detail', compact('berita', 'title'));
    }


    // =====================================================
    // DETAIL BERITA
    // METHOD LAMA
    // =====================================================
    public function detail($id)
    {
        // Gunakan method show agar logika tidak dibuat dua kali
        return $this->show($id);
    }


    // =====================================================
    // MENAMPILKAN FORM EDIT BERITA
    // =====================================================
    public function edit(Berita $berita)
    {
        $title = 'Edit Berita';

        return view('berita.add-edit', compact('berita', 'title'));
    }


    // =====================================================
    // MEMPERBARUI BERITA
    // =====================================================
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.max' => 'Judul berita maksimal 50 karakter.',
            'isi.required' => 'Isi berita wajib diisi.',
            'tanggal.required' => 'Tanggal berita wajib diisi.',
            'tanggal.date' => 'Tanggal berita tidak valid.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $data = $request->only([
            'judul',
            'isi',
            'tanggal',
        ]);

        // Jika memilih gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if (
                $berita->gambar &&
                Storage::disk('public')->exists($berita->gambar)
            ) {
                Storage::disk('public')->delete($berita->gambar);
            }

            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')
                ->store('berita', 'public');
        }

        // Update data berita
        $berita->update($data);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil diperbarui.');
    }


    // =====================================================
    // MENGHAPUS BERITA
    // =====================================================
    public function destroy(Berita $berita)
    {
        // Hapus gambar dari storage
        if (
            $berita->gambar &&
            Storage::disk('public')->exists($berita->gambar)
        ) {
            Storage::disk('public')->delete($berita->gambar);
        }

        // Hapus data berita
        $berita->delete();

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil dihapus.');
    }
}