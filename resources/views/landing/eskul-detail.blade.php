
@extends('landing.layout')

@section('title', 'Detail Ekstrakurikuler')

@push('styles')
<style>
    .eskul-detail-section {
        padding: 70px 0;
        min-height: 70vh;
        background: #f5f8f5;
    }

    .eskul-detail-card {
        overflow: hidden;
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 8px 30px rgba(24, 57, 43, 0.08);
    }

    .eskul-detail-image {
        display: block;
        width: 100%;
        height: 430px;
        object-fit: cover;
    }

    .eskul-detail-placeholder {
        height: 430px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e8eee9;
        color: #285943;
    }

    .eskul-detail-title {
        color: #18392b;
        font-weight: 700;
    }

    .eskul-detail-label {
        color: #285943;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .eskul-detail-info {
        padding: 18px;
        margin-bottom: 15px;
        border-radius: 12px;
        background: #f5f8f5;
        border-left: 4px solid #285943;
    }

    .eskul-detail-description {
        line-height: 1.8;
        color: #555;
        white-space: pre-line;
    }

    @media (max-width: 767px) {
        .eskul-detail-image,
        .eskul-detail-placeholder {
            height: 280px;
        }

        .eskul-detail-section {
            padding: 40px 0;
        }
    }
</style>
@endpush

@section('content')

<section class="eskul-detail-section">
    <div class="container">

        {{-- Tombol kembali --}}
        <a href="{{ route('landing') }}#eskul"
           class="btn btn-outline-success mb-4">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali ke Halaman Utama
        </a>

        <div class="eskul-detail-card">
            <div class="row g-0">

                {{-- FOTO EKSTRAKURIKULER --}}
                <div class="col-lg-6">

                    @if($eskul->gambar)
                        <img
                            src="{{ asset('storage/' . $eskul->gambar) }}"
                            alt="{{ $eskul->nama_ekskul }}"
                            class="eskul-detail-image"
                        >
                    @else
                        <div class="eskul-detail-placeholder">
                            <i class="bi bi-trophy"
                               style="font-size: 100px;"></i>
                        </div>
                    @endif

                </div>

                {{-- BIODATA EKSTRAKURIKULER --}}
                <div class="col-lg-6">
                    <div class="p-4 p-md-5">

                        <span class="badge text-bg-success mb-3">
                            Ekstrakurikuler Sekolah
                        </span>

                        <h1 class="eskul-detail-title mb-4">
                            {{ $eskul->nama_ekskul }}
                        </h1>

                        {{-- Nama pembina --}}
                        <div class="eskul-detail-info">
                            <div class="eskul-detail-label">
                                <i class="bi bi-person-fill me-2"></i>
                                Nama Pembina
                            </div>

                            <div>
                                {{ $eskul->pembina ?: '-' }}
                            </div>
                        </div>

                        {{-- Jadwal latihan --}}
                        <div class="eskul-detail-info">
                            <div class="eskul-detail-label">
                                <i class="bi bi-calendar-event me-2"></i>
                                Jadwal Latihan
                            </div>

                            <div>
                                {{ $eskul->jadwal_latihan ?: '-' }}
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mt-4">
                            <h5 class="eskul-detail-title">
                                Tentang Ekstrakurikuler
                            </h5>

                            <p class="eskul-detail-description mb-0">
                                {{ $eskul->deskripsi ?: 'Belum ada deskripsi ekstrakurikuler.' }}
                            </p>
                        </div>

                        <a href="{{ route('landing') }}#eskul"
                           class="btn btn-success mt-4 px-4">
                            Kembali
                        </a>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection