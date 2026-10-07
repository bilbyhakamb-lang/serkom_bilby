@extends('admin_app')

{{-- <!-- Favicon -->
    <link rel="icon" type="images/png"href="{{ asset('assets/images/logo sekolah.jpg') }}"> --}}

@php
    use Illuminate\Support\Facades\Crypt;
@endphp

@section('title', 'Kelola Guru')

@push('styles')
<style>
    .guru-header {
        background: linear-gradient(135deg, #18392b, #32634a);
        color: white;
        padding: 25px 30px;
        border-radius: 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .guru-header h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .guru-header p {
        margin: 0;
        color: #dce9df;
    }

    .header-icon {
        font-size: 42px;
        opacity: .85;
    }

    .guru-card {
        background: white;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
    }

    .guru-card h5 {
        color: #263b30;
        font-weight: 700;
    }

    #tabelGuru thead th {
        background: #edf4ef;
        color: #28563e;
        font-size: 14px;
        white-space: nowrap;
    }

    #tabelGuru tbody td {
        color: #34483b;
        font-size: 14px;
        vertical-align: middle;
    }

    .guru-photo,
    .guru-placeholder {
        width: 48px;
        height: 48px;
        border-radius: 50%;
    }

    .guru-photo {
        object-fit: cover;
        border: 2px solid #d9e8dc;
    }

    .guru-placeholder {
        background: #edf4ef;
        color: #32634a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .btn-add {
        background: #28563e;
        color: white;
        border-radius: 8px;
        padding: 10px 16px;
    }

    .btn-add:hover {
        background: #18392b;
        color: white;
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
        background: #e7f0e9;
        color: #28563e;
    }

    .btn-edit:hover {
        background: #d2e5d7;
        color: #18392b;
    }

    /* DELETE */
    .btn-delete {
        background: #fce8e8;
        color: #c0392b;
    }

    .btn-delete:hover {
        background: #c0392b;
        color: white;
    }

    /* ================================= */
    /* ALERT */
    /* ================================= */

    .guru-alert {
        border: none;
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* ================================= */
    /* DATATABLES */
    /* ================================= */

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

    @media (max-width: 768px) {
        .guru-header {
            padding: 20px;
        }

        .guru-card {
            padding: 15px;
        }

        .dataTables_wrapper .dataTables_filter {
            text-align: left;
        }
    }
</style>
@endpush
@section('content')

<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="guru-header mb-4">
        <div>
            <h2>Kelola Guru</h2>
            <p>Kelola data guru dan informasi pengajar sekolah.</p>
        </div>

        <i class="bi bi-person-workspace header-icon"></i>
    </div>


    <!-- =============================== -->
    <!-- PESAN BERHASIL -->
    <!-- =============================== -->

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show guru-alert"
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


    <!-- =============================== -->
    <!-- PESAN ERROR -->
    <!-- =============================== -->

    @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center guru-alert"
             role="alert"
             id="error-alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            <span>{{ session('error') }}</span>

            <button type="button"
                    class="btn-close ms-auto"
                    data-bs-dismiss="alert">
            </button>

        </div>
    @endif

    <!-- =============================== -->
    <!-- ERROR VALIDASI -->
    <!-- =============================== -->

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show guru-alert"
             role="alert">

            <strong>
                <i class="bi bi-exclamation-triangle me-1"></i>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    <!-- =============================== -->
    <!-- CARD DATA GURU -->
    <!-- =============================== -->

    <div class="guru-card">

        <!-- JUDUL DAN TOMBOL TAMBAH -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h5 class="mb-1">
                    Data Guru
                </h5>
                <small class="text-muted">
                    Daftar guru yang terdaftar
                </small>
            </div>

            <a href="{{ route('guru.create') }}"
               class="btn btn-add">
                <i class="bi bi-plus-circle"></i>
                Tambah Guru
            </a>
        </div>
        <!-- =============================== -->
        <!-- TABEL GURU -->
        <!-- =============================== -->

        <div class="table-responsive">
            <table class="table table-hover align-middle"
                   id="tabelGuru">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Mata Pelajaran</th>
                        <th class="text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($guru as $item)
                        <tr>
                            <!-- NO -->
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <!-- FOTO -->
                            <td>
                                @if($item->foto)
                                    <img
                                        src="{{ asset('storage/' . $item->foto) }}"
                                        alt="Foto Guru"
                                        class="guru-photo">
                                @else
                                    <div class="guru-placeholder">
                                        <i class="bi bi-person"></i>
                                    </div>
                                @endif
                            </td>
                            <!-- NAMA -->
                            <td class="fw-semibold">
                                {{ $item->nama_guru }}
                            </td>
                            <!-- NIP -->
                            <td>
                                {{ $item->nip ?? '-' }}
                            </td>
                            <!-- MAPEL -->
                            <td>
                                {{ $item->mapel }}
                            </td>
                            <!-- AKSI -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- DETAIL -->
                                    <a href="{{ route(
                                        'admin.guru.show',
                                        Crypt::encryptString((string) $item->id_guru)
                                    ) }}"
                                       class="btn btn-sm btn-detail"
                                       title="Detail Guru">

                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <!-- EDIT -->
                                    <a href="{{ route(
                                        'guru.edit',
                                        Crypt::encryptString((string) $item->id_guru)
                                    ) }}"
                                       class="btn btn-sm btn-edit"
                                       title="Edit Guru">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- HAPUS -->
                                    <form
                                        action="{{ route(
                                            'guru.destroy',
                                            Crypt::encryptString((string) $item->id_guru)
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-delete"
                                                title="Hapus Guru">
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
        <!-- TOTAL GURU -->
        <div class="text-muted small mt-3">
            Total guru:
            {{ $guru->count() }}
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
    $(document).ready(function () {
        $('#tabelGuru').DataTable({
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
                    orderable: false,
                    targets: [1, 5]
                }
            ],
            language: {
                search: "",
                searchPlaceholder:
                    "Cari nama guru...",
                lengthMenu:
                    "Tampilkan _MENU_ data",
                info:
                    "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty:
                    "Tidak ada data",
                infoFiltered:
                    "(difilter dari _MAX_ total data)",
                zeroRecords:
                    "Data guru tidak ditemukan",
                emptyTable:
                    "Belum ada data guru",
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
                }).nodes().each(function (cell, i) {
                    const info = api.page.info();
                    cell.innerHTML =
                        info.start + i + 1;
                });
            }
        });
    });
    // ===============================
    // HILANGKAN PESAN SUCCESS 5 DETIK
    // ===============================
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

</script>
@endpush