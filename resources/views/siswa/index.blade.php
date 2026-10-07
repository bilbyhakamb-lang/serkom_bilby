@extends('admin_app')

@section('title', $title ?? 'Kelola Data Siswa')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">

<style>
    /* ============================= */
    /* PAGE */
    /* ============================= */

    .siswa-page {
        width: 100%;
        padding: 30px;
        box-sizing: border-box;
        color: #26352d;
    }


    /* ============================= */
    /* HEADER HIJAU */
    /* ============================= */

    .siswa-header {
        background: linear-gradient(135deg, #18392b, #32634a);
        color: white;

        padding: 25px 30px;

        border-radius: 14px;

        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-bottom: 24px;
    }

    .siswa-header-content h2 {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 6px;
        color: white;
    }

    .siswa-header-content p {
        font-size: 14px;
        margin: 0;
        color: #dce9df;
    }

    .siswa-header .header-icon {
        font-size: 42px;
        opacity: .85;
    }


    /* ============================= */
    /* CARD */
    /* ============================= */
    .siswa-card {
        width: 100%;
        background: #fff;
        border: 1px solid #e7ebe8;
        border-radius: 14px;
        box-shadow: 0 3px 14px rgba(0, 0, 0, .04);
        overflow: hidden;
    }


    /* ============================= */
    /* TOOLBAR */
    /* ============================= */
    .siswa-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        border-bottom: 1px solid #edf0ed;
    }

    .siswa-toolbar h4 {
        font-size: 18px;
        font-weight: 650;
        margin: 0;
        color: #26352d;
    }

    .siswa-toolbar-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }


    /* ============================= */
    /* TOMBOL TAMBAH */
    /* ============================= */

    .btn-tambah-siswa {
        height: 39px;
        padding: 0 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: none;
        border-radius: 8px;
        background: #159b68;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: .2s;
    }

    .btn-tambah-siswa:hover {
        background: #117d54;
        color: #fff;
    }


    /* ============================= */
    /* TABEL */
    /* ============================= */

    .siswa-table-wrap {
        width: 100%;
        overflow-x: auto;
        padding: 0 22px;
    }

    .siswa-table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
        margin: 0;
    }

    .siswa-table thead {
        background: #f7f9f8;
    }

    .siswa-table th {
        padding: 15px 18px;
        text-align: left;
        color: #68766d;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .5px;
        text-transform: uppercase;
        border-bottom: 1px solid #e7ebe8;
        white-space: nowrap;
    }

    .siswa-table td {
        padding: 16px 18px;
        font-size: 13px;
        color: #354239;
        border-bottom: 1px solid #edf0ed;
        vertical-align: middle;
    }

    .siswa-table tbody tr:hover {
        background: #f8fbf9;
    }

    .siswa-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* ============================= */
    /* DATA */
    /* ============================= */
    .siswa-no {
        color: #879188 !important;
        width: 60px;
    }

    .siswa-nisn {
        font-weight: 600;
        color: #34453a !important;
        white-space: nowrap;
    }

    .siswa-nama {
        font-weight: 600;
        color: #27372d !important;
        min-width: 180px;
    }

    .siswa-tahun {
        white-space: nowrap;
    }


    /* ============================= */
    /* JENIS KELAMIN */
    /* ============================= */
    .gender-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .gender-laki {
        background: #eaf4ee;
        color: #27804d;
    }

    .gender-perempuan {
        background: #f4edf8;
        color: #8953a4;
    }


    /* ============================= */
    /* AKSI */
    /* ============================= */
    .siswa-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .btn-aksi {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        border: 1px solid #e5e9e6;
        background: #fff;
        font-size: 13px;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
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
    
    .btn-edit {
        color: #27804d;
    }

    .btn-edit:hover {
        background: #eaf4ee;
        border-color: #b8d8c3;
        color: #27804d;
    }

    .btn-hapus {
        color: #d64545;
    }

    .btn-hapus:hover {
        background: #fff0f0;
        border-color: #f0c4c4;
        color: #d64545;
    }


    /* ============================= */
    /* ALERT */
    /* ============================= */
    .siswa-alert {
        padding: 12px 16px;
        margin-bottom: 18px;
        border-radius: 8px;
        background: #eaf6ee;
        color: #247344;
        font-size: 13px;
    }

    .siswa-alert-error {
        background: #fff0f0;
        color: #b52e38;
    }


    /* ============================= */
    /* FOOTER CARD */
    /* ============================= */
    .siswa-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 22px;
        border-top: 1px solid #edf0ed;
        color: #758078;
        font-size: 12px;
    }


    /* ============================= */
    /* DATATABLES */
    /* ============================= */
    .dataTables_wrapper {
        padding: 0 22px 10px;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin: 15px 0;
        font-size: 13px;
        color: #68766d;
    }

    .dataTables_wrapper .dataTables_filter {
        text-align: right;
    }

    .dataTables_wrapper .dataTables_filter label {
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .dataTables_wrapper .dataTables_filter input {
        height: 39px;
        border: 1px solid #e0e6e1;
        border-radius: 8px;
        padding: 8px 12px;
        outline: none;
        font-size: 13px;
        background: #fff;
        min-width: 220px;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #39865a;
        box-shadow: 0 0 0 3px rgba(57, 134, 90, .10);
    }

    .dataTables_wrapper .dataTables_length label {
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .dataTables_wrapper .dataTables_length select {
        height: 39px;
        border: 1px solid #e0e6e1;
        border-radius: 8px;
        padding: 0 30px 0 12px;
        outline: none;
        font-size: 13px;
        background: #fff;
    }

    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #39865a;
        box-shadow: 0 0 0 3px rgba(57, 134, 90, .10);
    }

    .dataTables_wrapper .dataTables_info {
        font-size: 12px;
        color: #758078;
        padding-top: 12px !important;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 10px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {

        border-radius: 7px !important;
        padding: 6px 12px !important;
        margin: 0 2px !important;
        border: 1px solid #e5e9e6 !important;
        background: #fff !important;
        color: #354239 !important;
        font-size: 13px !important;
        font-weight: 500;
        transition: .2s;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f0f7f3 !important;
        border-color: #b8d8c3 !important;
        color: #27804d !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {

        background: #159b68 !important;
        border-color: #159b68 !important;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {

        background: #fff !important;
        color: #c5cdc7 !important;
        border-color: #edf0ed !important;
        cursor: not-allowed;
    }

    .dataTables_wrapper .dataTables_empty {

        padding: 38px 15px !important;
        text-align: center;
        color: #89928b !important;
        font-size: 13px !important;
    }


    /* ============================= */
    /* RESPONSIVE */
    /* ============================= */

    @media (max-width: 768px) {

        .siswa-page {
            padding: 20px 14px;
        }

        .siswa-header {
            padding: 20px;
        }

        .siswa-header-content h2 {
            font-size: 20px;
        }

        .siswa-card {
            padding: 0;
        }

        .siswa-toolbar {
            align-items: flex-start;
            flex-direction: column;
            padding: 16px;
        }

        .siswa-toolbar-actions {
            width: 100%;
        }

        .btn-tambah-siswa {
            width: 100%;
        }

        .siswa-footer {
            padding: 14px 16px;
        }

        .siswa-table-wrap {
            padding: 0 12px;
        }

        .dataTables_wrapper {
            padding: 0 12px 10px;
        }

        .dataTables_wrapper .dataTables_filter {
            text-align: left;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 100%;
            min-width: 0;
        }
    }

    @media (max-width: 480px) {

        .siswa-toolbar-actions {
            flex-direction: column;

            align-items: stretch;
        }
    }
</style>
@endpush


@section('content')

<div class="siswa-page">

    <!-- ============================= -->
    <!-- HEADER HIJAU -->
    <!-- ============================= -->

    <div class="siswa-header">

        <div class="siswa-header-content">

            <h2>
                Kelola Data Siswa
            </h2>

            <p>
                Kelola dan lihat informasi data siswa sekolah.
            </p>

        </div>

        <i class="bi bi-people-fill header-icon"></i>

    </div>


    <!-- ============================= -->
    <!-- NOTIFIKASI SUCCESS -->
    <!-- ============================= -->

    @if(session('success'))

        <div class="siswa-alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    <!-- ============================= -->
    <!-- NOTIFIKASI ERROR -->
    <!-- ============================= -->

    @if(session('error'))

        <div class="siswa-alert siswa-alert-error">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

        </div>

    @endif


    <!-- ============================= -->
    <!-- CARD SISWA -->
    <!-- ============================= -->

    <div class="siswa-card">


        <!-- TOOLBAR -->

        <div class="siswa-toolbar">

            <h4>
                Daftar Siswa
            </h4>


            <div class="siswa-toolbar-actions">

                <a href="{{ route('siswa.form') }}"
                   class="btn-tambah-siswa">

                    <i class="bi bi-plus-circle"></i>

                    Tambah Siswa

                </a>

            </div>

        </div>


        <!-- ============================= -->
        <!-- TABEL SISWA -->
        <!-- ============================= -->

        <div class="siswa-table-wrap">

            <table class="siswa-table"
                   id="tabelSiswa">

                <thead>

                    <tr>
                        <th style="width: 65px;">
                            No
                        </th>
                        <th>
                            NISN
                        </th>
                        <th>
                            Nama Siswa
                        </th>
                        <th>
                            Jenis Kelamin
                        </th>
                        <th>
                            Tahun Masuk
                        </th>
                        <th style="width: 140px;">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($siswa as $s)

                        <tr>

                            <!-- NO -->
                            <td class="siswa-no">
                                {{ $loop->iteration }}
                            </td>

                            <!-- NISN -->
                            <td class="siswa-nisn">
                                {{ $s->nisn }}
                            </td>

                            <!-- NAMA -->
                            <td class="siswa-nama">
                                {{ $s->nama_siswa }}
                            </td>

                            <!-- JENIS KELAMIN -->
                            <td>
                                @if($s->jenis_kelamin == 'Laki-Laki')
                                    <span class="gender-badge gender-laki">
                                        Laki-Laki
                                    </span>
                                @else
                                    <span class="gender-badge gender-perempuan">
                                        Perempuan
                                    </span>
                                @endif
                            </td>

                            <!-- TAHUN -->
                            <td class="siswa-tahun">
                                {{ $s->tahun_masuk }}
                            </td>

                            <!-- AKSI -->
                            <td>
                                <div class="siswa-actions">


                                    <!-- DETAIL -->

                                    <a href="{{ route(
                                        'admin.siswa.show',
                                        encrypt($s->id_siswa)
                                    ) }}"
                                       class="btn-aksi btn-detail"
                                       title="Detail data">

                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!-- EDIT -->
                                    <a href="{{ route(
                                        'siswa.form',
                                        encrypt($s->id_siswa)
                                    ) }}"
                                       class="btn-aksi btn-edit"
                                       title="Edit data">

                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <!-- HAPUS -->
                                    <form action="{{ route(
                                        'siswa.destroy',
                                        encrypt($s->id_siswa)
                                    ) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn-aksi btn-hapus"
                                                title="Hapus data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="text-center py-5">
                                <i class="bi bi-people fs-1 text-muted"></i>
                                <p class="text-muted mt-2 mb-0">
                                    Belum ada data siswa.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="siswa-footer">

            <span>
                Jumlah siswa:
                {{ $siswa->count() }}
            </span>

            <span>
                Data siswa sekolah
            </span>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $(document).ready(function () {

        $('#tabelSiswa').DataTable({

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
                    // Kolom No dan Aksi tidak bisa di-sort
                    orderable: false,
                    targets: [0, 5]
                }

            ],

            language: {

                search: "",
                searchPlaceholder:
                    "Cari nama atau NISN...",
                lengthMenu:
                    "Tampilkan _MENU_ data",
                info:
                    "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty:
                    "Tidak ada data",
                infoFiltered:
                    "(difilter dari _MAX_ total data)",
                zeroRecords:
                    "Data siswa tidak ditemukan",
                emptyTable:
                    "Belum ada data siswa",

                paginate: {

                    first: "Awal",
                    last: "Akhir",
                    next: "Next",
                    previous: "Prev"
                }
            },

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
</script>
@endpush