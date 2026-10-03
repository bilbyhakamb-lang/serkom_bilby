<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    // Menampilkan data siswa
    public function index()
    {
        $siswa = Siswa::all();

        return view('siswa.index', [
            'title' => 'Kelola Data Siswa',
            'siswa' => $siswa
        ]);
    }

    // Menampilkan detail siswa
    public function show($id)
    {
        try {
            $idSiswa = Crypt::decrypt($id);
            $siswa = Siswa::findOrFail($idSiswa);
        } catch (\Exception $e) {
            return redirect()->route('admin.siswa')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('siswa.detail', [
            'title' => 'Detail Data Siswa',
            'siswa' => $siswa
        ]);
    }

    // Menambahkan data siswa
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|max:10',
            'nama_siswa' => 'required|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk' => 'required|integer',
        ]);

        Siswa::create([
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_masuk' => $request->tahun_masuk,
        ]);

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // Form tambah dan edit
    public function addEdit($id = null)
    {
        $siswa = null;

        if ($id !== null) {
            try {
                $idSiswa = Crypt::decrypt($id);
                $siswa = Siswa::findOrFail($idSiswa);
            } catch (\Exception $e) {
                return redirect()->route('admin.siswa')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }
        }

        return view('siswa.add-edit', [
            'title' => $id ? 'Edit Data Siswa' : 'Tambah Data Siswa',
            'siswa' => $siswa
        ]);
    }

    // Memperbarui data siswa
    public function update(Request $request, $id)
    {
        try {
            $idSiswa = Crypt::decrypt($id);
            $siswa = Siswa::findOrFail($idSiswa);
        } catch (\Exception $e) {
            return redirect()->route('admin.siswa')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        $request->validate([
            'nisn' => 'required|max:10',
            'nama_siswa' => 'required|max:40',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tahun_masuk' => 'required|integer',
        ]);

        $siswa->update([
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_masuk' => $request->tahun_masuk,
        ]);

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    // Menghapus data siswa
    public function destroy($id)
    {
        try {
            $idSiswa = Crypt::decrypt($id);
            $siswa = Siswa::findOrFail($idSiswa);
        } catch (\Exception $e) {
            return redirect()->route('admin.siswa')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        $siswa->delete();

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}