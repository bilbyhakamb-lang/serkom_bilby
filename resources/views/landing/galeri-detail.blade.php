
@extends('landing.layout')

@section('title', $galeri->judul . ' - Galeri Sekolah')

@push('styles')
<style>
    .galeri-detail-section {
        padding: 70px 0;
        min-height: 70vh;
        background: #f5f8f5;
    }

    .galeri-detail-card {
        overflow: hidden;
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 8px 30px rgba(24, 57, 43, 0.08);
    }

    .galeri-media {
        width: 100%;
        max-height: 600px;
        display: block;
        object-fit: contain;
        background: #18392b;
    }

    .galeri-detail-info {
        padding: 30px;
    }

    .galeri-detail-title {
        color: #18392b;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .galeri-detail-label {
        color: #285943;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .galeri-keterangan {
        color: #555555;
        line-height: 1.8;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .galeri-tanggal {
        color: #6c757d;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .galeri-detail-section {
            padding: 35px 0;
        }

        .galeri-detail-info {
            padding: 22px;
        }

        .galeri-media {
            max-height: 400px;
        }
    }
</style>
@endpush

@section('content')

<section class="galeri-detail-section">
    <div class="container">

        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('landing') }}#galeri"
           class="btn btn-outline-success mb-4">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali ke Galeri
        </a>

        <div class="galeri-detail-card">

            <div class="row g-0">

                {{-- MEDIA GALERI --}}
                <div class="col-lg-7">

                    @if($galeri->kategori === 'Foto')

                        {{-- MENAMPILKAN FOTO --}}
                        <img
                            src="{{ asset('storage/' . $galeri->file) }}"
                            alt="{{ $galeri->judul }}"
                            class="galeri-media"
                        >

                    @else

                        {{-- MENAMPILKAN VIDEO --}}
                        <video
                            controls
                            playsinline
                            preload="metadata"
                            class="galeri-media"
                        >
                            <source src="{{ asset('storage/' . $galeri->file) }}">

                            Browser kamu tidak mendukung pemutaran video.
                        </video>

                    @endif

                </div>

                {{-- INFORMASI GALERI --}}
                <div class="col-lg-5">
                    <div class="galeri-detail-info">

                        <span class="badge text-bg-success mb-3">
                            <i class="bi {{ $galeri->kategori === 'Foto' ? 'bi-image' : 'bi-camera-video' }} me-1"></i>
                            {{ $galeri->kategori }}
                        </span>

                        <h1 class="galeri-detail-title mb-3">
                            {{ $galeri->judul }}
                        </h1>

                        {{-- TANGGAL GALERI --}}
                        @if($galeri->tanggal)

                            <div class="galeri-tanggal mb-4">
                                <i class="bi bi-calendar-event me-2"></i>

                                {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d-m-Y') }}
                            </div>

                        @endif

                        <hr>

                        {{-- KETERANGAN GALERI --}}
                        <h5 class="galeri-detail-label mt-4">
                            <i class="bi bi-info-circle me-2"></i>
                            Keterangan
                        </h5>

                        <p class="galeri-keterangan mb-0">{{ $galeri->keterangan ?: 'Belum ada keterangan untuk galeri ini.' }}</p>

                        <a href="{{ route('landing') }}#galeri"
                           class="btn btn-success mt-4">
                            <i class="bi bi-arrow-left me-2"></i>
                            Kembali ke Galeri
                        </a>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection