<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SMAN 7 TASIKMALAYA')</title>

    <link rel="icon" href="{{ $profil && $profil->logo ? asset('storage/' . $profil->logo) : asset('assets/images/logo sekolah.jpg') }}">

    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @stack('styles')

    <style>
        .navbar .nav-link.active {
            color: #198754 !important;
            font-weight: 600;
            border-bottom: 2px solid #198754;
        }

        @media (max-width: 991.98px) {
            .navbar .nav-link.active {
                border-bottom: none;
            }
        }
    </style>
</head>

<body
    data-bs-spy="scroll"
    data-bs-target="#navbarMenu"
    data-bs-offset="100"
    tabindex="0"
>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">

            <a
                class="navbar-brand d-flex align-items-center"
                href="{{ route('landing') }}"
            >

                <img
                    src="{{ $profil && $profil->logo
                        ? asset('storage/' . $profil->logo)
                        : asset('assets/images/logo sekolah.jpg') }}"
                    width="45"
                    height="45"
                    class="me-2"
                    alt="Logo Sekolah"
                    style="object-fit: cover;"
                >

                <div>
                    <div class="fw-bold text-success">
                        {{ $profil->nama_sekolah ?? 'SMAN 7 TASIKMALAYA' }}
                    </div>

                    <small class="text-muted">
                        Sekolah Menengah Atas
                    </small>
                </div>

            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Buka menu navigasi"
            >
                <i class="bi bi-list fs-3"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">
                            Beranda
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#profil">
                            Profil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#guru">
                            Guru
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#berita">
                            Berita
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#eskul">
                            Ekstrakurikuler
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#galeri">
                            Galeri
                        </a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>

    @yield('content')

    <footer class="bg-dark text-white mt-5">

        <div class="container py-5">

            <div class="row g-4">

                <div class="col-md-6">

                    <h5 class="fw-bold">
                        {{ $profil->nama_sekolah ?? 'SMAN 7 TASIKMALAYA' }}
                    </h5>

                    <p class="text-white-50 mb-0">
                        {{ $profil->deskripsi ?? 'Membangun generasi unggul, berkarakter, dan berprestasi.' }}
                    </p>

                </div>

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

        <div class="border-top border-secondary">

            <div class="container py-3 text-center text-white-50">

                © {{ date('Y') }}

                {{ $profil->nama_sekolah ?? 'SMAN 7 TASIKMALAYA' }}.

                Semua hak dilindungi.

            </div>

        </div>

    </footer>

    <script src="{{ asset('assets/landing/js/bootstrap.bundle.min.js') }}"></script>

    @stack('scripts')

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {

            new bootstrap.ScrollSpy(document.body, {
                target: '#navbarMenu',
                offset: 100
            });

            document
                .querySelectorAll('#navbarMenu .nav-link')
                .forEach(function (link) {

                    link.addEventListener('click', function () {

                        const navbar =
                            document.getElementById('navbarMenu');

                        const collapse =
                            bootstrap.Collapse.getOrCreateInstance(navbar);

                        collapse.hide();

                    });

                });

        });
    </script> --}}

</body>
</html>