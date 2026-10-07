@extends('landing.layout')

@section('title', 'Biodata Guru - ' . $guru->nama_guru)

@push('styles')
<style>
    .guru-detail {
        padding: 80px 0;
    }

    .guru-card-detail {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 5px 25px rgba(0,0,0,.08);
    }

    .guru-detail-img {
        width: 280px;
        height: 350px;
        object-fit: cover;
        border-radius: 15px;
    }

    .guru-detail-info {
        background: #f7fbf8;
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 15px;
    }

    @media(max-width:768px) {
        .guru-card-detail {
            padding: 25px;
        }

        .guru-detail-img {
            width: 220px;
            height: 280px;
        }
    }
</style>
@endpush

@section('content')

<section class="guru-detail">

    <div class="container">

        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-outline-success">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali
            </a>
        </div>

        <div class="guru-card-detail">

            <div class="row align-items-center g-5">

                <div class="col-md-5 text-center">

                    @if($guru->foto)

                        <img
                            src="{{ asset('storage/' . $guru->foto) }}"
                            alt="{{ $guru->nama_guru }}"
                            class="guru-detail-img"
                        >

                    @else

                        <div
                            class="d-flex align-items-center justify-content-center bg-light mx-auto"
                            style="width:280px;height:350px;border-radius:15px"
                        >
                            <i class="bi bi-person-circle fs-1 text-secondary"></i>
                        </div>

                    @endif

                </div>

                <div class="col-md-7">

                    <span class="text-success fw-bold">
                        TENAGA PENDIDIK
                    </span>

                    <h1 class="fw-bold mt-2">
                        {{ $guru->nama_guru }}
                    </h1>

                    <p class="text-muted mb-4">
                        Biodata dan informasi tenaga pendidik
                        SMAN 7 TASIKMALAYA.
                    </p>

                    <div class="guru-detail-info">
                        <small class="text-muted">
                            Nama Guru
                        </small>

                        <div class="fw-bold">
                            {{ $guru->nama_guru ?? '-' }}
                        </div>
                    </div>

                    <div class="guru-detail-info">
                        <small class="text-muted">
                            NIP
                        </small>

                        <div class="fw-bold">
                            {{ $guru->nip ?? '-' }}
                        </div>
                    </div>

                    <div class="guru-detail-info">
                        <small class="text-muted">
                            Mata Pelajaran
                        </small>

                        <div class="fw-bold">
                            {{ $guru->mapel ?? '-' }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection