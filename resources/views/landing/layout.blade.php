<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'SMAN 7 TASIKMALAYA')
    </title>


    {{-- FAVICON --}}
    <link rel="icon"
          href="{{ asset('assets/images/sma7.png') }}">


    {{-- ================================================= --}}
    {{-- BOOTSTRAP CSS --}}
    {{-- ================================================= --}}

    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.min.css') }}">


    {{-- ================================================= --}}
    {{-- BOOTSTRAP ICONS --}}
    {{-- ================================================= --}}

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    {{-- STYLE TAMBAHAN DARI HALAMAN --}}
    @stack('styles')

</head>


<body>


    {{-- ================================================= --}}
    {{-- NAVBAR --}}
    {{-- ================================================= --}}

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">

        <div class="container">


            {{-- LOGO SEKOLAH --}}

            <a class="navbar-brand d-flex align-items-center"
               href="{{ route('landing') }}">

                <img
                    src="{{ asset('assets/images/sma7.png') }}"
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


            {{-- TOMBOL MOBILE --}}

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>


            {{-- MENU NAVBAR --}}

            <div
                class="collapse navbar-collapse"
                id="navbarMenu">


                <ul class="navbar-nav ms-auto align-items-lg-center">


                    {{-- BERANDA --}}

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="#beranda">

                            Beranda

                        </a>

                    </li>


                    {{-- PROFIL --}}

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="#profil">

                            Profil

                        </a>

                    </li>


                    {{-- GURU --}}

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="#guru">

                            Guru

                        </a>

                    </li>


                    {{-- BERITA --}}

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="#berita">

                            Berita

                        </a>

                    </li>


                    {{-- EKSTRAKURIKULER --}}

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="#eskul">

                            Ekstrakurikuler

                        </a>

                    </li>


                    {{-- GALERI --}}

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="#galeri">

                            Galeri

                        </a>

                    </li>


                    {{-- LOGIN ADMIN --}}

                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">

                        <a
                            href="{{ route('login') }}"
                            class="btn btn-success px-3">

                            <i class="bi bi-box-arrow-in-right me-1"></i>

                            Login Admin

                        </a>

                    </li>


                </ul>

            </div>

        </div>

    </nav>



    {{-- ================================================= --}}
    {{-- ISI HALAMAN --}}
    {{-- ================================================= --}}

    @yield('content')



    {{-- ================================================= --}}
    {{-- FOOTER --}}
    {{-- ================================================= --}}

    <footer class="bg-dark text-white mt-5">


        <div class="container py-5">


            <div class="row g-4">


                {{-- INFORMASI SEKOLAH --}}

                <div class="col-md-6">

                    <h5 class="fw-bold">

                        {{ $profil->nama_sekolah ?? 'SMAN 7 TASIKMALAYA' }}

                    </h5>


                    <p class="text-white-50 mb-0">

                        {{ $profil->deskripsi
                            ?? 'Membangun generasi unggul, berkarakter, dan berprestasi.' }}

                    </p>

                </div>


                {{-- KONTAK --}}

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


        {{-- COPYRIGHT --}}

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


    {{-- SCRIPT TAMBAHAN DARI HALAMAN --}}
    @stack('scripts')


</body>
</html>