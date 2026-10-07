@extends('admin_app')

<link rel="icon" type="image/png" href="{{ asset('assets/images/logo sekolah.jpg') }}">

@section('title', $title)

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm w-100" style="border-radius: 12px;">

        <!-- HEADER -->
        <div class="card-header bg-white p-4">
            <h4 class="mb-0">{{ $title }}</h4>
        </div>

        <!-- FORM -->
        <div class="card-body p-4">

            <!-- PESAN ERROR -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ $siswa
                ? route('siswa.update', encrypt($siswa->id_siswa))
                : route('siswa.store') }}"
                method="POST">

                @csrf

                @if ($siswa)
                    @method('PUT')
                @endif

                <!-- NISN -->
                <div class="mb-3">
                    <label class="form-label">NISN</label>
                    <input type="text" name="nisn"
                        class="form-control"
                        maxlength="10"
                        value="{{ old('nisn', $siswa->nisn ?? '') }}"
                        required>
                </div>

                <!-- NAMA SISWA -->
                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" name="nama_siswa"
                        class="form-control"
                        maxlength="40"
                        value="{{ old('nama_siswa', $siswa->nama_siswa ?? '') }}"
                        required>
                </div>

                <!-- JENIS KELAMIN -->
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-Laki"
                            {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Laki-Laki' ? 'selected' : '' }}>
                            Laki-Laki
                        </option>
                        <option value="Perempuan"
                            {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                <!-- TAHUN MASUK -->
                <div class="mb-4">
                    <label class="form-label">Tahun Masuk</label>
                    <input type="number" name="tahun_masuk"
                        class="form-control"
                        value="{{ old('tahun_masuk', $siswa->tahun_masuk ?? '') }}"
                        required>
                </div>

                <!-- TOMBOL -->
                <button type="submit" class="btn btn-success">
                    {{ $siswa ? 'Simpan Perubahan' : 'Tambah Siswa' }}
                </button>

                <a href="{{ route('admin.siswa') }}"
                    class="btn btn-secondary">
                    Kembali
                </a>

            </form>
        </div>
    </div>
</div>
@endsection