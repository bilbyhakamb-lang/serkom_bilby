<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfileSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;

class BeritaController extends Controller
{
    // Menampilkan semua berita di halaman admin
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

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('berita', 'public');
        }

        $data['id_user'] = Auth::id();

        Berita::create($data);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    // Menampilkan detail berita dari halaman admin
    public function show($id)
    {
        try {
            $idBerita = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.berita')
                ->with('error', 'Link berita tidak valid.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.berita')
                ->with('error', 'Link berita tidak valid.');
        }

        $berita = Berita::find($idBerita);

        if (!$berita) {
            return redirect()
                ->route('admin.berita')
                ->with('error', 'Berita tidak ditemukan.');
        }

        $title = 'Detail Berita';

        return view('berita.detail', compact('berita', 'title'));
    }

    // Menampilkan detail berita untuk pengunjung landing
    public function landingDetail($id)
    {
        try {
            $idBerita = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return redirect()
                ->route('landing')
                ->with('error', 'Link berita tidak valid.');
        } catch (\Exception $e) {
            return redirect()
                ->route('landing')
                ->with('error', 'Link berita tidak valid.');
        }

        $berita = Berita::find($idBerita);

        if (!$berita) {
            return redirect()
                ->route('landing')
                ->with('error', 'Berita tidak ditemukan.');
        }

        // Mengambil profil sekolah untuk navbar dan footer landing
        $profil = ProfileSekolah::first();

        $title = 'Detail Berita';

        return view('landing.berita-detail', compact(
            'berita',
            'title',
            'profil'
        ));
    }

    // Mempertahankan method detail untuk route lama
    public function detail($id)
    {
        return $this->show($id);
    }

    // Menampilkan form edit berita
    public function edit(Berita $berita)
    {
        $title = 'Edit Berita';

        return view('berita.add-edit', compact('berita', 'title'));
    }

    // Memperbarui data berita
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

        if ($request->hasFile('gambar')) {
            if (
                $berita->gambar &&
                Storage::disk('public')->exists($berita->gambar)
            ) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    // Menghapus berita beserta gambar yang tersimpan
    public function destroy(Berita $berita)
    {
        if (
            $berita->gambar &&
            Storage::disk('public')->exists($berita->gambar)
        ) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita')
            ->with('success', 'Berita berhasil dihapus.');
    }
}