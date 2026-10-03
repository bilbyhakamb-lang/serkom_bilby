@extends('admin_app')

@php
    use Illuminate\Support\Facades\Crypt;
@endphp

@section('title', 'Kelola Ekstrakurikuler')

@push('styles')
<style>
    /* ============================= */
    /* HEADER */
    /* ============================= */

    .eskul-header {
        background: linear-gradient(135deg, #18392b, #32634a);
        color: white;
        padding: 25px 30px;
        border-radius: 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .eskul-header h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .eskul-header p {
        margin: 0;
        color: #dce9df;
    }

    .header-icon {
        font-size: 42px;
        opacity: .85;
    }

    /* ============================= */
    /* CARD */
    /* ============================= */

    .eskul-card {
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

    .eskul-alert {
        border: none;
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* ============================= */
    /* TABEL */
    /* ============================= */

    #tabelEkstrakulikuler {
        width: 100% !important;
    }

    #tabelEkstrakulikuler thead th {
        background: #edf4ef;
        color: #28563e;
        font-size: 14px;
        white-space: nowrap;
    }

    #tabelEkstrakulikuler tbody td {
        color: #34483b;
        font-size: 14px;
        vertical-align: middle;
    }

    /* ============================= */
    /* GAMBAR */
    /* ============================= */

    .eskul-image {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        border: 2px solid #d9e8dc;
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
        transition: all .2s ease;
    }

    .btn-add:hover {
        background: #18392b;
        color: white;
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
        transition: all .2s ease;
    }

    /* DETAIL */

    .btn-detail {
        background-color: #00c8e8;
        color: white;
    }

    .btn-detail:hover {
        background-color: #00a9c5;
        color: white;
    }

    /* EDIT */

    .btn-edit {
        background-color: #e5f1e9;
        color: #28563e;
    }

    .btn-edit:hover {
        background-color: #cfe5d6;
        color: #18392b;
    }

    /* HAPUS */

    .btn-delete {
        background: #fce8e8;
        color: #b42318;
    }

    .btn-delete:hover {
        background: #f8d4d4;
        color: #912018;
    }

    /* HOVER */

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(0, 0, 0, .15);
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
        box-shadow: 0 0 0 3px rgba(40, 86, 62, .1);
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
        color: #fff !important;
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

        .eskul-header {
            padding: 20px;
        }

        .eskul-header h2 {
            font-size: 20px;
        }

        .eskul-card {
            padding: 18px;
        }

        .card-heading {
            flex-wrap: wrap;
        }

        .dataTables_wrapper .dataTables_filter {
            text-align: left;
        }

        #tabelEkstrakulikuler {
            min-width: 900px;
        }
    }
</style>
@endpush


@section('content')

<div class="container-fluid py-4">

    <!-- ============================= -->
    <!-- HEADER -->
    <!-- ============================= -->

    <div class="eskul-header mb-4">

        <div>
            <h2>Kelola Ekstrakurikuler</h2>

            <p>
                Kelola data kegiatan ekstrakurikuler sekolah.
            </p>
        </div>

        <i class="bi bi-trophy header-icon"></i>

    </div>


    <!-- ============================= -->
    <!-- PESAN SUCCESS -->
    <!-- ============================= -->

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show eskul-alert"
             role="alert"
             id="success-alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ============================= -->
    <!-- PESAN ERROR -->
    <!-- ============================= -->

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show eskul-alert"
             role="alert"
             id="error-alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close ms-auto"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ============================= -->
    <!-- ERROR VALIDASI -->
    <!-- ============================= -->

    @if($errors->any())

        <div class="alert alert-danger alert-dismissible fade show eskul-alert"
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

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ============================= -->
    <!-- CARD DATA -->
    <!-- ============================= -->

    <div class="eskul-card">

        <!-- JUDUL CARD -->
        <div class="card-heading mb-4">

            <i class="bi bi-info-circle"></i>

            <h5 class="mb-0">
                Informasi Ekstrakurikuler
            </h5>

            <div class="ms-auto">

                <a href="{{ route('eskul.create') }}"
                   class="btn btn-add">

                    <i class="bi bi-plus-circle me-1"></i>

                    Tambah Eskul

                </a>

            </div>

        </div>


        <!-- ============================= -->
        <!-- TABEL -->
        <!-- ============================= -->

        <div class="table-responsive">

            <table id="tabelEkstrakulikuler"
                   class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th width="50">
                            No
                        </th>

                        <th width="90">
                            Gambar
                        </th>

                        <th>
                            Nama Eskul
                        </th>

                        <th>
                            Pembina
                        </th>

                        <th>
                            Jadwal
                        </th>

                        <th>
                            Deskripsi
                        </th>

                        <th class="text-center"
                            width="150">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($eskul as $item)

                        <tr>

                            <!-- NO -->
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <!-- GAMBAR -->
                            <td>

                                @if($item->gambar)

                                    <img
                                        src="{{ asset('storage/' . $item->gambar) }}"
                                        alt="{{ $item->nama_ekskul }}"
                                        class="eskul-image">

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endif

                            </td>


                            <!-- NAMA -->
                            <td class="fw-semibold">
                                {{ $item->nama_ekskul }}
                            </td>


                            <!-- PEMBINA -->
                            <td>
                                {{ $item->pembina ?? '-' }}
                            </td>


                            <!-- JADWAL -->
                            <td>
                                {{ $item->jadwal_latihan ?? '-' }}
                            </td>


                            <!-- DESKRIPSI -->
                            <td>
                                {{ $item->deskripsi ?: '-' }}
                            </td>


                            <!-- AKSI -->
                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <!-- DETAIL -->
                                    <a href="{{ route(
                                        'admin.ekstrakulikuler.show',
                                        ['id' => Crypt::encryptString((string) $item->getKey())]
                                    ) }}"
                                       class="btn action-btn btn-detail"
                                       title="Detail Ekstrakurikuler">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    <!-- EDIT -->
                                    <a href="{{ route(
                                        'eskul.edit',
                                        ['id' => $item->getKey()]
                                    ) }}"
                                       class="btn action-btn btn-edit"
                                       title="Edit Ekstrakurikuler">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    <!-- HAPUS -->
                                    <form action="{{ route(
                                        'eskul.destroy',
                                        ['id' => $item->getKey()]
                                    ) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data ekstrakurikuler ini?')">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn action-btn btn-delete"
                                                title="Hapus Ekstrakurikuler">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <i class="bi bi-trophy empty-icon"></i>

                                <p class="text-muted mt-3 mb-0">
                                    Belum ada data ekstrakurikuler.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- TOTAL DATA -->

        <div class="text-muted small mt-3">

            Total ekstrakurikuler:
            <strong>{{ $eskul->count() }}</strong>
            data

        </div>

    </div>

</div>

@endsection


@push('scripts')
<script>
    $(document).ready(function () {

        $('#tabelEkstrakulikuler').DataTable({

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
                    // Gambar dan Aksi tidak bisa di-sort
                    orderable: false,
                    targets: [1, 6]
                }
            ],

            language: {
                search: "",
                searchPlaceholder: "Cari ekstrakurikuler...",

                lengthMenu: "Tampilkan _MENU_ data",

                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",

                infoEmpty: "Tidak ada data",

                infoFiltered: "(difilter dari _MAX_ total data)",

                zeroRecords: "Data ekstrakurikuler tidak ditemukan",

                emptyTable: "Belum ada data ekstrakurikuler",

                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Next",
                    previous: "Prev"
                }
            },

            // PERHATIKAN:
            // Setelah object language di atas ada tanda koma
            drawCallback: function () {

                const api = this.api();

                api.column(0, {
                    page: 'current'
                })
                .nodes()
                .each(function (cell, i) {

                    const info = api.page.info();

                    cell.innerHTML =
                        info.start + i + 1;

                });

            }

        });

    });


    // ==============================
    // HILANGKAN SUCCESS 5 DETIK
    // ==============================

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


    // ==============================
    // HILANGKAN ERROR 5 DETIK
    // ==============================

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