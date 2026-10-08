@extends('landing.layout')

@section('title', $berita->judul)

@push('styles')
<style>
    .detail-berita {
        padding: 80px 0;
    }

    .detail-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, .08);
    }

    .detail-berita-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
    }

    .detail-berita-content {
        padding: 40px;
    }

    .detail-berita-title {
        font-size: 38px;
        font-weight: 700;
        margin: 15px 0;
    }

    .detail-berita-date {
        color: #198754;
        font-size: 14px;
    }

    .detail-berita-text {
        color: #555;
        line-height: 1.8;
        font-size: 17px;
    }

    .btn-kembali {
        margin-bottom: 25px;
    }

    @media (max-width: 768px) {
        .detail-berita {
            padding: 50px 0;
        }

        .detail-berita-content {
            padding: 25px;
        }

        .detail-berita-title {
            font-size: 28px;
        }
    }
</style>
@endpush

@section('content')

<section class="detail-berita">
    <div class="container">

        <a
            href="{{ route('landing') }}#berita"
            class="btn btn-success btn-kembali"
        >
            <i class="bi bi-arrow-left me-2"></i>
            Kembali ke Berita
        </a>

        <div class="detail-card">

            @if($berita->gambar)
                <img
                    src="{{ asset('storage/' . $berita->gambar) }}"
                    alt="{{ $berita->judul }}"
                    class="detail-berita-image">
            @endif

            <div class="detail-berita-content">

                @if($berita->tanggal)
                    <div class="detail-berita-date">
                        <i class="bi bi-calendar3 me-2"></i>
                        {{ \Carbon\Carbon::parse($berita->tanggal)->format('d-m-Y') }}
                    </div>
                @endif

                <h1 class="detail-berita-title">
                    {{ $berita->judul }}
                </h1>

                <div class="detail-berita-text">
                    {!! $berita->isi !!}
                </div>

            </div>

        </div>

    </div>
</section>

@endsection