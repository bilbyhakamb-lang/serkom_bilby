@extends('admin_app')

@php
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Support\Str;
@endphp

@section('title', 'Kelola Galeri')


{{-- ========================================================= --}}
{{-- STYLE --}}
{{-- ========================================================= --}}

@push('styles')
<style>

    /* ============================= */
    /* HEADER */
    /* ============================= */

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
        font-size: 14px;
    }

    .header-icon {
        font-size: 42px;
        opacity: .85;
    }


    /* ============================= */
    /* CARD */
    /* ============================= */

    .galeri-card {
        background: white;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
    }


    /* ============================= */
    /* JUDUL CARD */
    /* ============================= */

    .card-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #28563e;
        border-bottom: 1px solid #e8eee9;
        padding-bottom: 15px;
    }

    .card-heading > i {
        font-size: 22px;
    }

    .card-heading h5 {
        font-weight: 700;
    }


    /* ============================= */
    /* ALERT */
    /* ============================= */
    .galeri-alert {
        border: none;
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 20px;
    }


    /* ============================= */
    /* TABEL */
    /* ============================= */

    #tabelGaleri {
        width: 100% !important;
    }

    #tabelGaleri thead th {
        background: #edf4ef;
        color: #28563e;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        vertical-align: middle;
        padding: 14px;
    }

    #tabelGaleri tbody td {
        color: #34483b;
        font-size: 14px;
        padding: 14px;
        vertical-align: middle;
    }


    /* ============================= */
    /* GAMBAR / VIDEO */
    /* ============================= */

    .galeri-image {
        width: 85px;
        height: 65px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #d9e8dc;
    }


    /* ============================= */
    /* BADGE KATEGORI */
    /* ============================= */
    .badge-kategori {
        display: inline-block;
        background: #e3f1e7;
        color: #28563e;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }


    /* ============================= */
    /* TOMBOL TAMBAH */
    /* ============================= */
    .btn-add {
        background: #28563e;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: .2s ease;
    }

    .btn-add:hover {
        background: #18392b;
        color: white;
        transform: translateY(-1px);
    }


    /* ============================= */
    /* TOMBOL AKSI */
    /* ============================= */
    .action-btn {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 8px;
        transition: .2s ease;
        text-decoration: none;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow:
            0 3px 8px rgba(0, 0, 0, .15);
    }


    /* ============================= */
    /* DETAIL */
    /* ============================= */
    .btn-detail {
        background-color: #00c8e8;
        color: white;
    }

    .btn-detail:hover {
        background-color: #00a9c5;
        color: white;
    }


    /* ============================= */
    /* EDIT */
    /* ============================= */
    .btn-edit {
        background: #e7f0e9;
        color: #28563e;
    }

    .btn-edit:hover {
        background: #d2e5d7;
        color: #18392b;
    }


    /* ============================= */
    /* HAPUS */
    /* ============================= */
    .btn-delete {
        background: #fce8e8;
        color: #b42318;
    }

    .btn-delete:hover {
        background: #f8d4d4;
        color: #912018;
    }

    /* ============================= */
    /* DATA KOSONG */
    /* ============================= */

    .empty-icon {
        font-size: 42px;
        color: #9aafa0;
    }


    /* ============================= */
    /* DATATABLES */
    /* ============================= */
    .dataTables_wrapper {
        padding-top: 10px;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 15px;
        font-size: 13px;
        color: #68766d;
    }

    .dataTables_wrapper .dataTables_filter {
        text-align: right;
    }

    .dataTables_wrapper .dataTables_filter input {
        height: 38px;
        border: 1px solid #d9e8dc;
        border-radius: 8px;
        padding: 6px 12px;
        outline: none;
        margin-left: 8px;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #28563e;
        box-shadow:
            0 0 0 3px rgba(40, 86, 62, .1);
    }

    .dataTables_wrapper .dataTables_length select {
        height: 38px;
        border: 1px solid #d9e8dc;
        border-radius: 8px;
        padding: 0 30px 0 10px;
        margin: 0 6px;
        outline: none;
    }

    .dataTables_wrapper .dataTables_info {
        font-size: 12px;
        color: #758078;
        padding-top: 14px !important;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 12px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 7px !important;
        padding: 5px 11px !important;
        margin: 0 2px !important;
        border: 1px solid #e5e9e6 !important;
        background: #fff !important;
        color: #354239 !important;
        font-size: 13px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #edf4ef !important;
        border-color: #b8d8c3 !important;
        color: #28563e !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #28563e !important;
        border-color: #28563e !important;
        color: white !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        color: #c5cdc7 !important;
        border-color: #edf0ed !important;
        cursor: not-allowed;
    }


    /* ============================= */
    /* RESPONSIVE */
    /* ============================= */

    @media (max-width: 768px) {

        .galeri-header {
            padding: 20px;
        }

        .galeri-header h2 {
            font-size: 20px;
        }

        .galeri-card {
            padding: 15px;
        }

        .card-heading {
            flex-wrap: wrap;
        }

        .dataTables_wrapper .dataTables_filter {
            text-align: left;
        }

        #tabelGaleri {
            min-width: 900px;
        }

    }

</style>
@endpush



{{-- ========================================================= --}}
{{-- CONTENT --}}
{{-- ========================================================= --}}

@section('content')

<div class="container-fluid py-4">


    {{-- ============================= --}}
    {{-- HEADER --}}
    {{-- ============================= --}}

    <div class="galeri-header mb-4">

        <div>
            <h2>
                Kelola Galeri
            </h2>
            <p>
                Kelola foto dan dokumentasi kegiatan sekolah.
            </p>
        </div>

        <i class="bi bi-images header-icon"></i>

    </div>



    {{-- ============================= --}}
    {{-- NOTIFIKASI SUCCESS --}}
    {{-- ============================= --}}
    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show galeri-alert"
            role="alert"
            id="success-alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>

        </div>

    @endif



    {{-- ============================= --}}
    {{-- NOTIFIKASI ERROR --}}
    {{-- ============================= --}}
    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show galeri-alert"
            role="alert"
            id="error-alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>

        </div>

    @endif



    {{-- ============================= --}}
    {{-- ERROR VALIDASI --}}
    {{-- ============================= --}}

    @if($errors->any())

        <div
            class="alert alert-danger alert-dismissible fade show galeri-alert"
            role="alert">

            <strong>
                <i class="bi bi-exclamation-triangle me-1"></i>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>

        </div>

    @endif



    {{-- ============================= --}}
    {{-- CARD GALERI --}}
    {{-- ============================= --}}

    <div class="galeri-card">


        {{-- ============================= --}}
        {{-- JUDUL CARD --}}
        {{-- ============================= --}}                 
        <div class="card-heading mb-4">

            <i class="bi bi-info-circle"></i>
            <h5 class="mb-0">
                Data Galeri
            </h5>

            <div class="ms-auto">
                <a
                    href="{{ route('galeri.create') }}"
                    class="btn btn-add">
                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Galeri
                </a>
            </div>

        </div>



        {{-- ============================= --}}
        {{-- TABEL --}}
        {{-- ============================= --}}

        <div class="table-responsive">

            <table
                id="tabelGaleri"
                class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th width="50">
                            No
                        </th>

                        <th width="100">
                            File
                        </th>

                        <th>
                            Judul
                        </th>

                        <th>
                            Keterangan
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th
                            class="text-center"
                            width="150">

                            Aksi

                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($galeri as $item)

                        <tr>

                            {{-- NO --}}

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- FILE --}}

                            <td>

                                @if($item->kategori === 'Foto')

                                    <img
                                        src="{{ asset('storage/' . $item->file) }}"
                                        class="galeri-image"
                                        alt="{{ $item->judul }}">

                                @else

                                    <video
                                        class="galeri-image"
                                        controls>

                                        <source
                                            src="{{ asset('storage/' . $item->file) }}"
                                            type="video/mp4">

                                        Browser tidak mendukung video.

                                    </video>

                                @endif

                            </td>


                            {{-- JUDUL --}}

                            <td class="fw-semibold">

                                {{ $item->judul }}

                            </td>


                            {{-- KETERANGAN --}}

                            <td>

                                {{ Str::limit($item->keterangan, 50) }}

                            </td>


                            {{-- KATEGORI --}}

                            <td>

                                <span class="badge-kategori">

                                    {{ $item->kategori }}

                                </span>

                            </td>


                            {{-- TANGGAL --}}

                            <td>

                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}

                            </td>


                            {{-- AKSI --}}

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">


                                    {{-- DETAIL --}}

                                    <a
                                        href="{{ route(
                                            'admin.galeri.detail',
                                            Crypt::encryptString((string) $item->id_galeri)
                                        ) }}"
                                        class="btn action-btn btn-detail"
                                        title="Detail Galeri">

                                        <i class="bi bi-eye"></i>

                                    </a>



                                    {{-- EDIT --}}

                                    <a
                                        href="{{ route(
                                            'galeri.edit',
                                            Crypt::encryptString((string) $item->id_galeri)
                                        ) }}"
                                        class="btn action-btn btn-edit"
                                        title="Edit Galeri">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>



                                    {{-- HAPUS --}}

                                    <form
                                        action="{{ route(
                                            'galeri.destroy',
                                            Crypt::encryptString((string) $item->id_galeri)
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn action-btn btn-delete"
                                            title="Hapus Galeri">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>



        {{-- ============================= --}}
        {{-- TOTAL DATA --}}
        {{-- ============================= --}}

        <div class="text-muted small mt-3">

            Total galeri:

            <strong>
                {{ $galeri->count() }}
            </strong>

            data

        </div>


    </div>

</div>

@endsection



{{-- ========================================================= --}}
{{-- JAVASCRIPT DATATABLES --}}
{{-- ========================================================= --}}

@push('scripts')

<script>

    $(document).ready(function () {

        $('#tabelGaleri').DataTable({

            responsive: true,

            autoWidth: false,

            pageLength: 10,

            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],

            order: [[0, 'asc']],

            columnDefs: [
                {
                    // Kolom File dan Aksi tidak bisa di-sort
                    orderable: false,
                    targets: [1, 6]
                }
            ],

            language: {

                search: "",

                searchPlaceholder:
                    "Cari galeri...",

                lengthMenu:
                    "Tampilkan _MENU_ data",

                info:
                    "Menampilkan _START_ - _END_ dari _TOTAL_ data",

                infoEmpty:
                    "Tidak ada data",

                infoFiltered:
                    "(difilter dari _MAX_ total data)",

                zeroRecords:
                    "Data galeri tidak ditemukan",

                emptyTable:
                    "Belum ada data galeri",

                paginate: {

                    first:
                        "Awal",

                    last:
                        "Akhir",

                    next:
                        "Next",

                    previous:
                        "Prev"

                }

            },

            drawCallback: function () {

                const api = this.api();

                api.column(0, {
                    page: 'current'
                })
                .nodes()
                .each(function (cell, i) {

                    const info =
                        api.page.info();

                    cell.innerHTML =
                        info.start + i + 1;

                });

            }

        });

    });



    /* ====================================== */
    /* SUCCESS HILANG OTOMATIS 5 DETIK */
    /* ====================================== */

    setTimeout(function () {

        const alert =
            document.getElementById('success-alert');

        if (alert) {

            alert.style.transition =
                'opacity 0.5s ease';

            alert.style.opacity = '0';

            setTimeout(function () {

                alert.remove();

            }, 500);

        }

    }, 5000);



    /* ====================================== */
    /* ERROR HILANG OTOMATIS 5 DETIK */
    /* ====================================== */

    setTimeout(function () {

        const alert =
            document.getElementById('error-alert');

        if (alert) {

            alert.style.transition =
                'opacity 0.5s ease';

            alert.style.opacity = '0';

            setTimeout(function () {

                alert.remove();

            }, 500);

        }

    }, 5000);

</script>

@endpush