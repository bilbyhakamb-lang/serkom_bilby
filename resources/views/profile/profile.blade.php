@extends('admin_app')

<link rel="icon" type="image/png" href="{{ asset('assets/images/logo sekolah.jpg') }}">

@section('title', 'Profile Sekolah')

@push('styles')
<style>
    /* ============ HEADER BANNER ============ */
    .profil-header {
        background: linear-gradient(135deg, #18392b, #32634a);
        color: white;
        padding: 28px 32px;
        border-radius: 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .profil-header h2 {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 6px;
    }

    .profil-header p {
        margin: 0;
        color: #dce9df;
        font-size: 14px;
    }

    .profil-header .header-icon {
        font-size: 46px;
        opacity: .85;
    }

    /* ============ CARD ============ */
    .profil-card {
        background: #fff;
        border-radius: 14px;
        padding: 25px 30px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
        margin-bottom: 20px;
    }

    .profil-card-title {
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

    .profil-card-title i {
        color: #28563e;
    }

    /* ============ IDENTITAS ============ */
    .sekolah-identitas {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        background: #f7fbf8;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .sekolah-logo {
        width: 84px;
        height: 84px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #d9e8dc;
        background: #fff;
    }

    .sekolah-logo-placeholder {
        width: 84px;
        height: 84px;
        border-radius: 50%;
        background: #edf4ef;
        color: #32634a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 38px;
        border: 3px solid #d9e8dc;
        flex-shrink: 0;
    }

    .sekolah-nama {
        font-size: 20px;
        font-weight: 700;
        color: #18392b;
        margin: 0 0 4px;
    }

    .sekolah-sub {
        color: #6b7d72;
        font-size: 13px;
        margin: 0;
    }

    /* ============ INFO GRID ============ */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px 24px;
        margin-bottom: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .info-label {
        font-size: 12px;
        color: #7b857e;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .info-value {
        font-size: 14px;
        color: #26352d;
        font-weight: 500;
        background: #f7fbf8;
        border: 1px solid #e7ebe8;
        border-radius: 8px;
        padding: 10px 14px;
        min-height: 42px;
        display: flex;
        align-items: center;
        word-break: break-word;
    }

    .info-value.textarea {
        align-items: flex-start;
        padding-top: 12px;
        min-height: 90px;
        white-space: pre-line;
    }

    /* ============ FOTO SEKOLAH ============ */
    .foto-sekolah-wrap {
        margin-top: 6px;
    }

    .foto-sekolah {
        width: 100%;
        max-height: 260px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid #e7ebe8;
    }

    .foto-placeholder {
        width: 100%;
        height: 200px;
        border-radius: 12px;
        background: #f7fbf8;
        border: 2px dashed #d9e8dc;
        color: #8fa398;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .foto-placeholder i {
        font-size: 40px;
    }

    /* ============ BUTTON ============ */
    .btn-edit-profil {
        background: #28563e;
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        border: none;
        transition: .2s;
    }

    .btn-edit-profil:hover {
        background: #18392b;
        color: white;
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 768px) {
        .profil-header {
            padding: 20px;
        }

        .profil-card {
            padding: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .sekolah-identitas {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="profil-header">
        <div>
            <h2>Profile Sekolah</h2>
            <p>Kelola informasi dan identitas sekolah.</p>
        </div>

        <i class="bi bi-bank2 header-icon"></i>
    </div>

    <!-- NOTIFIKASI SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show"
             role="alert"
             id="success-alert">

            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    <!-- NOTIFIKASI ERROR -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">

            <i class="bi bi-exclamation-circle me-1"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    <div class="row g-4">

        <!-- ================= KOLOM KIRI ================= -->
        <div class="col-lg-5">

            <div class="profil-card">

                <h5 class="profil-card-title">
                    <i class="bi bi-image"></i>
                    Logo & Foto Sekolah
                </h5>

                <!-- IDENTITAS SEKOLAH -->
                <div class="sekolah-identitas">

                    {{-- LOGO --}}
                    @if($profilSekolah && !empty($profilSekolah->logo))

                        <img src="{{ asset('storage/' . $profilSekolah->logo) }}"
                             alt="Logo Sekolah"
                             class="sekolah-logo">

                    @else

                        <div class="sekolah-logo-placeholder">
                            <i class="bi bi-bank"></i>
                        </div>

                    @endif

                    <div>

                        <h4 class="sekolah-nama">
                            {{ $profilSekolah->nama_sekolah ?? 'Nama Sekolah' }}
                        </h4>

                        <p class="sekolah-sub">
                            Profil dan Identitas Sekolah
                        </p>

                    </div>

                </div>

                <!-- FOTO SEKOLAH -->
                <div class="foto-sekolah-wrap">

                    @if($profilSekolah && !empty($profilSekolah->foto))

                        <img src="{{ asset('storage/' . $profilSekolah->foto) }}"
                             alt="Foto Sekolah"
                             class="foto-sekolah">

                    @else

                        <div class="foto-placeholder">

                            <i class="bi bi-image"></i>

                            <span>
                                Belum ada foto sekolah
                            </span>

                        </div>

                    @endif

                </div>

            </div>

        </div>

        <!-- ================= KOLOM KANAN ================= -->
        <div class="col-lg-7">

            <div class="profil-card">

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                    <h5 class="profil-card-title mb-0"
                        style="border-bottom:none; padding-bottom:0;">

                        <i class="bi bi-info-circle"></i>
                        Informasi Sekolah

                    </h5>

                    <a href="{{ route('profile.edit') }}"
                       class="btn-edit-profil">

                        <i class="bi bi-pencil-square"></i>
                        Edit Profil

                    </a>

                </div>

                <div class="info-grid">

                    <!-- NAMA SEKOLAH -->
                    <div class="info-item">

                        <span class="info-label">
                            Nama Sekolah
                        </span>

                        <div class="info-value">
                            {{ $profilSekolah->nama_sekolah ?? '-' }}
                        </div>

                    </div>

                    <!-- KEPALA SEKOLAH -->
                    <div class="info-item">

                        <span class="info-label">
                            Kepala Sekolah
                        </span>

                        <div class="info-value">
                            {{ $profilSekolah->kepala_sekolah ?? '-' }}
                        </div>

                    </div>

                    <!-- NPSN -->
                    <div class="info-item">

                        <span class="info-label">
                            NPSN
                        </span>

                        <div class="info-value">
                            {{ $profilSekolah->npsn ?? '-' }}
                        </div>

                    </div>

                    <!-- TAHUN BERDIRI -->
                    <div class="info-item">

                        <span class="info-label">
                            Tahun Berdiri
                        </span>

                        <div class="info-value">
                            {{ $profilSekolah->tahun_berdiri ?? '-' }}
                        </div>

                    </div>

                    <!-- ALAMAT -->
                    <div class="info-item"
                         style="grid-column: span 2;">

                        <span class="info-label">
                            Alamat Sekolah
                        </span>

                        <div class="info-value textarea">
                            {{ $profilSekolah->alamat ?? '-' }}
                        </div>

                    </div>

                    <!-- KONTAK -->
                    <div class="info-item"
                         style="grid-column: span 2;">

                        <span class="info-label">
                            Kontak
                        </span>

                        <div class="info-value">
                            {{ $profilSekolah->kontak ?? '-' }}
                        </div>

                    </div>

                    <!-- VISI MISI -->
                    <div class="info-item"
                         style="grid-column: span 2;">

                        <span class="info-label">
                            Visi dan Misi
                        </span>

                        <div class="info-value textarea">
                            {{ $profilSekolah->visi_misi ?? '-' }}
                        </div>

                    </div>

                    <!-- DESKRIPSI -->
                    <div class="info-item"
                         style="grid-column: span 2;">

                        <span class="info-label">
                            Deskripsi Sekolah
                        </span>

                        <div class="info-value textarea">
                            {{ $profilSekolah->deskripsi ?? '-' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    // ALERT BERHASIL AKAN HILANG SETELAH 5 DETIK
    setTimeout(function () {

        const alert = document.getElementById('success-alert');

        if (alert) {

            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';

            setTimeout(function () {
                alert.remove();
            }, 500);

        }

    }, 5000);
</script>
@endpush