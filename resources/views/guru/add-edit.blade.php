@extends('admin_app')

<link rel="icon" type="image/png" href="{{ asset("assets/images/logo sekolah.jpg") }}">

@php
    use Illuminate\Support\Facades\Crypt;
@endphp

@section('title', $title)

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="guru-header mb-4">
        <div>
            <h2>{{ $guru->exists ? 'Edit Guru' : 'Tambah Guru' }}</h2>
            <p>Lengkapi informasi data guru sekolah.</p>
        </div>
        <i class="bi bi-person-workspace header-icon"></i>
    </div>

    <!-- FORM -->
    <div class="guru-card">

        <div class="card-heading mb-4">
            <i class="bi bi-info-circle"></i>
            <h5 class="mb-0">Informasi Guru</h5>
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

        @if($guru->exists)
            <form action="{{ route('guru.update', Crypt::encryptString((string) $guru->id_guru)) }}"
             method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        @else
            <form action="{{ route('guru.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
        @endif

            <div class="row g-3">

                <!-- NAMA -->
                <div class="col-md-6">
                    <label class="form-label">Nama Guru</label>
                    <input type="text"
                           name="nama_guru"
                           class="form-control"
                           value="{{ old('nama_guru', $guru->nama_guru) }}"
                           placeholder="Masukkan nama guru"
                           maxlength="40"
                           required>
                </div>

                <!-- NIP -->
                <div class="col-md-6">
                    <label class="form-label">NIP</label>
                    <input type="text"
                           name="nip"
                           class="form-control"
                           value="{{ old('nip', $guru->nip) }}"
                           placeholder="Masukkan NIP"
                           maxlength="15">
                </div>

                <!-- MAPEL -->
                <div class="col-12">
                    <label class="form-label">Mata Pelajaran</label>
                    <input type="text"
                           name="mapel"
                           class="form-control"
                           value="{{ old('mapel', $guru->mapel) }}"
                           placeholder="Masukkan mata pelajaran"
                           maxlength="40"
                           required>
                </div>

<!-- FOTO -->
<div class="col-12">
    <label class="form-label">Foto Guru</label>

    <input type="file"
           name="foto"
           id="fotoInput"
           class="form-control @error('foto') is-invalid @enderror"
           accept=".jpg,.jpeg,.png,.webp"
           {{ $guru->exists ? '' : 'required' }}>

    @error('foto')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <small class="text-muted">
        Format JPG, JPEG, PNG atau WEBP. Maksimal 2 MB.
    </small>

    <div class="mt-3">
        <img
            id="fotoPreview"
            src="{{ $guru->foto ? asset('storage/'.$guru->foto) : '' }}"
            alt="Preview Foto"
            style="{{ $guru->foto ? '' : 'display:none;' }}"
            class="foto-preview">
    </div>
</div>

            <!-- TOMBOL -->
            <div class="form-footer mt-4">
                <a href="{{ route('admin.guru') }}"
                   class="btn btn-cancel">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit" class="btn btn-save">
                    <i class="bi bi-save"></i>
                    {{ $guru->exists ? 'Simpan Perubahan' : 'Simpan Guru' }}
                </button>
            </div>

        </form>
    </div>
</div>

<script>
document.getElementById('fotoInput').addEventListener('change', function () {
    const file = this.files[0];
    const preview = document.getElementById('fotoPreview');

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>

<style>
.guru-header {
    background: linear-gradient(135deg, #18392b, #32634a);
    color: white;
    padding: 25px 30px;
    border-radius: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.guru-header h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 6px;
}

.guru-header p {
    margin: 0;
    color: #dce9df;
}

.header-icon {
    font-size: 42px;
    opacity: .85;
}

.guru-card {
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

.form-control {
    border: 1px solid #dce4de;
    border-radius: 8px;
    padding: 10px 12px;
}

.form-control:focus {
    border-color: #4d8061;
    box-shadow: 0 0 0 3px rgba(77,128,97,.12);
}

.foto-preview {
    width: 120px;
    height: 120px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid #d9e8dc;
}

.form-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    border-top: 1px solid #e8eee9;
    padding-top: 20px;
}

.btn-save,
.btn-cancel {
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
    .guru-header {
        padding: 20px;
    }

    .guru-card {
        padding: 18px;
    }
}
</style>
@endsection