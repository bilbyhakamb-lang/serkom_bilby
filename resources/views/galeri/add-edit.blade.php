
@extends('admin_app')

@php
    use Illuminate\Support\Facades\Crypt;
@endphp

@section('title', $title)

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="galeri-header mb-4">
        <div>
            <h2>{{ $galeri->exists ? 'Edit Galeri' : 'Tambah Galeri' }}</h2>
            <p>Lengkapi informasi dokumentasi kegiatan sekolah.</p>
        </div>
        <i class="bi bi-images header-icon"></i>
    </div>

    <!-- FORM -->
    <div class="galeri-card">

        <div class="card-heading mb-4">
            <i class="bi bi-info-circle"></i>
            <h5 class="mb-0">Informasi Galeri</h5>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ $galeri->exists
                ? route('galeri.update', Crypt::encryptString((string) $galeri->id_galeri))
                : route('galeri.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @if($galeri->exists)
                @method('PUT')
            @endif

            <div class="row g-3">

                <!-- JUDUL -->
                <div class="col-md-6">
                    <label class="form-label">Judul Galeri</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul', $galeri->judul) }}"
                           placeholder="Masukkan judul galeri"
                           maxlength="50"
                           required>
                </div>

                <!-- KATEGORI -->
                <div class="col-md-6">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" id="kategori"
                            class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Foto"
                            {{ old('kategori', $galeri->kategori) == 'Foto' ? 'selected' : '' }}>
                            Foto
                        </option>
                        <option value="Video"
                            {{ old('kategori', $galeri->kategori) == 'Video' ? 'selected' : '' }}>
                            Video
                        </option>
                    </select>
                </div>

                <!-- KETERANGAN -->
                <div class="col-12">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="4"
                              placeholder="Masukkan keterangan galeri"
                              required>{{ old('keterangan', $galeri->keterangan) }}</textarea>
                </div>

                <!-- TANGGAL -->
                <div class="col-md-6">
                    <label class="form-label">Tanggal</label>
                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ old('tanggal', $galeri->tanggal ? \Carbon\Carbon::parse($galeri->tanggal)->format('Y-m-d') : '') }}"
                           required>
                </div>

                <!-- FILE -->
                <div class="col-12">
                    <label class="form-label">File Foto / Video</label>
                    <input type="file"
                           name="file"
                           id="fileInput"
                           class="form-control"
                           accept="image/jpeg,image/png,image/webp,video/mp4,video/quicktime,video/x-msvideo"
                           {{ $galeri->exists ? '' : 'required' }}>

                    <small class="text-muted">
                        Foto: JPG, JPEG, PNG, WEBP. Video: MP4, MOV, AVI.
                        Maksimal 20 MB.
                        @if($galeri->exists)
                            Kosongkan jika tidak ingin mengganti file.
                        @endif
                    </small>

                    <div class="mt-3" id="previewContainer"
                         style="{{ $galeri->file ? '' : 'display:none;' }}">

                        <img id="fotoPreview"
                             class="galeri-preview"
                             alt="Preview Foto"
                             style="{{ $galeri->file && $galeri->kategori == 'Foto' ? '' : 'display:none;' }}"
                             src="{{ $galeri->file && $galeri->kategori == 'Foto' ? asset('storage/'.$galeri->file) : '' }}">

                        <video id="videoPreview"
                               class="galeri-preview"
                               controls
                               style="{{ $galeri->file && $galeri->kategori == 'Video' ? '' : 'display:none;' }}">
                            @if($galeri->file && $galeri->kategori == 'Video')
                                <source src="{{ asset('storage/'.$galeri->file) }}">
                            @endif
                        </video>
                    </div>
                </div>
            </div>

            <!-- TOMBOL -->
            <div class="form-footer mt-4">
                <a href="{{ route('admin.galeri') }}"
                   class="btn btn-cancel">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit" class="btn btn-save">
                    <i class="bi bi-save"></i>
                    {{ $galeri->exists ? 'Simpan Perubahan' : 'Simpan Galeri' }}
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.galeri-header {
    background: linear-gradient(135deg, #18392b, #32634a);
    color: white;
    padding: 25px 30px;
    border-radius: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.galeri-header h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 6px;
}

.galeri-header p {
    margin: 0;
    color: #dce9df;
}

.header-icon {
    font-size: 42px;
    opacity: .85;
}

.galeri-card {
    background: white;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 3px 15px rgba(0,0,0,.06);
}

.card-heading {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #28563e;
    border-bottom: 1px solid #e8eee9;
    padding-bottom: 15px;
}

.card-heading i {
    font-size: 22px;
}

.card-heading h5 {
    font-weight: 700;
}

.form-label {
    color: #34483b;
    font-weight: 600;
    font-size: 14px;
}

.form-control, .form-select {
    border: 1px solid #dce4de;
    border-radius: 8px;
    padding: 10px 12px;
}

.form-control:focus, .form-select:focus {
    border-color: #4d8061;
    box-shadow: 0 0 0 3px rgba(77,128,97,.12);
}

.galeri-preview {
    width: 180px;
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid #d9e8dc;
}

.form-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    border-top: 1px solid #e8eee9;
    padding-top: 20px;
}

.btn-save, .btn-cancel {
    border-radius: 8px;
    padding: 10px 20px;
}

.btn-save {
    background: #28563e;
    color: white;
    border: 0;
}

.btn-save:hover {
    background: #18392b;
    color: white;
}

.btn-cancel {
    background: #edf0ed;
    color: #34483b;
}

.btn-cancel:hover {
    background: #dce4de;
    color: #18392b;
}

@media(max-width: 768px) {
    .galeri-header {
        padding: 20px;
    }

    .galeri-card {
        padding: 18px;
    }
}
</style>

<script>
const fileInput = document.getElementById('fileInput');
const kategori = document.getElementById('kategori');
const container = document.getElementById('previewContainer');
const fotoPreview = document.getElementById('fotoPreview');
const videoPreview = document.getElementById('videoPreview');

fileInput.addEventListener('change', function () {
    const file = this.files[0];

    if (!file) return;

    const url = URL.createObjectURL(file);
    container.style.display = 'block';

    if (file.type.startsWith('image/')) {
        fotoPreview.src = url;
        fotoPreview.style.display = 'block';
        videoPreview.style.display = 'none';
        videoPreview.pause();
    } else if (file.type.startsWith('video/')) {
        videoPreview.src = url;
        videoPreview.style.display = 'block';
        fotoPreview.style.display = 'none';
    }
});
</script>
@endsection