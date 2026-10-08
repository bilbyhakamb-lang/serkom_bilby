<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();

        return view('user.user', compact('user'));
    }

    public function create()
    {
        $user = new User();
        $title = 'Tambah User';

        return view('user.add-edit', compact('user', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:30|unique:users,username',
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|min:6|max:100',
            'role' => 'required|in:Admin,Operator',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()
            ->route('admin.user')
            ->with('success', 'Data user berhasil ditambahkan.');
    }

    public function edit($id)
    {
        try {
            $idUser = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.user')
                ->with('error', 'Data user tidak valid.');
        }

        $user = User::find($idUser);

        if (!$user) {
            return redirect()
                ->route('admin.user')
                ->with('error', 'Data user tidak ditemukan.');
        }

        $title = 'Edit User';

        return view('user.add-edit', compact('user', 'title'));
    }

    public function update(Request $request, $id)
    {
        try {
            $idUser = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.user')
                ->with('error', 'Data user tidak valid.');
        }

        $user = User::find($idUser);

        if (!$user) {
            return redirect()
                ->route('admin.user')
                ->with('error', 'Data user tidak ditemukan.');
        }

        $request->validate([
            'username' => 'required|max:30|unique:users,username,' . $idUser . ',id_user',
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $idUser . ',id_user',
            'role' => 'required|in:Admin,Operator',
        ]);

        $data = [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6|max:100',
            ]);

            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.user')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $idUser = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return redirect()
                ->route('admin.user')
                ->with('error', 'Data user tidak valid.');
        }

        $user = User::find($idUser);

        if (!$user) {
            return redirect()
                ->route('admin.user')
                ->with('error', 'Data user tidak ditemukan.');
        }

        $user->delete();

        return redirect()
            ->route('admin.user')
            ->with('success', 'Data user berhasil dihapus.');
    }
}