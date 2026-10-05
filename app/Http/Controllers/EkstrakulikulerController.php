<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EkstrakulikulerController extends Controller
{
    // =====================================================
    // MENAMPILKAN DATA EKSTRAKURIKULER
    // =====================================================
    public function index()
    {
        $eskul = Ekstrakulikuler::all();

        return view('eskul.eskul', compact('eskul'));
    }


    // =====================================================
    // MENAMPILKAN DETAIL EKSTRAKURIKULER
    // ID MENGGUNAKAN ENKRIPSI
    // =====================================================
    public function show($id = null)
    {
        // Jika ID kosong
        if (empty($id)) {
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }

        try {
            // Dekripsi ID
            $idEskul = Crypt::decryptString($id);

        } catch (DecryptException $e) {

            // Jika ID enkripsi rusak / tidak valid
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');

        } catch (\Exception $e) {

            // Jika terjadi error lainnya
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }


        // Cari data berdasarkan ID hasil dekripsi
        $eskul = Ekstrakulikuler::find($idEskul);


        // Jika data tidak ditemukan
        if (!$eskul) {
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }


        $ekstrakurikuler = $eskul;

        $title = 'Detail Ekstrakurikuler';


        return view('eskul.detail', compact(
            'eskul',
            'ekstrakurikuler',
            'title'
        ));
    }


    // =====================================================
    // FORM TAMBAH EKSTRAKURIKULER
    // =====================================================
    public function create()
    {
        $eskul = new Ekstrakulikuler();

        $title = 'Tambah Ekstrakurikuler';

        return view('eskul.add-edit', compact(
            'eskul',
            'title'
        ));
    }


    // =====================================================
    // MENYIMPAN DATA EKSTRAKURIKULER
    // =====================================================
    public function store(Request $request)
    {
        $request->validate([
            'nama_ekskul' => 'required|string|max:40',
            'pembina' => 'required|string|max:40',
            'jadwal_latihan' => 'required|string|max:40',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_ekskul.required' => 'Nama ekstrakurikuler wajib diisi.',
            'nama_ekskul.max' => 'Nama ekstrakurikuler maksimal 40 karakter.',

            'pembina.required' => 'Pembina wajib diisi.',
            'pembina.max' => 'Pembina maksimal 40 karakter.',

            'jadwal_latihan.required' => 'Jadwal latihan wajib diisi.',
            'jadwal_latihan.max' => 'Jadwal latihan maksimal 40 karakter.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',

            'gambar.required' => 'Gambar ekstrakurikuler wajib dipilih.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);


        // Data teks
        $data = $request->only([
            'nama_ekskul',
            'pembina',
            'jadwal_latihan',
            'deskripsi',
        ]);


        // Upload gambar
        if ($request->hasFile('gambar')) {

            $data['gambar'] = $request->file('gambar')
                ->store('ekstrakurikuler', 'public');
        }


        // Simpan data
        Ekstrakulikuler::create($data);


        return redirect()
            ->route('admin.ekstrakulikuler')
            ->with(
                'success',
                'Data ekstrakurikuler berhasil ditambahkan.'
            );
    }


    // =====================================================
    // FORM EDIT EKSTRAKURIKULER
    // =====================================================
    public function edit($id)
    {
        $eskul = Ekstrakulikuler::find($id);


        // Jika data tidak ditemukan
        if (!$eskul) {
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with(
                    'error',
                    'Data ekstrakurikuler tidak ditemukan.'
                );
        }


        $title = 'Edit Ekstrakurikuler';


        return view('eskul.add-edit', compact(
            'eskul',
            'title'
        ));
    }


    // =====================================================
    // MEMPERBARUI DATA EKSTRAKURIKULER
    // =====================================================
    public function update(Request $request, $id)
    {
        $eskul = Ekstrakulikuler::find($id);


        // Jika data tidak ditemukan
        if (!$eskul) {
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with(
                    'error',
                    'Data ekstrakurikuler tidak ditemukan.'
                );
        }


        // Validasi
        $request->validate([
            'nama_ekskul' => 'required|string|max:40',
            'pembina' => 'required|string|max:40',
            'jadwal_latihan' => 'required|string|max:40',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_ekskul.required' => 'Nama ekstrakurikuler wajib diisi.',
            'nama_ekskul.max' => 'Nama ekstrakurikuler maksimal 40 karakter.',

            'pembina.required' => 'Pembina wajib diisi.',
            'pembina.max' => 'Pembina maksimal 40 karakter.',

            'jadwal_latihan.required' => 'Jadwal latihan wajib diisi.',
            'jadwal_latihan.max' => 'Jadwal latihan maksimal 40 karakter.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',

            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);


        // Data yang diperbarui
        $data = $request->only([
            'nama_ekskul',
            'pembina',
            'jadwal_latihan',
            'deskripsi',
        ]);


        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if (
                $eskul->gambar &&
                Storage::disk('public')->exists($eskul->gambar)
            ) {
                Storage::disk('public')->delete($eskul->gambar);
            }


            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')
                ->store('ekstrakurikuler', 'public');
        }


        // Update database
        $eskul->update($data);


        return redirect()
            ->route('admin.ekstrakulikuler')
            ->with(
                'success',
                'Data ekstrakurikuler berhasil diperbarui.'
            );
    }


    // =====================================================
    // MENGHAPUS DATA EKSTRAKURIKULER
    // =====================================================
    public function destroy($id)
    {
        $eskul = Ekstrakulikuler::find($id);


        // Jika data tidak ditemukan
        if (!$eskul) {
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with(
                    'error',
                    'Data ekstrakurikuler tidak ditemukan.'
                );
        }


        // Hapus gambar
        if (
            $eskul->gambar &&
            Storage::disk('public')->exists($eskul->gambar)
        ) {
            Storage::disk('public')->delete($eskul->gambar);
        }


        // Hapus data
        $eskul->delete();


        return redirect()
            ->route('admin.ekstrakulikuler')
            ->with(
                'success',
                'Data ekstrakurikuler berhasil dihapus.'
            );
    }
}