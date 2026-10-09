<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class GaleriController extends Controller
{
    
    public function index()
    {
        $galeri = Galeri::latest()->get();

        return view('galeri.galeri', compact('galeri'));
    }

    
    public function create()
    {
        $galeri = new Galeri();
        $title = 'Tambah Galeri';

        return view('galeri.add-edit', compact('galeri', 'title'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:50',
            'keterangan' => 'required|string',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
            'file' => 'required|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
        ]);

        $file = $request->file('file');
        $ext = strtolower($file->getClientOriginalExtension());

        if (!$this->fileSesuaiKategori($ext, $request->kategori)) {
            return back()->withErrors([
                'file' => 'Format file tidak sesuai dengan kategori.'
            ])->withInput();
        }

        $data = $request->only([
            'judul',
            'keterangan',
            'kategori',
            'tanggal',
        ]);

        $data['file'] = $file->store('galeri', 'public');

        Galeri::create($data);

        return redirect()->route('admin.galeri')
            ->with('success', 'Data galeri berhasil ditambahkan.');
    }

    
    private function fileSesuaiKategori($ext, $kategori)
    {
        $formatFoto = ['jpg', 'jpeg', 'png', 'webp'];
        $formatVideo = ['mp4', 'mov', 'avi'];

        if ($kategori === 'Foto') {
            return in_array($ext, $formatFoto);
        }

        if ($kategori === 'Video') {
            return in_array($ext, $formatVideo);
        }

        return false;
    }

    
    private function decryptId($id)
    {
        try {
            return Crypt::decryptString($id);
        }   catch (DecryptException $e) {
            abort(404, 'ID ekstrakurikuler tidak valid.');
        }
    }

   
    public function edit($id)
    {
        $id = $this->decryptId($id);

        $galeri = Galeri::findOrFail($id);
        $title = 'Edit Galeri';

        return view('galeri.add-edit', compact('galeri', 'title'));
    }

    // Memperbarui data galeri
    public function update(Request $request, $id)
    {
        $id = $this->decryptId($id);

        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:50',
            'keterangan' => 'required|string',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
        ]);

        $data = $request->only([
            'judul',
            'keterangan',
            'kategori',
            'tanggal',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = strtolower($file->getClientOriginalExtension());

            if (!$this->fileSesuaiKategori($ext, $request->kategori)) {
                return back()->withErrors([
                    'file' => 'Format file tidak sesuai dengan kategori.'
                ])->withInput();
            }

            if ($galeri->file) {
                Storage::disk('public')->delete($galeri->file);
            }

            $data['file'] = $file->store('galeri', 'public');
        } else {
            // Pastikan kategori tetap sesuai dengan file lama
            $extLama = strtolower(pathinfo($galeri->file, PATHINFO_EXTENSION));

            if (!$this->fileSesuaiKategori($extLama, $request->kategori)) {
                return back()->withErrors([
                    'file' => 'Silakan unggah file baru sesuai kategori yang dipilih.'
                ])->withInput();
            }
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri')
            ->with('success', 'Data galeri berhasil diperbarui.');
    }

    public function show($id)
    {
        try {
            $idGaleri = Crypt::decryptString($id);
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.galeri')
                ->with('error', 'Link galeri tidak valid atau data sudah dihapus.');
        }

        $galeri = Galeri::find($idGaleri);

        if (!$galeri) {
            return redirect()
                ->route('admin.galeri')
                ->with('error', 'Data galeri tidak ditemukan atau sudah dihapus.');
        }

        $title = 'Detail Galeri';

        return view('galeri.detail', compact('galeri', 'title'));
    }

    // Menghapus data galeri
    public function destroy($id)
    {
        $id = $this->decryptId($id);

        $galeri = Galeri::findOrFail($id);

        if ($galeri->file) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri')
            ->with('success', 'Data galeri berhasil dihapus.');
    }
}