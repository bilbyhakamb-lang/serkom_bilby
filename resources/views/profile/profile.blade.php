@extends('admin_app')

@section('title', 'Profil Sekolah')

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="profile-header mb-4">
        <div>
            <h2>Profil Sekolah</h2>
            <p>Kelola informasi dan identitas sekolah.</p>
        </div>
        <div class="profile-icon">
            <i class="bi bi-building"></i>
        </div>
    </div>

    <!-- PESAN BERHASIL -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- PESAN ERROR -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('admin.profil-sekolah.save') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="row g-4">

            <!-- KARTU IDENTITAS -->
            <div class="col-lg-4">
                <div class="profile-card text-center">

                    <!-- LOGO SEKOLAH -->
                    <div class="school-logo">
                        <img
                            id="logoPreview"
                            src="{{ $profilSekolah?->logo ? asset('storage/'.$profilSekolah->logo) : '' }}"
                            alt="Logo Sekolah"
                            style="{{ $profilSekolah?->logo ? '' : 'display:none;' }}"
                        >

                        <i id="logoIcon"
                           class="bi bi-building"
                           style="{{ $profilSekolah?->logo ? 'display:none;' : '' }}">
                        </i>
                    </div>

                    <h4 id="namaPreview">
                        {{ $profilSekolah?->nama_sekolah ?? 'Nama Sekolah' }}
                    </h4>

                    <p class="text-muted mb-3">
                        Profil dan Identitas Sekolah
                    </p>

                    <!-- INPUT LOGO -->
                    <div class="text-start">
                        <label class="form-label">Logo Sekolah</label>
                        <input type="file"
                               name="logo"
                               id="logoInput"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">

                        @error('logo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <hr>

                    <!-- INPUT FOTO -->
                    <div class="text-start">
                        <label class="form-label">Foto Sekolah</label>
                        <input type="file"
                               name="foto"
                               id="fotoInput"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">

                        @error('foto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- PREVIEW FOTO -->
                    <div class="mt-3">
                        <img
                            id="fotoPreview"
                            src="{{ $profilSekolah?->foto ? asset('storage/'.$profilSekolah->foto) : '' }}"
                            alt="Foto Sekolah"
                            class="school-photo"
                            style="{{ $profilSekolah?->foto ? '' : 'display:none;' }}"
                        >
                    </div>

                </div>
            </div>

            <!-- INFORMASI SEKOLAH -->
            <div class="col-lg-8">
                <div class="profile-card">

                    <div class="card-heading">
                        <i class="bi bi-info-circle"></i>
                        <h5>Informasi Sekolah</h5>
                    </div>

                    <div class="row g-3">

                        <!-- NAMA SEKOLAH -->
                        <div class="col-md-6">
                            <label class="form-label">Nama Sekolah</label>
                            <input type="text"
                                   name="nama_sekolah"
                                   id="namaSekolah"
                                   class="form-control"
                                   value="{{ old('nama_sekolah', $profilSekolah?->nama_sekolah ?? '') }}"
                                   required>
                        </div>

                        <!-- KEPALA SEKOLAH -->
                        <div class="col-md-6">
                            <label class="form-label">Kepala Sekolah</label>
                            <input type="text"
                                   name="kepala_sekolah"
                                   class="form-control"
                                   value="{{ old('kepala_sekolah', $profilSekolah?->kepala_sekolah ?? '') }}"
                                   required>
                        </div>

                        <!-- NPSN -->
                        <div class="col-md-6">
                            <label class="form-label">NPSN</label>
                            <input type="text"
                                   name="npsn"
                                   class="form-control"
                                   value="{{ old('npsn', $profilSekolah?->npsn ?? '') }}"
                                   required>
                        </div>

                        <!-- TAHUN BERDIRI -->
                        <div class="col-md-6">
                            <label class="form-label">Tahun Berdiri</label>
                            <input type="number"
                                   name="tahun_berdiri"
                                   class="form-control"
                                   value="{{ old('tahun_berdiri', $profilSekolah?->tahun_berdiri ?? '') }}"
                                   required>
                        </div>

                        <!-- ALAMAT -->
                        <div class="col-12">
                            <label class="form-label">Alamat Sekolah</label>
                            <textarea name="alamat"
                                      class="form-control"
                                      rows="3"
                                      required>{{ old('alamat', $profilSekolah?->alamat ?? '') }}</textarea>
                        </div>

                        <!-- KONTAK -->
                        <div class="col-12">
                            <label class="form-label">Kontak</label>
                            <input type="text"
                                   name="kontak"
                                   class="form-control"
                                   value="{{ old('kontak', $profilSekolah?->kontak ?? '') }}"
                                   required>
                        </div>

                        <!-- VISI MISI -->
                        <div class="col-12">
                            <label class="form-label">Visi dan Misi</label>
                            <textarea name="visi_misi"
                                      class="form-control"
                                      rows="4"
                                      required>{{ old('visi_misi', $profilSekolah?->visi_misi ?? '') }}</textarea>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="col-12">
                            <label class="form-label">Deskripsi Sekolah</label>
                            <textarea name="deskripsi"
                                      class="form-control"
                                      rows="5"
                                      required>{{ old('deskripsi', $profilSekolah?->deskripsi ?? '') }}</textarea>
                        </div>

                    </div>

                    <!-- TOMBOL SIMPAN -->
                    <div class="form-footer mt-4">
                        <button type="submit" class="btn btn-save">
                            <i class="bi bi-save"></i>
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </form>
</div>

<!-- PREVIEW GAMBAR -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const logoInput = document.getElementById('logoInput');
    const logoPreview = document.getElementById('logoPreview');
    const logoIcon = document.getElementById('logoIcon');

    const fotoInput = document.getElementById('fotoInput');
    const fotoPreview = document.getElementById('fotoPreview');

    const namaSekolah = document.getElementById('namaSekolah');
    const namaPreview = document.getElementById('namaPreview');

    // Preview logo
    logoInput.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            logoPreview.src = URL.createObjectURL(file);
            logoPreview.style.display = 'block';
            logoIcon.style.display = 'none';
        }
    });

    // Tampilkan ikon jika gambar gagal dimuat
    logoPreview.addEventListener('error', function () {
        if (this.src) {
            this.style.display = 'none';
            logoIcon.style.display = 'block';
        }
    });

    // Preview foto sekolah
    fotoInput.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            fotoPreview.src = URL.createObjectURL(file);
            fotoPreview.style.display = 'block';
        }
    });

    // Preview nama sekolah
    namaSekolah.addEventListener('input', function () {
        namaPreview.textContent = this.value || 'Nama Sekolah';
    });
});
</script>

<!-- CSS -->
<style>
.profile-header {
    background: linear-gradient(135deg, #18392b, #32634a);
    color: white;
    padding: 25px 30px;
    border-radius: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.profile-header h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 6px;
}

.profile-header p {
    margin: 0;
    color: #dce9df;
}

.profile-icon {
    font-size: 42px;
    opacity: .85;
}

.profile-card {
    background: #fff;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 3px 15px rgba(0,0,0,.06);
    height: 100%;
}

.school-logo {
    width: 115px;
    height: 115px;
    border-radius: 50%;
    background: #edf4ef;
    color: #32634a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    margin: 5px auto 18px;
    overflow: hidden;
    border: 3px solid #d9e8dc;
}

.school-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.profile-card h4 {
    font-size: 19px;
    font-weight: 700;
    color: #263b30;
}

.school-photo {
    width: 100%;
    max-height: 190px;
    object-fit: cover;
    border-radius: 10px;
}

.card-heading {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #28563e;
    border-bottom: 1px solid #e8eee9;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.card-heading i {
    font-size: 22px;
}

.card-heading h5 {
    margin: 0;
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

.form-footer {
    display: flex;
    justify-content: flex-end;
    border-top: 1px solid #e8eee9;
    padding-top: 20px;
}

.btn-save {
    background: #28563e;
    color: white;
    border: 0;
    border-radius: 8px;
    padding: 10px 20px;
}

.btn-save:hover {
    background: #18392b;
    color: white;
}

@media(max-width: 768px) {
    .profile-header {
        padding: 20px;
    }

    .profile-card {
        padding: 18px;
    }
}
</style>
@endsection