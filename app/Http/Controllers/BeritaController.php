<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;

class BeritaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MENAMPILKAN DATA BERITA ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $berita = Berita::latest()->get();
        $title = 'Berita';

        return view('berita.berita.', compact('berita', 'title'));
    }


    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH BERITA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $berita = new Berita();
        $title = 'Tambah Berita';

        return view('berita.add-edit', compact('berita', 'title'));
    }


    /*
    |--------------------------------------------------------------------------
    | MENYIMPAN BERITA
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | DETAIL BERITA ADMIN
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | DETAIL BERITA LANDING / PUBLIC
    |--------------------------------------------------------------------------
    */

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

        $title = 'Detail Berita';

        return view('landing.berita.detail', compact('berita', 'title'));
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL BERITA LAMA
    |--------------------------------------------------------------------------
    */

    public function detail($id)
    {
        return $this->show($id);
    }


    /*
    |--------------------------------------------------------------------------
    | FORM EDIT BERITA
    |--------------------------------------------------------------------------
    */

    public function edit(Berita $berita)
    {
        $title = 'Edit Berita';

        return view('berita.add-edit', compact('berita', 'title'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE BERITA
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | HAPUS BERITA
    |--------------------------------------------------------------------------
    */

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