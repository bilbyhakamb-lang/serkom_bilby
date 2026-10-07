@extends('admin_app')

<link rel="icon" type="image/png" href="{{ asset('assets/images/logo sekolah.jpg') }}">

@section('title', $title)

@section('content')
<div class="container-fluid py-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h4 class="mb-0">{{ $title }}</h4>
            <small class="text-muted">
                Isi informasi berita sekolah di bawah ini.
            </small>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ isset($berita->id_berita)
                    ? route('berita.update', $berita->id_berita)
                    : route('berita.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                @if(isset($berita->id_berita))
                    @method('PUT')
                @endif

                <!-- Judul Berita -->
                <div class="mb-3">
                    <label for="judul" class="form-label">
                        Judul Berita
                    </label>
                    <input
                        type="text"
                        name="judul"
                        id="judul"
                        class="form-control"
                        value="{{ old('judul', $berita->judul ?? '') }}"
                        maxlength="50"
                        placeholder="Masukkan judul berita"
                        required>
                </div>

                <!-- Isi Berita -->
                <div class="mb-3">
                    <label for="isi" class="form-label">
                        Isi Berita
                    </label>
                    <textarea
                        name="isi"
                        id="isi"
                        class="form-control"
                        rows="6"
                        placeholder="Masukkan isi berita"
                        required>{{ old('isi', $berita->isi ?? '') }}</textarea>
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label for="tanggal" class="form-label">
                        Tanggal Berita
                    </label>
                    <input
                        type="date"
                        name="tanggal"
                        id="tanggal"
                        class="form-control"
                        value="{{ old('tanggal', isset($berita->tanggal) ? \Illuminate\Support\Carbon::parse($berita->tanggal)->format('Y-m-d') : '') }}"
                        required>
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label for="gambar" class="form-label">
                        Gambar Berita
                    </label>
                    <input
                        type="file"
                        name="gambar"
                        id="gambar"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                        {{ isset($berita->id_berita) ? '' : 'required' }}>

                    <small class="text-muted">
                        Format JPG, JPEG, PNG, atau WEBP.
                    </small>
                </div>

                <!-- Gambar Saat Ini -->
                @if(!empty($berita->gambar))
                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label>
                        <div>
                            <img
                                src="{{ asset('storage/' . $berita->gambar) }}"
                                alt="Gambar berita"
                                style="width: 180px; height: 120px; object-fit: cover; border-radius: 8px;">
                        </div>
                    </div>
                @endif

                <!-- Tombol -->
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i>
                        {{ isset($berita->id_berita) ? 'Simpan Perubahan' : 'Tambah Berita' }}
                    </button>

                    <a href="{{ route('admin.berita') }}"
                       class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection