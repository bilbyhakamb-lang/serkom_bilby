<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EkstrakulikulerController extends Controller
{
   
    public function index()
    {
        $eskul = Ekstrakulikuler::all();

        return view('eskul.eskul', compact('eskul'));
    }


   
    public function show($id = null)
    {
        
        if (empty($id)) {
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }

        try {
            
            $idEskul = Crypt::decryptString($id);

        } catch (DecryptException $e) {

            
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');

        } catch (\Exception $e) {

            
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }


        
        $eskul = Ekstrakulikuler::find($idEskul);


        
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


    
    public function create()
    {
        $eskul = new Ekstrakulikuler();

        $title = 'Tambah Ekstrakurikuler';

        return view('eskul.add-edit', compact(
            'eskul',
            'title'
        ));
    }


    
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


        
        $data = $request->only([
            'nama_ekskul',
            'pembina',
            'jadwal_latihan',
            'deskripsi',
        ]);


        
        if ($request->hasFile('gambar')) {

            $data['gambar'] = $request->file('gambar')
                ->store('ekstrakurikuler', 'public');
        }


        
        Ekstrakulikuler::create($data);


        return redirect()
            ->route('admin.ekstrakulikuler')
            ->with(
                'success',
                'Data ekstrakurikuler berhasil ditambahkan.'
            );
    }


    
    public function edit($id)
    {
        $eskul = Ekstrakulikuler::find($id);


        
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


    
    public function update(Request $request, $id)
    {
        $eskul = Ekstrakulikuler::find($id);


       
        if (!$eskul) {
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with(
                    'error',
                    'Data ekstrakurikuler tidak ditemukan.'
                );
        }


        
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


        
        $data = $request->only([
            'nama_ekskul',
            'pembina',
            'jadwal_latihan',
            'deskripsi',
        ]);


        
        if ($request->hasFile('gambar')) {

            
            if (
                $eskul->gambar &&
                Storage::disk('public')->exists($eskul->gambar)
            ) {
                Storage::disk('public')->delete($eskul->gambar);
            }


            
            $data['gambar'] = $request->file('gambar')
                ->store('ekstrakurikuler', 'public');
        }


        
        $eskul->update($data);


        return redirect()
            ->route('admin.ekstrakulikuler')
            ->with(
                'success',
                'Data ekstrakurikuler berhasil diperbarui.'
            );
    }


    
    public function destroy($id)
    {
        $eskul = Ekstrakulikuler::find($id);


        
        if (!$eskul) {
            return redirect()
                ->route('admin.ekstrakulikuler')
                ->with(
                    'error',
                    'Data ekstrakurikuler tidak ditemukan.'
                );
        }


       
        if (
            $eskul->gambar &&
            Storage::disk('public')->exists($eskul->gambar)
        ) {
            Storage::disk('public')->delete($eskul->gambar);
        }


        
        $eskul->delete();


        return redirect()
            ->route('admin.ekstrakulikuler')
            ->with(
                'success',
                'Data ekstrakurikuler berhasil dihapus.'
            );
    }
}