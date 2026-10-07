<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Judul tab browser --}}
    <title>@yield('title', 'SMAN 7 TASIKMALAYA')</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('assets/images/logo sekolah.jpg') }}">

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.min.css') }}">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- CSS tambahan dari halaman --}}
    @stack('styles')

    <style>
        /* Menu yang sedang aktif */
        .navbar .nav-link.active {
            color: #198754 !important;
            font-weight: 600;
            border-bottom: 2px solid #198754;
        }

        /* Menghilangkan garis bawah pada tampilan HP */
        @media (max-width: 991.98px) {
            .navbar .nav-link.active {
                border-bottom: none;
            }
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbarMenu" data-bs-offset="100" tabindex="0">

    {{-- ================================================= --}}
    {{-- NAVBAR --}}
    {{-- ================================================= --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">

            {{-- Logo dan nama sekolah --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ route('landing') }}">
                <img
                    src="{{ asset('assets/images/logo sekolah.jpg') }}"
                    width="45"
                    height="45"
                    class="me-2"
                    alt="Logo Sekolah">

                <div>
                    <div class="fw-bold text-success">
                        {{ $profil->nama_sekolah ?? 'SMAN 7 TASIKMALAYA' }}
                    </div>
                    <small class="text-muted">
                        Sekolah Menengah Atas
                    </small>
                </div>
            </a>

            {{-- Tombol hamburger responsive --}}
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Buka menu navigasi">
                <i class="bi bi-list fs-3"></i>
            </button>

            {{-- Menu navbar --}}
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    {{-- Beranda --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">
                            Beranda
                        </a>
                    </li>

                    {{-- Profil --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#profil">
                            Profil
                        </a>
                    </li>

                    {{-- Guru --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#guru">
                            Guru
                        </a>
                    </li>

                    {{-- Siswa --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#siswa">
                            Siswa
                        </a>
                    </li> --}}

                    {{-- Berita --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#berita">
                            Berita
                        </a>
                    </li>

                    {{-- Ekstrakurikuler --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#eskul">
                            Ekstrakurikuler
                        </a>
                    </li>

                    {{-- Galeri --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#galeri">
                            Galeri
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    {{-- ================================================= --}}
    {{-- ISI HALAMAN --}}
    {{-- ================================================= --}}

    {{-- 
        @yield('content') digunakan untuk menampilkan
        isi dari halaman yang menggunakan layout ini.
        
        
        Contohnya landing/index.blade.php menggunakan:
        @section('content')
    --}}
    @yield('content')

    {{-- ================================================= --}}
    {{-- FOOTER --}}
    {{-- ================================================= --}}
    <footer class="bg-dark text-white mt-5">
        <div class="container py-5">
            <div class="row g-4">

                {{-- Informasi sekolah --}}
                <div class="col-md-6">
                    <h5 class="fw-bold">
                        {{ $profil->nama_sekolah ?? 'SMAN 7 TASIKMALAYA' }}
                    </h5>

                    <p class="text-white-50 mb-0">
                        {{ $profil->deskripsi ?? 'Membangun generasi unggul, berkarakter, dan berprestasi.' }}
                    </p>
                </div>

                {{-- Kontak sekolah --}}
                <div class="col-md-6">
                    <h5 class="fw-bold">
                        Kontak
                    </h5>

                    <p class="text-white-50 mb-2">
                        <i class="bi bi-geo-alt me-2"></i>
                        {{ $profil->alamat ?? '-' }}
                    </p>

                    <p class="text-white-50 mb-0">
                        <i class="bi bi-telephone me-2"></i>
                        {{ $profil->kontak ?? '-' }}
                    </p>
                </div>

            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-top border-secondary">
            <div class="container py-3 text-center text-white-50">
                © {{ date('Y') }}
                {{ $profil->nama_sekolah ?? 'SMAN 7 TASIKMALAYA' }}.
                Semua hak dilindungi.
            </div>
        </div>
    </footer>

    {{-- ================================================= --}}
    {{-- BOOTSTRAP JAVASCRIPT --}}
    {{-- ================================================= --}}
    <script src="{{ asset('assets/landing/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Script tambahan dari halaman --}}
    @stack('scripts')

    {{-- ================================================= --}}
    {{-- SCROLLSPY --}}
    {{-- ================================================= --}}
    <script>
        /*
        ScrollSpy digunakan untuk memberikan class active
        pada menu sesuai section yang sedang dilihat.
        */
        document.addEventListener('DOMContentLoaded', function () {
            new bootstrap.ScrollSpy(document.body, {
                target: '#navbarMenu',
                offset: 100
            });
        });

        /*
        Pada layar HP, setelah menu dipilih,
        navbar otomatis ditutup.
        */
        document.querySelectorAll('#navbarMenu .nav-link').forEach(function (link) {
            link.addEventListener('click', function () {
                const navbar = document.getElementById('navbarMenu');
                const collapse = bootstrap.Collapse.getOrCreateInstance(navbar);
                collapse.hide();
            });
        });
    </script>

</body>
</html>