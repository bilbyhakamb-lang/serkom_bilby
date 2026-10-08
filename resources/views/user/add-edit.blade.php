@extends('admin_app')

<link rel="icon" type="image/png" href="{{ asset('assets/images/logo sekolah.jpg') }}">

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            {{ $title }}
        </h4>

        <p class="text-muted mb-0">
            {{ isset($user->id_user) ? 'Edit data user' : 'Tambahkan user baru' }}
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form
                action="{{ isset($user->id_user)
                    ? route('user.update', \Illuminate\Support\Facades\Crypt::encryptString((string) $user->id_user))
                    : route('user.store') }}"
                method="POST"
            >
                @csrf

                @if(isset($user->id_user))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="username" class="form-label">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        id="username"
                        class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username', $user->username) }}"
                        maxlength="30"
                        required
                    >

                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        maxlength="100"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        maxlength="100"
                        required
                    >

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        {{ isset($user->id_user) ? '' : 'required' }}
                    >

                    @if(isset($user->id_user))
                        <small class="text-muted">
                            Kosongkan jika password tidak ingin diubah.
                        </small>
                    @endif

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">
                        Role
                    </label>

                    <select
                        name="role"
                        id="role"
                        class="form-select @error('role') is-invalid @enderror"
                        required
                    >
                        <option value="">-- Pilih Role --</option>

                        <option
                            value="Admin"
                            {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}
                        >
                            Admin
                        </option>

                        <option
                            value="Operator"
                            {{ old('role', $user->role) == 'Operator' ? 'selected' : '' }}
                        >
                            Operator
                        </option>
                    </select>

                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <a
                        href="{{ route('admin.user') }}"
                        class="btn btn-secondary"
                    >
                        <i class="bi bi-arrow-left me-2"></i>
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        <i class="bi bi-save me-2"></i>
                        {{ isset($user->id_user) ? 'Simpan Perubahan' : 'Simpan User' }}
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection