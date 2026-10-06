{{-- ========================================================= --}}
{{-- MENGGUNAKAN LAYOUT LANDING --}}
{{-- ========================================================= --}}

{{-- 
    @extends digunakan untuk menggunakan layout utama landing.
    File layout berada di:
    resources/views/landing/layout.blade.php
--}}
@extends('landing.layout')


{{-- 
    Menentukan judul halaman pada tab browser.
--}}
@section('title', 'SMAN 7 TASIKMALAYA')



{{-- ========================================================= --}}
{{-- MENENTUKAN GAMBAR HERO --}}
{{-- ========================================================= --}}

@php

    /*
        Menentukan gambar yang digunakan pada background hero.

        Jika profil memiliki foto:
        gunakan foto profil.

        Jika tidak memiliki foto:
        gunakan logo sekolah.
    */
    $heroImage = ($profil && $profil->foto)
        ? asset('storage/' . $profil->foto)
        : asset('assets/images/sma7.png');

@endphp



{{-- ========================================================= --}}
{{-- CSS KHUSUS LANDING PAGE --}}
{{-- ========================================================= --}}

@push('styles')

<style>

    /*
    =========================================================
    BODY
    =========================================================

    Mengatur background dasar halaman.
    */

    body {
        background: #ffffff;
    }



    /*
    =========================================================
    HERO
    =========================================================

    Hero adalah bagian utama paling atas halaman.
    */

    .hero {

        /*
        Tinggi minimal hero adalah 620px.
        */
        min-height: 620px;


        /*
        Background terdiri dari:

        1. linear-gradient()
           = lapisan warna hijau transparan.

        2. url($heroImage)
           = gambar profil sekolah.

        Lapisan hijau dibuat transparan supaya
        tulisan tetap mudah dibaca.
        */

        background:
            linear-gradient(
                rgba(24, 57, 43, .82),
                rgba(24, 57, 43, .82)
            ),
            url('{{ $heroImage }}');


        /*
        cover membuat gambar memenuhi seluruh area.
        */
        background-size: cover;


        /*
        Posisi gambar berada di tengah.
        */
        background-position: center;


        /*
        Menggunakan flexbox.
        */
        display: flex;


        /*
        Isi hero berada di tengah secara vertikal.
        */
        align-items: center;


        /*
        Warna tulisan menjadi putih.
        */
        color: white;
    }



    /*
    Membatasi lebar isi hero.
    */
    .hero-content {
        max-width: 800px;
    }



    /*
    Ukuran judul utama hero.
    */
    .hero-content h1 {
        font-size: 55px;
        font-weight: 700;
    }



    /*
    Ukuran dan warna deskripsi hero.
    */
    .hero-content p {
        font-size: 18px;
        color: #e5eee8;
        margin-top: 20px;
    }



    /*
    =========================================================
    SECTION
    =========================================================

    Memberikan jarak atas dan bawah
    pada setiap bagian halaman.
    */

    .section-padding {
        padding: 80px 0;
    }



    /*
    Judul setiap section dibuat berada di tengah.
    */
    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }



    /*
    Tulisan kecil di atas judul section.
    */
    .section-title span {
        color: #198754;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 2px;
    }



    /*
    Judul utama section.
    */
    .section-title h2 {
        font-weight: 700;
        margin-top: 8px;
    }



    /*
    Deskripsi section.
    */
    .section-title p {
        color: #6c757d;
    }



    /*
    =========================================================
    STATISTIK
    =========================================================

    Card statistik digunakan untuk:
    - jumlah siswa
    - jumlah guru
    - jumlah eskul
    - tahun berdiri
    */

    .stat-card {

        background: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;


        /*
        Memberikan bayangan pada card.
        */

        box-shadow:
            0 5px 20px rgba(0,0,0,.06);


        /*
        Agar tinggi card sama.
        */

        height: 100%;
    }



    /*
    Icon statistik.
    */

    .stat-card i {
        font-size: 35px;
        color: #198754;
    }



    /*
    Angka statistik dibuat lebih besar.
    */

    .stat-card h3 {
        margin-top: 10px;
        font-weight: 700;
    }



    /*
    =========================================================
    FOTO PROFIL
    =========================================================
    */

    .profile-image {

        width: 100%;
        height: 400px;

        /*
        Gambar memenuhi ukuran tanpa merusak proporsi.
        */
        object-fit: cover;
        border-radius: 18px;
    }



    /*
    =========================================================
    CARD
    =========================================================

    Digunakan untuk:
    - guru
    - siswa
    - berita
    - ekstrakurikuler
    */

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



    /*
    Foto guru.
    */

    .teacher-card img {

        width: 100%;
        height: 260px;
        object-fit: cover;
    }



    /*
    Gambar berita.
    */

    .news-card img {

        width: 100%;
        height: 220px;
        object-fit: cover;
    }



    /*
    Gambar ekstrakurikuler.
    */

    .eskul-card img {

        width: 100%;
        height: 220px;
        object-fit: cover;
    }



    /*
    =========================================================
    GALERI
    =========================================================
    */

    .gallery-item {

        position: relative;
        overflow: hidden;
        border-radius: 15px;
    }



    /*
    Ukuran gambar dan video galeri.
    */

    .gallery-item img,.gallery-item video {

        width: 100%;
        height: 230px;
        object-fit: cover;
    }



    /*
    Informasi galeri berada di bagian bawah gambar.
    */

    .gallery-title {

        position: absolute;

        left: 0;
        right: 0;
        bottom: 0;
        padding: 35px 15px 15px;
        color: white;


        /*
        Gradient membuat bagian bawah gambar
        menjadi lebih gelap sehingga tulisan mudah dibaca.
        */

        background:
            linear-gradient(
                transparent,
                rgba(0,0,0,.8)
            );
    }



    /*
    =========================================================
    VISI MISI
    =========================================================
    */

    .vision-box {

        background: #f3f8f5;
        border-radius: 18px;
        padding: 35px;
    }



    /*
    =========================================================
    RESPONSIVE
    =========================================================
    */

    @media (max-width: 768px) {


        /*
        Hero menjadi lebih pendek pada HP.
        */

        .hero {
            min-height: 500px;
        }


        /*
        Judul hero diperkecil pada HP.
        */

        .hero-content h1 {
            font-size: 38px;
        }


        /*
        Foto profil diperkecil pada HP.
        */

        .profile-image {
            height: 280px;
        }

    }

</style>

@endpush



{{-- ========================================================= --}}
{{-- ISI UTAMA LANDING PAGE --}}
{{-- ========================================================= --}}

@section('content')



{{-- ================================================== --}}
{{-- 1. HERO --}}
{{-- ================================================== --}}

<section class="hero"
         id="beranda">

    <div class="container">

        <div class="hero-content">


            {{-- Label selamat datang --}}

            <span class="badge bg-success px-3 py-2">

                SELAMAT DATANG

            </span>



            {{-- 
                Menampilkan nama sekolah.

                $profil->nama_sekolah
                = mengambil nama sekolah dari database.

                ??
                = memberikan nilai cadangan jika data kosong.
            --}}

            <h1 class="mt-3">

                {{ $profil->nama_sekolah
                    ?? 'SMAN 7 TASIKMALAYA' }}

            </h1>



            {{-- 
                Menampilkan deskripsi sekolah
                dari database.
            --}}

            <p>

                {{ $profil->deskripsi
                    ?? 'Membangun generasi unggul, berkarakter, dan berprestasi.' }}

            </p>



            {{-- TOMBOL NAVIGASI --}}

            <div class="mt-4">


                {{-- 
                    href="#profil"
                    digunakan untuk menuju section
                    yang mempunyai id="profil".
                --}}

                <a href="#profil"
                   class="btn btn-success btn-lg me-2">

                    Lihat Profil

                </a>



                {{-- 
                    Tombol menuju section berita.
                --}}

                <a href="#berita"
                   class="btn btn-outline-light btn-lg">

                    Berita Sekolah

                </a>


            </div>

        </div>

    </div>

</section>



{{-- ================================================== --}}
{{-- 2. STATISTIK --}}
{{-- ================================================== --}}

<section class="py-5 bg-light">

    <div class="container">

        <div class="row g-4">


            {{-- ================================================= --}}
            {{-- JUMLAH SISWA --}}
            {{-- ================================================= --}}

            <div class="col-md-3">

                <div class="stat-card">

                    <i class="bi bi-people-fill"></i>


                    {{-- 
                        $jumlahSiswa berasal dari controller.

                        Controller menghitung jumlah siswa
                        menggunakan count().
                    --}}

                    <h3>

                        {{ $jumlahSiswa }}

                    </h3>


                    <p class="text-muted mb-0">

                        Siswa

                    </p>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- JUMLAH GURU --}}
            {{-- ================================================= --}}

            <div class="col-md-3">

                <div class="stat-card">

                    <i class="bi bi-person-workspace"></i>


                    {{-- 
                        Guru::count()
                        digunakan untuk menghitung
                        jumlah data guru pada database.
                    --}}

                    <h3>

                        {{ \App\Models\Guru::count() }}

                    </h3>


                    <p class="text-muted mb-0">

                        Guru

                    </p>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- JUMLAH ESKUL --}}
            {{-- ================================================= --}}

            <div class="col-md-3">

                <div class="stat-card">

                    <i class="bi bi-trophy-fill"></i>


                    {{-- 
                        Ekstrakulikuler::count()
                        menghitung jumlah data eskul.
                    --}}

                    <h3>

                        {{ \App\Models\Ekstrakulikuler::count() }}

                    </h3>


                    <p class="text-muted mb-0">

                        Ekstrakurikuler

                    </p>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- TAHUN BERDIRI --}}
            {{-- ================================================= --}}

            <div class="col-md-3">

                <div class="stat-card">

                    <i class="bi bi-calendar-event"></i>


                    {{-- 
                        Mengambil tahun berdiri
                        dari tabel profil sekolah.
                    --}}

                    <h3>

                        {{ $profil->tahun_berdiri ?? '-' }}

                    </h3>


                    <p class="text-muted mb-0">

                        Tahun Berdiri

                    </p>

                </div>

            </div>


        </div>

    </div>

</section>



{{-- ================================================== --}}
{{-- 3. PROFIL SEKOLAH --}}
{{-- ================================================== --}}

<section class="section-padding"
         id="profil">

    <div class="container">


        {{-- JUDUL SECTION --}}

        <div class="section-title">

            <span>

                PROFIL SEKOLAH

            </span>


            <h2>

                Mengenal Sekolah Kami

            </h2>


            <p>

                Informasi mengenai sekolah.

            </p>

        </div>



        <div class="row align-items-center g-5">


            {{-- ================================================= --}}
            {{-- FOTO SEKOLAH --}}
            {{-- ================================================= --}}

            <div class="col-md-6">


                {{-- 
                    Kalau ada foto profil:
                    ambil dari storage.

                    Kalau tidak ada:
                    gunakan logo sekolah.
                --}}

                <img
                    src="{{ $profil && $profil->foto
                        ? asset('storage/' . $profil->foto)
                        : asset('assets/images/sma7.png') }}"
                    class="profile-image"
                    alt="Profil Sekolah">

            </div>



            {{-- ================================================= --}}
            {{-- INFORMASI PROFIL --}}
            {{-- ================================================= --}}

            <div class="col-md-6">


                {{-- Nama sekolah --}}

                <h3 class="fw-bold">

                    {{ $profil->nama_sekolah
                        ?? 'SMAN 7 TASIKMALAYA' }}

                </h3>


                {{-- Deskripsi sekolah --}}

                <p class="text-muted mt-3">

                    {{ $profil->deskripsi ?? '-' }}

                </p>



                <div class="row g-3 mt-3">


                    {{-- KEPALA SEKOLAH --}}

                    <div class="col-6">

                        <div class="bg-light rounded p-3">

                            <small class="text-muted">

                                Kepala Sekolah

                            </small>


                            <div class="fw-bold">

                                {{ $profil->kepala_sekolah ?? '-' }}

                            </div>

                        </div>

                    </div>



                    {{-- NPSN --}}

                    <div class="col-6">

                        <div class="bg-light rounded p-3">

                            <small class="text-muted">

                                NPSN

                            </small>


                            <div class="fw-bold">

                                {{ $profil->npsn ?? '-' }}

                            </div>

                        </div>

                    </div>



                    {{-- ALAMAT --}}

                    <div class="col-12">

                        <div class="bg-light rounded p-3">

                            <small class="text-muted">

                                Alamat

                            </small>


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



{{-- ================================================== --}}
{{-- 4. VISI DAN MISI --}}
{{-- ================================================== --}}

<section class="section-padding bg-light">

    <div class="container">


        <div class="section-title">

            <span>

                VISI & MISI

            </span>


            <h2>

                Arah Pendidikan Sekolah

            </h2>

        </div>



        <div class="vision-box">


            <div class="d-flex gap-4">


                {{-- Icon visi dan misi --}}

                <i class="bi bi-bullseye fs-1 text-success"></i>


                <div>


                    <h4 class="fw-bold">

                        Visi & Misi

                    </h4>


                    {{-- 
                        Menampilkan visi dan misi
                        dari database.
                    --}}

                    <p class="text-muted mb-0">

                        {{ $profil->visi_misi ?? '-' }}

                    </p>


                </div>

            </div>

        </div>

    </div>

</section>



{{-- ================================================== --}}
{{-- 5. DATA GURU --}}
{{-- ================================================== --}}

<section class="section-padding"
         id="guru">

    <div class="container">


        <div class="section-title">

            <span>

                TENAGA PENDIDIK

            </span>


            <h2>

                Guru Kami

            </h2>


            <p>

                Tenaga pendidik sekolah.

            </p>

        </div>



        {{-- 
            Semua data guru diambil dari controller.

            Data guru ke-1 sampai ke-4 ditampilkan.

            Data guru ke-5 dan seterusnya
            diberi class d-none sehingga tersembunyi.
        --}}

        <div class="row g-4">


            @forelse($guru as $item)


                <div class="col-md-3 guru-item

                    {{ $loop->iteration > 4
                        ? 'guru-extra d-none'
                        : '' }}">

                    <div class="teacher-card bg-white">


                        {{-- ================================================= --}}
                        {{-- FOTO GURU --}}
                        {{-- ================================================= --}}

                        @if($item->foto)


                            {{-- 
                                asset('storage/...')
                                digunakan untuk mengambil
                                file foto dari folder storage.
                            --}}

                            <img
                                src="{{ asset('storage/' . $item->foto) }}"
                                alt="{{ $item->nama_guru }}">


                        @else


                            {{-- 
                                Jika tidak ada foto,
                                tampilkan icon.
                            --}}

                            <div
                                class="d-flex align-items-center justify-content-center bg-light"
                                style="height:260px">

                                <i class="bi bi-person fs-1 text-secondary"></i>

                            </div>


                        @endif



                        {{-- INFORMASI GURU --}}

                        <div class="p-3">


                            {{-- Nama guru --}}

                            <h5 class="fw-bold">

                                {{ $item->nama_guru }}

                            </h5>


                            {{-- Mata pelajaran --}}

                            <p class="text-success mb-1">

                                {{ $item->mapel ?? '-' }}

                            </p>


                            {{-- NIP --}}

                            <small class="text-muted">

                                NIP: {{ $item->nip ?? '-' }}

                            </small>


                        </div>

                    </div>

                </div>


            @empty


                {{-- 
                    Ditampilkan kalau database guru kosong.
                --}}

                <div class="col-12 text-center text-muted">

                    Belum ada data guru.

                </div>


            @endforelse

        </div>



        {{-- ================================================= --}}
        {{-- TOMBOL LIHAT SEMUA GURU --}}
        {{-- ================================================= --}}


        {{--
            Tombol hanya muncul jika jumlah guru
            lebih dari 4.
        --}}

        @if($guru->count() > 4)


            <div class="text-center mt-5">

                <button
                    type="button"
                    id="btnLihatGuru"
                    class="btn btn-success px-4">


                    <i class="bi bi-people me-2"></i>

                    Lihat Semua Data Guru


                </button>

            </div>


        @endif

    </div>

</section>



{{-- ================================================== --}}
{{-- 6. DATA SISWA --}}
{{-- ================================================== --}}

<section class="section-padding bg-light"
         id="siswa">

    <div class="container">


        <div class="section-title">

            <span>

                PESERTA DIDIK

            </span>


            <h2>

                Siswa Kami

            </h2>


            <p>

                Data peserta didik sekolah.

            </p>

        </div>



        <div class="row g-4">


            {{-- Loop data siswa --}}

            @forelse($siswa as $item)


                {{--
                    6 siswa pertama tampil.

                    Data setelah siswa ke-6
                    disembunyikan menggunakan d-none.
                --}}

                <div class="col-md-4 siswa-item

                    {{ $loop->iteration > 6
                        ? 'siswa-extra d-none'
                        : '' }}">


                    <div class="siswa-card bg-white">


                        <div class="p-4">


                            {{-- Nama siswa --}}

                            <h5 class="fw-bold">

                                {{ $item->nama_siswa }}

                            </h5>


                            {{-- NISN --}}

                            <p class="text-success mb-1">

                                NISN:
                                {{ $item->nisn ?? '-' }}

                            </p>


                            {{-- Jenis kelamin --}}

                            <small class="text-muted d-block">

                                Jenis Kelamin:
                                {{ $item->jenis_kelamin ?? '-' }}

                            </small>


                            {{-- Tahun masuk --}}

                            <small class="text-muted">

                                Tahun Masuk:
                                {{ $item->tahun_masuk ?? '-' }}

                            </small>


                        </div>

                    </div>

                </div>


            @empty


                <div class="col-12 text-center text-muted">

                    Belum ada data siswa.

                </div>


            @endforelse

        </div>



        {{-- TOMBOL SISWA --}}

        @if($siswa->count() > 6)


            <div class="text-center mt-5">

                <button
                    type="button"
                    id="btnLihatSiswa"
                    class="btn btn-success px-4">


                    <i class="bi bi-people me-2"></i>

                    Lihat Semua Data Siswa


                </button>

            </div>


        @endif


    </div>

</section>



{{-- ================================================== --}}
{{-- 7. BERITA --}}
{{-- ================================================== --}}

<section class="section-padding"
         id="berita">

    <div class="container">


        <div class="section-title">

            <span>

                INFORMASI

            </span>


            <h2>

                Berita Terbaru

            </h2>


            <p>

                Informasi terbaru sekolah.

            </p>

        </div>



        <div class="row g-4">


            {{-- Loop data berita --}}

            @forelse($berita as $item)


                {{--
                    3 berita pertama tampil.

                    Berita ke-4 dan seterusnya
                    disembunyikan.
                --}}

                <div class="col-md-4 berita-item

                    {{ $loop->iteration > 3
                        ? 'berita-extra d-none'
                        : '' }}">


                    <div class="news-card bg-white">


                        {{-- ================================================= --}}
                        {{-- GAMBAR BERITA --}}
                        {{-- ================================================= --}}

                        @if($item->gambar)


                            <img
                                src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->judul }}">


                        @else


                            {{-- Placeholder jika gambar tidak ada --}}

                            <div
                                class="d-flex align-items-center justify-content-center bg-light"
                                style="height:220px">

                                <i class="bi bi-newspaper fs-1 text-secondary"></i>

                            </div>


                        @endif



                        <div class="p-4">


                            {{-- ================================================= --}}
                            {{-- TANGGAL BERITA --}}
                            {{-- ================================================= --}}

                            @if($item->tanggal)


                                <small class="text-muted">

                                    <i class="bi bi-calendar3 me-1"></i>


                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}


                                </small>


                            @endif


                            {{--
                                Carbon::parse()
                                = membaca data sebagai tanggal.

                                format('d-m-Y')
                                = mengubah tampilan menjadi:

                                d = hari
                                m = bulan
                                Y = tahun 4 digit

                                Contoh:

                                2026-10-05
                                menjadi
                                05-10-2026
                            --}}



                            {{-- JUDUL BERITA --}}

                            <h5 class="fw-bold mt-2">

                                {{ $item->judul }}

                            </h5>



                            {{-- ================================================= --}}
                            {{-- PREVIEW BERITA --}}
                            {{-- ================================================= --}}

                            <p class="text-muted small">


                                {{ \Illuminate\Support\Str::limit(

                                    strip_tags($item->isi ?? ''),

                                    120

                                ) }}


                            </p>


                            {{--
                                strip_tags()
                                = menghapus tag HTML.

                                Str::limit()
                                = membatasi panjang teks.

                                120
                                = jumlah karakter yang ditampilkan.
                            --}}


                        </div>

                    </div>

                </div>


            @empty


                <div class="col-12 text-center text-muted">

                    Belum ada berita.

                </div>


            @endforelse

        </div>



        {{-- TOMBOL BERITA --}}

        @if($berita->count() > 3)


            <div class="text-center mt-5">

                <button
                    type="button"
                    id="btnLihatBerita"
                    class="btn btn-success px-4">


                    <i class="bi bi-newspaper me-2"></i>

                    Lihat Semua Data Berita


                </button>

            </div>


        @endif


    </div>

</section>



{{-- ================================================== --}}
{{-- 8. EKSTRAKURIKULER --}}
{{-- ================================================== --}}

<section class="section-padding bg-light"
         id="eskul">

    <div class="container">


        <div class="section-title">

            <span>

                KEGIATAN SISWA

            </span>


            <h2>

                Ekstrakurikuler

            </h2>


            <p>

                Kegiatan untuk mengembangkan bakat dan minat siswa.

            </p>

        </div>



        <div class="row g-4">


            {{-- Loop data ekstrakurikuler --}}

            @forelse($eskul as $item)


                {{--
                    6 data pertama tampil.

                    Data setelah data ke-6
                    disembunyikan menggunakan d-none.
                --}}

                <div class="col-md-4 eskul-item

                    {{ $loop->iteration > 6
                        ? 'eskul-extra d-none'
                        : '' }}">


                    <div class="eskul-card bg-white">


                        {{-- GAMBAR ESKUL --}}

                        @if($item->gambar)


                            <img
                                src="{{ asset('storage/' . $item->gambar) }}"
                                alt="{{ $item->nama_ekskul }}">


                        @else


                            {{-- Placeholder gambar --}}

                            <div
                                class="d-flex align-items-center justify-content-center bg-light"
                                style="height:220px">

                                <i class="bi bi-trophy fs-1 text-secondary"></i>

                            </div>


                        @endif



                        <div class="p-4">


                            {{-- Nama eskul --}}

                            <h5 class="fw-bold">

                                {{ $item->nama_ekskul }}

                            </h5>


                            {{-- Deskripsi eskul --}}

                            <p class="text-muted">


                                {{ \Illuminate\Support\Str::limit(

                                    $item->deskripsi ?? '',

                                    100

                                ) }}


                            </p>


                            {{-- Pembina eskul --}}

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



        {{-- TOMBOL ESKUL --}}

        @if($eskul->count() > 6)


            <div class="text-center mt-5">

                <button
                    type="button"
                    id="btnLihatEskul"
                    class="btn btn-success px-4">


                    <i class="bi bi-trophy me-2"></i>

                    Lihat Semua Data Ekstrakurikuler


                </button>

            </div>


        @endif


    </div>

</section>



{{-- ================================================== --}}
{{-- 9. GALERI --}}
{{-- ================================================== --}}

<section class="section-padding"
         id="galeri">

    <div class="container">


        <div class="section-title">

            <span>

                DOKUMENTASI

            </span>


            <h2>

                Galeri Sekolah

            </h2>


            <p>

                Dokumentasi kegiatan sekolah.

            </p>

        </div>



        <div class="row g-3">


            {{-- Loop data galeri --}}

            @forelse($galeri as $item)


                {{--
                    6 galeri pertama ditampilkan.

                    Galeri berikutnya disembunyikan.
                --}}

                <div class="col-md-4 galeri-item

                    {{ $loop->iteration > 6
                        ? 'galeri-extra d-none'
                        : '' }}">


                    <div class="gallery-item">


                        {{-- ================================================= --}}
                        {{-- CEK KATEGORI FILE --}}
                        {{-- ================================================= --}}


                        @if($item->kategori === 'Foto')


                            {{-- 
                                Jika kategori Foto,
                                gunakan tag <img>.
                            --}}

                            <img
                                src="{{ asset('storage/' . $item->file) }}"
                                alt="{{ $item->judul }}">


                        @else


                            {{-- 
                                Jika bukan Foto,
                                dianggap sebagai Video.
                            --}}

                            <video controls>

                                <source
                                    src="{{ asset('storage/' . $item->file) }}"
                                    type="video/mp4">


                                Browser tidak mendukung video.

                            </video>


                        @endif



                        {{-- ================================================= --}}
                        {{-- INFORMASI GALERI --}}
                        {{-- ================================================= --}}

                        <div class="gallery-title">


                            {{-- Judul galeri --}}

                            <h6 class="mb-1">

                                {{ $item->judul }}

                            </h6>


                            {{-- Kategori galeri --}}

                            <small>

                                {{ $item->kategori }}

                            </small>


                        </div>

                    </div>

                </div>


            @empty


                <div class="col-12 text-center text-muted">

                    Belum ada data galeri.

                </div>


            @endforelse

        </div>



        {{-- TOMBOL GALERI --}}

        @if($galeri->count() > 6)


            <div class="text-center mt-5">

                <button
                    type="button"
                    id="btnLihatGaleri"
                    class="btn btn-success px-4">


                    <i class="bi bi-images me-2"></i>

                    Lihat Semua Data Galeri


                </button>

            </div>


        @endif


    </div>

</section>



{{-- ================================================== --}}
{{-- 10. CTA --}}
{{-- ================================================== --}}

<section class="py-5 bg-success text-white">

    <div class="container text-center">


        <h2 class="fw-bold">

            Mari Menjadi Bagian dari Sekolah Kami

        </h2>


        <p class="mb-4">

            Bersama membangun generasi unggul,
            berkarakter, dan berprestasi.

        </p>


        {{-- Tombol kembali menuju profil --}}

        <a href="#profil"
           class="btn btn-light px-4">

            Tentang Sekolah

        </a>

    </div>

</section>


@endsection



{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

@push('scripts')

<script>


    /*
    =========================================================
    FUNGSI LIHAT SEMUA
    =========================================================

    Fungsi ini digunakan oleh:

    - Guru
    - Siswa
    - Berita
    - Ekstrakurikuler
    - Galeri

    Dengan satu fungsi, kita tidak perlu
    menulis kode JavaScript yang sama berulang-ulang.
    */


    function setupLihatSemua(

        buttonId,
        itemClass,
        textShow,
        textHide,
        iconShow,
        iconHide

    ) {


        /*
        Mengambil tombol berdasarkan ID.
        */

        const button =
            document.getElementById(buttonId);


        /*
        Kalau tombol tidak ditemukan,
        fungsi dihentikan.
        */

        if (!button) {

            return;

        }



        /*
        Event click dijalankan
        saat tombol ditekan.
        */

        button.addEventListener('click', function () {


            /*
            Mengambil semua elemen
            yang memiliki class item tambahan.
            */

            const items =
                document.querySelectorAll(
                    '.' + itemClass
                );


            /*
            Melakukan perulangan
            pada setiap data tambahan.
            */

            items.forEach(function (item) {


                /*
                toggle() digunakan untuk:

                jika d-none ada:
                → d-none dihapus
                → data ditampilkan.

                jika d-none tidak ada:
                → d-none ditambahkan
                → data disembunyikan.
                */

                item.classList.toggle('d-none');

            });



            /*
            Mengecek apakah data tambahan
            sekarang sedang ditampilkan.

            ! artinya NOT / kebalikan.

            contains('d-none')
            mengecek apakah elemen mempunyai
            class d-none.
            */

            const sedangTampil =
                items.length > 0 &&
                !items[0].classList.contains('d-none');



            /*
            Kalau data sedang tampil,
            ubah teks dan icon tombol.
            */

            if (sedangTampil) {


                this.innerHTML =

                    '<i class="' +
                    iconHide +
                    ' me-2"></i>' +

                    textHide;


            } else {


                /*
                Kalau data kembali disembunyikan,
                kembalikan teks tombol awal.
                */

                this.innerHTML =

                    '<i class="' +
                    iconShow +
                    ' me-2"></i>' +

                    textShow;
            }

        });

    }



    /*
    =========================================================
    GURU
    =========================================================

    Awalnya:
    4 guru ditampilkan.

    Data berikutnya:
    disembunyikan.
    */

    setupLihatSemua(

        'btnLihatGuru',
        'guru-extra',
        'Lihat Semua Data Guru',
        'Sembunyikan Data Guru',
        'bi bi-people',
        'bi bi-chevron-up'

    );



    /*
    =========================================================
    SISWA
    =========================================================

    Awalnya:
    6 siswa ditampilkan.
    */

    setupLihatSemua(

        'btnLihatSiswa',
        'siswa-extra',
        'Lihat Semua Data Siswa',
        'Sembunyikan Data Siswa',
        'bi bi-people',
        'bi bi-chevron-up'

    );



    /*
    =========================================================
    BERITA
    =========================================================

    Awalnya:
    3 berita ditampilkan.
    */

    setupLihatSemua(

        'btnLihatBerita',
        'berita-extra',
        'Lihat Semua Data Berita',
        'Sembunyikan Data Berita',
        'bi bi-newspaper',
        'bi bi-chevron-up'

    );



    /*
    =========================================================
    EKSTRAKURIKULER
    =========================================================

    Awalnya:
    6 eskul ditampilkan.
    */

    setupLihatSemua(

        'btnLihatEskul',
        'eskul-extra',
        'Lihat Semua Data Ekstrakurikuler',
        'Sembunyikan Data Ekstrakurikuler',
        'bi bi-trophy',
        'bi bi-chevron-up'

    );



    /*
    =========================================================
    GALERI
    =========================================================

    Awalnya:
    6 galeri ditampilkan.
    */

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