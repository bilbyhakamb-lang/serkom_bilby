<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EkstrakulikulerController extends Controller
{
    // Menampilkan data ekstrakurikuler
    public function index()
    {
        $eskul = Ekstrakulikuler::all();

        return view('eskul.eskul', compact('eskul'));
    }

    // Menampilkan detail ekstrakurikuler
    public function show($id)
    {
        try {
            $idEskul = Crypt::decryptString($id);
        }   catch (DecryptException $e) {
            abort(404);
        }

        $eskul = Ekstrakulikuler::findOrFail($idEskul);
        $ekstrakurikuler = $eskul;
        $title = 'Detail Ekstrakurikuler';

        return view('eskul.detail', compact('eskul', 'ekstrakurikuler', 'title'));
    }

    // Form tambah ekstrakurikuler
    public function create()
    {
        $eskul = new Ekstrakulikuler();
        $title = 'Tambah Ekstrakurikuler';

        return view('eskul.add-edit', compact('eskul', 'title'));
    }

    // Menyimpan data ekstrakurikuler
    public function store(Request $request)
    {
        $request->validate([
            'nama_ekskul'    => 'required|string|max:40',
            'pembina'        => 'required|string|max:40',
            'jadwal_latihan' => 'required|string|max:40',
            'deskripsi'      => 'required|string',
            'gambar'         => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'nama_ekskul',
            'pembina',
            'jadwal_latihan',
            'deskripsi',
        ]);

        $data['gambar'] = $request->file('gambar')
            ->store('ekstrakurikuler', 'public');

        Ekstrakulikuler::create($data);

        return redirect()->route('admin.ekstrakulikuler')
            ->with('success', 'Data ekstrakurikuler berhasil ditambahkan.');
    }

    // Form edit ekstrakurikuler
    public function edit($id)
    {
        $eskul = Ekstrakulikuler::findOrFail($id);
        $title = 'Edit Ekstrakurikuler';

        return view('eskul.add-edit', compact('eskul', 'title'));
    }

    // Memperbarui data ekstrakurikuler
    public function update(Request $request, $id)
    {
        $eskul = Ekstrakulikuler::findOrFail($id);

        $request->validate([
            'nama_ekskul'    => 'required|string|max:40',
            'pembina'        => 'required|string|max:40',
            'jadwal_latihan' => 'required|string|max:40',
            'deskripsi'      => 'required|string',
            'gambar'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'nama_ekskul',
            'pembina',
            'jadwal_latihan',
            'deskripsi',
        ]);

        if ($request->hasFile('gambar')) {
            if ($eskul->gambar) {
                Storage::disk('public')->delete($eskul->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('ekstrakurikuler', 'public');
        }

        $eskul->update($data);

        return redirect()->route('admin.ekstrakulikuler')
            ->with('success', 'Data ekstrakurikuler berhasil diperbarui.');
    }

    // Menghapus data ekstrakurikuler
    public function destroy($id)
    {
        $eskul = Ekstrakulikuler::findOrFail($id);

        if ($eskul->gambar) {
            Storage::disk('public')->delete($eskul->gambar);
        }

        $eskul->delete();

        return redirect()->route('admin.ekstrakulikuler')
            ->with('success', 'Data ekstrakurikuler berhasil dihapus.');
    }
}