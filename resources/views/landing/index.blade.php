@extends('landing.layout')

@section('title', 'SMAN 7 TASIKMALAYA')

@php
    $heroImage = ($profil && $profil->foto)
        ? asset('storage/' . $profil->foto)
        : asset('assets/images/logo sekolah.jpg');
@endphp

@push('styles')
<style>
    body {
        background: #ffffff;
    }

    .hero {
        min-height: 620px;
        background:
            linear-gradient(
                rgba(24, 57, 43, .82),
                rgba(24, 57, 43, .82)
            ),
            url('{{ $heroImage }}');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        color: white;
    }

    .hero-content {
        max-width: 800px;
    }

    .hero-content h1 {
        font-size: 55px;
        font-weight: 700;
    }

    .hero-content p {
        font-size: 18px;
        color: #e5eee8;
        margin-top: 20px;
    }

    .section-padding {
        padding: 80px 0;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title span {
        color: #198754;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .section-title h2 {
        font-weight: 700;
        margin-top: 8px;
    }

    .section-title p {
        color: #6c757d;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,.06);
        height: 100%;
    }

    .stat-card i {
        font-size: 35px;
        color: #198754;
    }

    .stat-card h3 {
        margin-top: 10px;
        font-weight: 700;
    }

    .profile-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 18px;
    }

    .teacher-card,
    .news-card,
    .eskul-card,
    .siswa-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,.06);
        height: 100%;
    }

    .teacher-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .teacher-card {
        transition: .3s;
    }

    .teacher-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,.12);
    }

    .teacher-card img {
        width: 100%;
        height: 260px;
        object-fit: cover;
    }

    .news-image-link {
        display: block;
        text-decoration: none;
        overflow: hidden;
    }

    .news-image-link img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        cursor: pointer;
        transition: .3s;
    }

    .news-image-link:hover img {
        transform: scale(1.03);
    }

    /* LINK FOTO EKSTRAKURIKULER */
    .eskul-image-link {
        display: block;
        overflow: hidden;
        text-decoration: none;
        cursor: pointer;
    }

    /* GAMBAR EKSTRAKURIKULER */
    .eskul-card img {
        display: block;
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: .3s;
    }

    /* EFEK SAAT FOTO EKSTRAKURIKULER DISOROT */
    .eskul-image-link:hover img {
        transform: scale(1.04);
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
    }

    .gallery-item img,
    .gallery-item video {
        width: 100%;
        height: 230px;
        object-fit: cover;
    }

    .gallery-title {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 35px 15px 15px;
        color: white;
        background:
            linear-gradient(
                transparent,
                rgba(0,0,0,.8)
            );
    }

    .vision-box {
        background: #f3f8f5;
        border-radius: 18px;
        padding: 35px;
    }

    @media (max-width: 768px) {
        .hero {
            min-height: 500px;
        }

        .hero-content h1 {
            font-size: 38px;
        }

        .profile-image {
            height: 280px;
        }
    }
</style>
@endpush

@section('content')

{{-- ================= HERO ================= --}}
<section class="hero" id="beranda">
    <div class="container">
        <div class="hero-content">

            <span class="badge bg-success px-3 py-2">
                SELAMAT DATANG DISEKOLAH KAMI
            </span>

            <h1 class="mt-3">
                {{ $profil->nama_sekolah ?? 'SMAN 7 TASIKMALAYA' }}
            </h1>

            <p>
                {{ $profil->deskripsi ?? 'Membangun generasi unggul, berkarakter, dan berprestasi.' }}
            </p>

            {{-- <div class="mt-4">
                <a href="#profil" class="btn btn-success btn-lg me-2">
                    Lihat Profil
                </a>

                <a href="#berita" class="btn btn-outline-light btn-lg">
                    Berita Sekolah
                </a>
            </div> --}}

        </div>
    </div>
</section>

{{-- ================= STATISTIK ================= --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-people-fill"></i>
                    <h3>{{ $jumlahSiswa }}</h3>
                    <p class="text-muted mb-0">Siswa</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-person-workspace"></i>
                    <h3>{{ \App\Models\Guru::count() }}</h3>
                    <p class="text-muted mb-0">Guru</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-trophy-fill"></i>
                    <h3>{{ \App\Models\Ekstrakulikuler::count() }}</h3>
                    <p class="text-muted mb-0">Ekstrakurikuler</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-calendar-event"></i>
                    <h3>{{ $profil->tahun_berdiri ?? '-' }}</h3>
                    <p class="text-muted mb-0">Tahun Berdiri</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ================= PROFIL SEKOLAH ================= --}}
<section class="section-padding" id="profil">
    <div class="container">

        <div class="section-title">
            <span>PROFIL SEKOLAH</span>
            <h2>Mengenal Sekolah Kami</h2>
            <p>Informasi mengenai sekolah.</p>
        </div>

        <div class="row align-items-center g-5">

            <div class="col-md-6">
                <img
                    src="{{ $profil && $profil->foto ? asset('storage/' . $profil->foto) : asset('assets/images/sma7.png') }}"
                    class="profile-image"
                    alt="Profil Sekolah">
            </div>

            <div class="col-md-6">

                <h3 class="fw-bold">
                    {{ $profil->nama_sekolah ?? 'SMAN 7 TASIKMALAYA' }}
                </h3>

                <p class="text-muted mt-3">
                    {{ $profil->deskripsi ?? '-' }}
                </p>

                <div class="row g-3 mt-3">

                    <div class="col-6">
                        <div class="bg-light rounded p-3">
                            <small class="text-muted">Kepala Sekolah</small>
                            <div class="fw-bold">
                                {{ $profil->kepala_sekolah ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="bg-light rounded p-3">
                            <small class="text-muted">NPSN</small>
                            <div class="fw-bold">
                                {{ $profil->npsn ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="bg-light rounded p-3">
                            <small class="text-muted">Alamat</small>
                            <div class="fw-bold">
                                {{ $profil->alamat ?? '-' }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

{{-- ================= VISI DAN MISI ================= --}}
<section class="section-padding bg-light">
    <div class="container">

        <div class="section-title">
            <span>VISI & MISI</span>
            <h2>Arah Pendidikan Sekolah</h2>
        </div>

        <div class="vision-box">
            <div class="d-flex gap-4">

                <i class="bi bi-bullseye fs-1 text-success"></i>

                <div>
                    <h4 class="fw-bold">Visi & Misi</h4>

                    <p class="text-muted mb-0">
                        {{ $profil->visi_misi ?? '-' }}
                    </p>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- ================= GURU ================= --}}
<section class="section-padding" id="guru">
    <div class="container">

        <div class="section-title">
            <span>TENAGA PENDIDIK</span>
            <h2>Guru Kami</h2>
            <p>Tenaga pendidik sekolah.</p>
        </div>

        <div class="row g-4">

            @forelse($guru as $item)

                <div class="col-md-3 guru-item {{ $loop->iteration > 4 ? 'guru-extra d-none' : '' }}">

                    <a
                        href="{{ route('landing.guru.detail', $item->slug) }}"class="teacher-link">

                        <div class="teacher-card bg-white">

                            @if($item->foto)

                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama_guru }}">

                            @else

                                <div
                                    class="d-flex align-items-center justify-content-center bg-light"
                                    style="height:260px"
                                >
                                    <i class="bi bi-person fs-1 text-secondary"></i>
                                </div>

                            @endif

                            <div class="p-3">

                                <h5 class="fw-bold">
                                    {{ $item->nama_guru }}
                                </h5>

                                <p class="text-success mb-1">
                                    {{ $item->mapel ?? '-' }}
                                </p>

                                <small class="text-muted">
                                    NIP: {{ $item->nip ?? '-' }}
                                </small>

                            </div>

                        </div>

                    </a>

                </div>

            @empty

                <div class="col-12 text-center text-muted">
                    Belum ada data guru.
                </div>

            @endforelse

        </div>

        @if($guru->count() > 4)

            <div class="text-center mt-5">

                <button
                    type="button"
                    id="btnLihatGuru"
                    class="btn btn-success px-4"
                >
                    <i class="bi bi-people me-2"></i>
                    Lihat Semua Data Guru
                </button>

            </div>

        @endif

    </div>
</section>

{{-- ================= BERITA ================= --}}
<section class="section-padding" id="berita">
    <div class="container">

        <div class="section-title">
            <span>INFORMASI</span>
            <h2>Berita Terbaru</h2>
            <p>Informasi terbaru sekolah.</p>
        </div>

        <div class="row g-4">

            @forelse($berita as $item)

                <div class="col-md-4 berita-item {{ $loop->iteration > 3 ? 'berita-extra d-none' : '' }}">

                    <div class="news-card bg-white">

                        <a
                            href="{{ route('landing.berita.detail', \Illuminate\Support\Facades\Crypt::encryptString((string) $item->id_berita)) }}"
                            class="news-image-link"
                        >

                            @if($item->gambar)

                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    alt="{{ $item->judul }}">

                            @else

                                <div
                                    class="d-flex align-items-center justify-content-center bg-light"
                                    style="height:220px"
                                >
                                    <i class="bi bi-newspaper fs-1 text-secondary"></i>
                                </div>

                            @endif

                        </a>

                        <div class="p-4">

                            @if($item->tanggal)

                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </small>

                            @endif

                            <h5 class="fw-bold mt-2">
                                {{ $item->judul }}
                            </h5>

                            <p class="text-muted small">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->isi ?? ''), 120) }}
                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center text-muted">
                    Belum ada berita.
                </div>

            @endforelse

        </div>

        @if($berita->count() > 3)

            <div class="text-center mt-5">

                <button
                    type="button"
                    id="btnLihatBerita"
                    class="btn btn-success px-4"
                >
                    <i class="bi bi-newspaper me-2"></i>
                    Lihat Semua Data Berita
                </button>

            </div>

        @endif

    </div>
</section>

{{-- ================= EKSTRAKURIKULER ================= --}}
<section class="section-padding bg-light" id="eskul">
    <div class="container">

        <div class="section-title">
            <span>KEGIATAN SISWA</span>
            <h2>Ekstrakurikuler</h2>
            <p>Kegiatan untuk mengembangkan bakat dan minat siswa.</p>
        </div>

        <div class="row g-4">

            {{-- MENAMPILKAN 3 EKSTRAKURIKULER PERTAMA --}}
            @forelse($eskul->take(3) as $item)

                <div class="col-md-4">
                    <div class="eskul-card bg-white">

                        {{-- FOTO ESKUL BISA DIKLIK --}}
                        <a
                            href="{{ route('landing.eskul.detail', $item->id_ekskul) }}"
                            class="eskul-image-link"
                            title="Lihat biodata {{ $item->nama_ekskul }}"
                        >

                            @if($item->gambar)

                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    alt="{{ $item->nama_ekskul }}">

                            @else

                                <div
                                    class="d-flex align-items-center justify-content-center bg-light"
                                    style="height:220px"
                                >
                                    <i class="bi bi-trophy fs-1 text-secondary"></i>
                                </div>

                            @endif

                        </a>

                        {{-- INFORMASI SINGKAT ESKUL --}}
                        <div class="p-4">

                            <h5 class="fw-bold">
                                {{ $item->nama_ekskul }}
                            </h5>

                            <p class="text-muted">
                                {{ \Illuminate\Support\Str::limit($item->deskripsi ?? '', 100) }}
                            </p>

                            <small class="text-success">
                                <i class="bi bi-person me-1"></i>
                                {{ $item->pembina ?? '-' }}
                            </small>

                        </div>

                    </div>
                </div>

            @empty

                <div class="col-12 text-center text-muted">
                    Belum ada data ekstrakurikuler.
                </div>

            @endforelse

        </div>

        {{-- MENAMPILKAN EKSTRAKURIKULER TAMBAHAN --}}
        @if($eskul->count() > 3)

            <div class="collapse mt-4" id="eskulTambahan">
                <div class="row g-4">

                    @foreach($eskul->slice(3) as $item)

                        <div class="col-md-4">
                            <div class="eskul-card bg-white">

                                {{-- FOTO ESKUL TAMBAHAN BISA DIKLIK --}}
                                <a
                                    href="{{ route('landing.eskul.detail', $item->id_ekskul) }}"
                                    class="eskul-image-link"
                                    title="Lihat biodata {{ $item->nama_ekskul }}"
                                >

                                    @if($item->gambar)

                                        <img
                                            src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="{{ $item->nama_ekskul }}">

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center bg-light"
                                            style="height:220px"
                                        >
                                            <i class="bi bi-trophy fs-1 text-secondary"></i>
                                        </div>

                                    @endif

                                </a>

                                {{-- INFORMASI SINGKAT ESKUL --}}
                                <div class="p-4">

                                    <h5 class="fw-bold">
                                        {{ $item->nama_ekskul }}
                                    </h5>

                                    <p class="text-muted">
                                        {{ \Illuminate\Support\Str::limit($item->deskripsi ?? '', 100) }}
                                    </p>

                                    <small class="text-success">
                                        <i class="bi bi-person me-1"></i>
                                        {{ $item->pembina ?? '-' }}
                                    </small>

                                </div>

                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

            {{-- TOMBOL LIHAT SEMUA --}}
            <div class="text-center mt-5">

                <button
                    type="button"
                    class="btn btn-success px-4"
                    data-bs-toggle="collapse"
                    data-bs-target="#eskulTambahan"
                    aria-expanded="false"
                    aria-controls="eskulTambahan"
                >
                    <i class="bi bi-trophy me-2"></i>
                    Lihat Semua Data Ekstrakurikuler
                </button>

            </div>

        @endif

    </div>
</section>

{{-- ================= GALERI SEKOLAH ================= --}}
<section class="section-padding" id="galeri">
    <div class="container">

        <div class="section-title">
            <span>DOKUMENTASI</span>
            <h2>Galeri Sekolah</h2>
            <p>Dokumentasi kegiatan sekolah.</p>
        </div>

        <div class="row g-3">

            @forelse($galeri as $item)

                <div class="col-md-4 galeri-item {{ $loop->iteration > 6 ? 'galeri-extra d-none' : '' }}">

                    {{-- LINK KE HALAMAN DETAIL --}}
                    <a
                        href="{{ route('landing.galeri.detail', $item->id_galeri) }}"
                        class="gallery-detail-link"
                        title="Lihat detail {{ $item->judul }}"
                    >

                        <div class="gallery-item">

                            {{-- MEDIA GALERI --}}
                            @if($item->kategori === 'Foto')

                                <img
                                    src="{{ asset('storage/' . $item->file) }}"
                                    alt="{{ $item->judul }}"
                                    loading="lazy"
                                >

                            @else

                                <video
                                    muted
                                    playsinline
                                    preload="metadata"
                                    aria-label="{{ $item->judul }}"
                                >
                                    <source src="{{ asset('storage/' . $item->file) }}">

                                    Browser tidak mendukung video.
                                </video>

                            @endif

                            {{-- JUDUL DAN KATEGORI --}}
                            <div class="gallery-title">

                                <h6 class="mb-1">
                                    {{ $item->judul }}
                                </h6>

                                <small>
                                    <i class="bi {{ $item->kategori === 'Foto' ? 'bi-image' : 'bi-camera-video' }} me-1"></i>
                                    {{ $item->kategori }}
                                </small>

                                <div class="small mt-2">
                                    <i class="bi bi-eye me-1"></i>
                                    Lihat Detail
                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            @empty

                <div class="col-12 text-center text-muted">
                    Belum ada data galeri.
                </div>

            @endforelse

        </div>

        {{-- TOMBOL LIHAT SEMUA --}}
        @if($galeri->count() > 6)

            <div class="text-center mt-5">

                <button
                    type="button"
                    id="btnLihatGaleri"
                    class="btn btn-success px-4"
                >
                    <i class="bi bi-images me-2"></i>
                    Lihat Semua Data Galeri
                </button>

            </div>

        @endif

    </div>
</section>

{{-- ================= PENUTUP ================= --}}
<section class="py-5 bg-success text-white">
    <div class="container text-center">

        <h2 class="fw-bold">
            Mari Menjadi Bagian dari Sekolah Kami
        </h2>

        <p class="mb-4">
            Bersama membangun generasi unggul,
            berkarakter, dan berprestasi.
        </p>

        <a href="#profil" class="btn btn-light px-4">
            Tentang Sekolah
        </a>

    </div>
</section>

@endsection

{{-- ================= JAVASCRIPT ================= --}}
@push('scripts')
<script>
    function setupLihatSemua(
        buttonId,
        itemClass,
        textShow,
        textHide,
        iconShow,
        iconHide
    ) {
        const button = document.getElementById(buttonId);

        if (!button) {
            return;
        }

        button.addEventListener('click', function () {

            const items = document.querySelectorAll('.' + itemClass);

            items.forEach(function (item) {
                item.classList.toggle('d-none');
            });

            const sedangTampil =
                items.length > 0 &&
                !items[0].classList.contains('d-none');

            this.innerHTML = sedangTampil
                ? '<i class="' + iconHide + ' me-2"></i>' + textHide
                : '<i class="' + iconShow + ' me-2"></i>' + textShow;
        });
    }

    setupLihatSemua(
        'btnLihatGuru',
        'guru-extra',
        'Lihat Semua Data Guru',
        'Sembunyikan Data Guru',
        'bi bi-people',
        'bi bi-chevron-up'
    );

    setupLihatSemua(
        'btnLihatBerita',
        'berita-extra',
        'Lihat Semua Data Berita',
        'Sembunyikan Data Berita',
        'bi bi-newspaper',
        'bi bi-chevron-up'
    );

    setupLihatSemua(
        'btnLihatGaleri',
        'galeri-extra',
        'Lihat Semua Data Galeri',
        'Sembunyikan Data Galeri',
        'bi bi-images',
        'bi bi-chevron-up'
    );
</script>
@endpush