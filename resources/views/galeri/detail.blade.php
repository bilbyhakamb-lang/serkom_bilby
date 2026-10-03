
@extends('admin_app')

@section('title', $title ?? 'Detail Galeri')

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="galeri-header mb-4">
        <div>
            <h2>Detail Galeri</h2>
            <p>Informasi lengkap dokumentasi galeri sekolah.</p>
        </div>
        <i class="bi bi-images header-icon"></i>
    </div>

    <!-- CARD DETAIL -->
    <div class="galeri-card">

        <!-- JUDUL CARD -->
        <div class="card-heading mb-4">
            <div>
                <h5 class="mb-1">
                    <i class="bi bi-info-circle me-2"></i>
                    Informasi Galeri
                </h5>
                <p class="text-muted small mb-0">
                    Detail dokumentasi kegiatan sekolah
                </p>
            </div>

            <a href="{{ route('admin.galeri') }}"
               class="btn btn-back">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>
        </div>

        <!-- ISI DETAIL -->
        <div class="row g-4">

            <!-- PREVIEW GAMBAR / VIDEO -->
            <div class="col-md-5">
                <div class="galeri-preview">

                    @if($galeri->kategori == 'Foto')
                        @if($galeri->file)
                            <img
                                src="{{ asset('storage/' . $galeri->file) }}"
                                alt="{{ $galeri->judul }}"
                                class="preview-image"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                            <div class="preview-empty" style="display: none;">
                                <i class="bi bi-image"></i>
                                <span>Gambar tidak tersedia</span>
                            </div>
                        @else
                            <div class="preview-empty">
                                <i class="bi bi-image"></i>
                                <span>Gambar tidak tersedia</span>
                            </div>
                        @endif
                    @else
                        @if($galeri->file)
                            <video controls class="preview-video">
                                <source src="{{ asset('storage/' . $galeri->file) }}">
                                Browser Anda tidak mendukung pemutar video.
                            </video>
                        @else
                            <div class="preview-empty">
                                <i class="bi bi-camera-video"></i>
                                <span>Video tidak tersedia</span>
                            </div>
                        @endif
                    @endif

                </div>
            </div>

            <!-- INFORMASI GALERI -->
            <div class="col-md-7">

                <h3 class="galeri-title mb-3">
                    {{ $galeri->judul }}
                </h3>

                <div class="table-responsive">
                    <table class="table table-borderless detail-table mb-3">

                        <!-- KATEGORI -->
                        <tr>
                            <th width="35%">Kategori</th>
                            <td>
                                :
                                @if($galeri->kategori == 'Foto')
                                    <span class="badge badge-foto">
                                        <i class="bi bi-image me-1"></i>
                                        Foto
                                    </span>
                                @else
                                    <span class="badge badge-video">
                                        <i class="bi bi-camera-video me-1"></i>
                                        Video
                                    </span>
                                @endif
                            </td>
                        </tr>

                        <!-- TANGGAL -->
                        <tr>
                            <th>Tanggal</th>
                            <td>
                                :
                                {{ $galeri->tanggal
                                    ? \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y')
                                    : '-' }}
                            </td>
                        </tr>

                        <!-- KETERANGAN -->
                        <tr>
                            <th class="align-top">Keterangan</th>
                            <td class="align-top">:</td>
                        </tr>
                    </table>
                </div>

                <!-- DESKRIPSI -->
                <div class="galeri-description">
                    {{ $galeri->keterangan ?: 'Tidak ada keterangan.' }}
                </div>

                <!-- TOMBOL EDIT -->
                <div class="mt-4">
                    <a
                        href="{{ route('galeri.edit', \Illuminate\Support\Facades\Crypt::encryptString((string) $galeri->id_galeri)) }}"
                        class="btn btn-edit">
                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Data Ini
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- STYLE -->
<style>
/* HEADER */
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

/* CARD */
.galeri-card {
    background: white;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
}

/* JUDUL CARD */
.card-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    border-bottom: 1px solid #e8eee9;
    padding-bottom: 15px;
}

.card-heading h5 {
    color: #28563e;
    font-weight: 700;
}

/* PREVIEW */
.galeri-preview {
    width: 100%;
    min-height: 280px;
    background: #f3f7f4;
    border: 1px solid #e0e9e2;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.preview-image {
    width: 100%;
    max-height: 380px;
    object-fit: contain;
    border-radius: 10px;
}

.preview-video {
    width: 100%;
    max-height: 380px;
    border-radius: 10px;
    background: #000;
}

.preview-empty {
    min-height: 280px;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    color: #9aafa0;
}

.preview-empty i {
    font-size: 48px;
}

/* INFORMASI */
.galeri-title {
    color: #18392b;
    font-size: 24px;
    font-weight: 700;
    overflow-wrap: anywhere;
}

.detail-table th {
    color: #718078;
    font-weight: 600;
    padding-left: 0;
    white-space: nowrap;
}

.detail-table td {
    color: #34483b;
    overflow-wrap: anywhere;
}

/* BADGE */
.badge-foto {
    background: #e2f3e8;
    color: #28563e;
    border: 1px solid #c7e6d0;
    padding: 7px 10px;
}

.badge-video {
    background: #dcefeb;
    color: #16715b;
    border: 1px solid #bce1d7;
    padding: 7px 10px;
}

/* KETERANGAN */
.galeri-description {
    background: #f5f8f5;
    border: 1px solid #e5ece6;
    border-radius: 10px;
    padding: 15px;
    color: #34483b;
    white-space: pre-line;
    overflow-wrap: anywhere;
    min-height: 80px;
}

/* TOMBOL KEMBALI */
.btn-back {
    background: #edf4ef;
    color: #28563e;
    border: 1px solid #d5e5d9;
    border-radius: 8px;
    padding: 9px 15px;
}

.btn-back:hover {
    background: #dcebe0;
    color: #18392b;
}

/* TOMBOL EDIT */
.btn-edit {
    background: #e5f1e9;
    color: #28563e;
    border: none;
    border-radius: 8px;
    padding: 10px 16px;
    transition: .2s ease;
}

.btn-edit:hover {
    background: #cfe5d6;
    color: #18392b;
    transform: translateY(-2px);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .galeri-header {
        padding: 20px;
    }

    .galeri-header h2 {
        font-size: 20px;
    }

    .galeri-card {
        padding: 18px;
    }

    .card-heading {
        align-items: flex-start;
    }

    .galeri-title {
        font-size: 20px;
    }

    .galeri-preview {
        min-height: 220px;
    }
}
</style>
@endsection