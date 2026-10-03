@extends('admin_app')

@section('title', isset($profilSekolah) && $profilSekolah->exists
    ? 'Edit Profile Sekolah'
    : 'Tambah Profile Sekolah')

@push('styles')
<style>
    .form-header {
        background: linear-gradient(135deg, #18392b, #32634a);
        color: white;
        padding: 28px 32px;
        border-radius: 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .form-header h2 {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 6px;
    }

    .form-header p {
        margin: 0;
        color: #dce9df;
        font-size: 14px;
    }

    .form-header .header-icon {
        font-size: 46px;
        opacity: .85;
    }

    .form-card {
        background: #fff;
        border-radius: 14px;
        padding: 28px 32px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
        margin-bottom: 20px;
    }

    .form-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #263b30;
        margin: 0 0 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf4ef;
    }

    .form-card-title i {
        color: #28563e;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #34483b;
        margin-bottom: 6px;
    }

    .form-label .required {
        color: #d64545;
    }

    .form-control {
        border: 1px solid #dfe7e2;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        color: #26352d;
        transition: .2s;
    }

    .form-control:focus {
        border-color: #28563e;
        box-shadow: 0 0 0 3px rgba(40, 86, 62, .12);
    }

    textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .upload-preview {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 20px;
        background: #f7fbf8;
        border: 2px dashed #cfe0d5;
        border-radius: 12px;
        margin-bottom: 14px;
        min-height: 140px;
    }

    .upload-preview img {
        max-width: 100%;
        max-height: 150px;
        border-radius: 8px;
        object-fit: contain;
    }

    .placeholder-icon {
        font-size: 40px;
        color: #8fa398;
    }

    .placeholder-text {
        font-size: 13px;
        color: #8fa398;
    }

    .btn-simpan {
        background: #28563e;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 11px 24px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-simpan:hover {
        background: #18392b;
        color: white;
    }

    .btn-batal {
        background: #eef2ef;
        color: #556a5e;
        border-radius: 8px;
        padding: 11px 22px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-batal:hover {
        background: #dde5df;
        color: #34483b;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 24px;
    }

    @media (max-width: 768px) {
        .form-header {
            padding: 20px;
        }

        .form-card {
            padding: 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">

    @php
        $isEdit = isset($profilSekolah)
            && $profilSekolah
            && $profilSekolah->exists;
    @endphp

    <!-- HEADER -->
    <div class="form-header">
        <div>
            <h2>
                {{ $isEdit ? 'Edit Profile Sekolah' : 'Tambah Profile Sekolah' }}
            </h2>

            <p>
                {{ $isEdit
                    ? 'Perbarui informasi dan identitas sekolah.'
                    : 'Lengkapi informasi dan identitas sekolah.' }}
            </p>
        </div>

        <i class="bi {{ $isEdit ? 'bi-pencil-square' : 'bi-plus-circle' }} header-icon"></i>
    </div>

    <!-- ERROR -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>
                <i class="bi bi-exclamation-triangle me-1"></i>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    <!-- FORM -->
    <form action="{{ $isEdit ? route('profile.update') : route('profile.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @if($isEdit)
            @method('PUT')
        @endif

        <div class="row g-4">

            <!-- KOLOM KIRI -->
            <div class="col-lg-5">

                <div class="form-card">

                    <h5 class="form-card-title">
                        <i class="bi bi-image"></i>
                        Logo & Foto Sekolah
                    </h5>

                    <!-- LOGO -->
                    <div class="mb-4">

                        <label class="form-label">
                            Logo Sekolah
                        </label>

                        <div class="upload-preview" id="previewLogo">

                            @if($isEdit && $profilSekolah->logo)

                                <img src="{{ asset('storage/' . $profilSekolah->logo) }}"
                                     alt="Logo Sekolah">

                            @else

                                <i class="bi bi-bank placeholder-icon"></i>
                                <span class="placeholder-text">
                                    Belum ada logo
                                </span>

                            @endif

                        </div>

                        <input type="file"
                               name="logo"
                               id="inputLogo"
                               class="form-control"
                               accept="image/jpeg,image/png,image/webp">

                        <small class="text-muted">
                            Format JPG, PNG, WEBP. Maksimal 2MB.
                        </small>

                    </div>

                    <!-- FOTO -->
                    <div>

                        <label class="form-label">
                            Foto Sekolah
                        </label>

                        <div class="upload-preview" id="previewFoto">

                            @if($isEdit && $profilSekolah->foto)

                                <img src="{{ asset('storage/' . $profilSekolah->foto) }}"
                                     alt="Foto Sekolah">

                            @else

                                <i class="bi bi-image placeholder-icon"></i>
                                <span class="placeholder-text">
                                    Belum ada foto
                                </span>

                            @endif

                        </div>

                        <input type="file"
                               name="foto"
                               id="inputFoto"
                               class="form-control"
                               accept="image/jpeg,image/png,image/webp">

                        <small class="text-muted">
                            Format JPG, PNG, WEBP. Maksimal 4MB.
                        </small>

                    </div>

                </div>

            </div>

            <!-- KOLOM KANAN -->
            <div class="col-lg-7">

                <div class="form-card">

                    <h5 class="form-card-title">
                        <i class="bi bi-info-circle"></i>
                        Informasi Sekolah
                    </h5>

                    <div class="row g-3">

                        <!-- NAMA -->
                        <div class="col-md-6">
                            <label class="form-label">
                                Nama Sekolah <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="nama_sekolah"
                                   class="form-control"
                                   value="{{ old('nama_sekolah', $profilSekolah->nama_sekolah ?? '') }}"
                                   placeholder="Contoh: SMAN 7 Tasikmalaya"
                                   maxlength="40"
                                   required>
                        </div>

                        <!-- KEPALA SEKOLAH -->
                        <div class="col-md-6">
                            <label class="form-label">
                                Kepala Sekolah <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="kepala_sekolah"
                                   class="form-control"
                                   value="{{ old('kepala_sekolah', $profilSekolah->kepala_sekolah ?? '') }}"
                                   placeholder="Nama kepala sekolah"
                                   maxlength="40"
                                   required>
                        </div>

                        <!-- NPSN -->
                        <div class="col-md-6">
                            <label class="form-label">
                                NPSN <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="npsn"
                                   class="form-control"
                                   value="{{ old('npsn', $profilSekolah->npsn ?? '') }}"
                                   placeholder="Nomor Pokok Sekolah Nasional"
                                   maxlength="10"
                                   required>
                        </div>

                        <!-- TAHUN -->
                        <div class="col-md-6">
                            <label class="form-label">
                                Tahun Berdiri <span class="required">*</span>
                            </label>

                            <input type="number"
                                   name="tahun_berdiri"
                                   class="form-control"
                                   value="{{ old('tahun_berdiri', $profilSekolah->tahun_berdiri ?? '') }}"
                                   placeholder="Contoh: 1998"
                                   min="1900"
                                   max="{{ date('Y') }}"
                                   required>
                        </div>

                        <!-- ALAMAT -->
                        <div class="col-12">
                            <label class="form-label">
                                Alamat Sekolah <span class="required">*</span>
                            </label>

                            <textarea name="alamat"
                                      class="form-control"
                                      placeholder="Alamat lengkap sekolah"
                                      required>{{ old('alamat', $profilSekolah->alamat ?? '') }}</textarea>
                        </div>

                        <!-- KONTAK -->
                        <div class="col-12">
                            <label class="form-label">
                                Kontak <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="kontak"
                                   class="form-control"
                                   value="{{ old('kontak', $profilSekolah->kontak ?? '') }}"
                                   placeholder="Nomor telepon / email"
                                   maxlength="15"
                                   required>
                        </div>

                        <!-- VISI MISI -->
                        <div class="col-12">
                            <label class="form-label">
                                Visi dan Misi <span class="required">*</span>
                            </label>

                            <textarea name="visi_misi"
                                      class="form-control"
                                      placeholder="Visi dan misi sekolah"
                                      required>{{ old('visi_misi', $profilSekolah->visi_misi ?? '') }}</textarea>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="col-12">
                            <label class="form-label">
                                Deskripsi Sekolah <span class="required">*</span>
                            </label>

                            <textarea name="deskripsi"
                                      class="form-control"
                                      placeholder="Deskripsi singkat sekolah"
                                      required>{{ old('deskripsi', $profilSekolah->deskripsi ?? '') }}</textarea>
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="form-footer">

                        <a href="{{ route('admin.profile') }}"
                           class="btn-batal">
                            <i class="bi bi-x-circle"></i>
                            Batal
                        </a>

                        <button type="submit"
                                class="btn-simpan">
                            <i class="bi bi-check-circle"></i>
                            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Profile' }}
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
    // PREVIEW LOGO
    const inputLogo = document.getElementById('inputLogo');
    const previewLogo = document.getElementById('previewLogo');

    if (inputLogo) {
        inputLogo.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                previewLogo.innerHTML = `
                    <img src="${e.target.result}"
                         alt="Preview Logo">
                `;

            };

            reader.readAsDataURL(file);
        });
    }

    // PREVIEW FOTO
    const inputFoto = document.getElementById('inputFoto');
    const previewFoto = document.getElementById('previewFoto');

    if (inputFoto) {
        inputFoto.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                previewFoto.innerHTML = `
                    <img src="${e.target.result}"
                         alt="Preview Foto">
                `;

            };

            reader.readAsDataURL(file);
        });
    }
</script>
@endpush