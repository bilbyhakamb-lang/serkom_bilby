@extends('admin_app')

<!-- Favicon -->
    <link rel="icon" type="images/png"href="{{ asset('assets/images/logo sekolah.jpg') }}">


@section('title', $title)

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    <style>
        .berita-page {
            width: 100%;
            max-width: none;
            padding: 30px;
            box-sizing: border-box;
        }

        .berita-header {
            background: linear-gradient(135deg, #18392b, #32634a);
            color: white;
            padding: 25px 30px;
            border-radius: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .berita-header h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .berita-header p {
            margin: 0;
            color: #dce9df;
        }

        .header-icon {
            font-size: 42px;
            opacity: .85;
        }

        .berita-card {
            width: 100%;
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,.06);
        }

        .berita-card h5 {
            color: #263b30;
            font-weight: 700;
        }

        .berita-card .table {
            width: 100% !important;
        }

        .berita-card .table thead th {
            background: #edf4ef;
            color: #28563e;
            font-size: 14px;
            white-space: nowrap;
        }

        .berita-card .table tbody td {
            color: #34483b;
            font-size: 14px;
        }

        .berita-image,
        .berita-placeholder {
            width: 65px;
            height: 50px;
            border-radius: 8px;
        }

        .berita-image {
            object-fit: cover;
            border: 2px solid #d9e8dc;
        }

        .berita-placeholder {
            background: #edf4ef;
            color: #32634a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .isi-berita {
            min-width: 180px;
            max-width: 300px;
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

        .btn-edit {
            background: #e6f0e9;
            color: #28563e;
        }

        .btn-delete {
            background: #fce8e8;
            color: #c0392b;
        }

        .btn-edit:hover {
            background: #28563e;
            color: white;
        }

        .btn-delete:hover {
            background: #c0392b;
            color: white;
        }

        /* ================= DATATABLES ================= */

        .dataTables_wrapper {
            width: 100%;
            margin-top: 10px;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #dfe7e2;
            border-radius: 8px;
            padding: 8px 12px;
            margin-left: 8px;
            outline: none;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #28563e;
            box-shadow: 0 0 0 3px rgba(40, 86, 62, .10);
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dfe7e2;
            border-radius: 8px;
            padding: 7px 10px;
            margin: 0 5px;
            outline: none;
        }

        .dataTables_wrapper .dataTables_info {
            color: #6b7d72;
            font-size: 13px;
            padding-top: 15px;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 7px !important;
            border: 1px solid #dfe7e2 !important;
            margin-left: 4px;
            color: #28563e !important;
            background: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #edf4ef !important;
            color: #18392b !important;
            border-color: #cfe0d5 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #28563e !important;
            color: white !important;
            border-color: #28563e !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #aaa !important;
        }

        @media(max-width: 768px) {
            .berita-page {
                padding: 20px 14px;
            }

            .berita-header {
                padding: 20px;
            }

            .berita-card {
                padding: 15px;
            }

            .dataTables_wrapper .dataTables_filter {
                margin-top: 10px;
                text-align: left;
            }
        }
    </style>
@endpush

@section('content')
<div class="container-fluid py-4 berita-page">

    <!-- HEADER -->
    <div class="berita-header mb-4">
        <div>
            <h2>Kelola Berita</h2>
            <p>Kelola informasi dan berita sekolah.</p>
        </div>

        <i class="bi bi-newspaper header-icon"></i>
    </div>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- CARD BERITA -->
    <div class="berita-card">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h5 class="mb-1">
                    Daftar Berita
                </h5>

                <small class="text-muted">
                    Berita yang telah diterbitkan
                </small>
            </div>

            <a href="{{ route('berita.create') }}"
               class="btn btn-add">
                <i class="bi bi-plus-circle"></i>
                Tambah Berita
            </a>

        </div>

        <!-- TABEL BERITA -->
        <div class="table-responsive">

            <!-- PENTING: ID HARUS tabelBerita -->
            <table id="tabelBerita"
                   class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Isi Berita</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($berita as $item)

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
                                        alt="Gambar Berita"
                                        class="berita-image">

                                @else

                                    <div class="berita-placeholder">
                                        <i class="bi bi-image"></i>
                                    </div>

                                @endif

                            </td>

                            <!-- JUDUL -->
                            <td class="fw-semibold">
                                {{ $item->judul }}
                            </td>

                            <!-- TANGGAL -->
                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                            </td>

                            <!-- ISI BERITA -->
                            <td class="isi-berita">

                                {{ \Illuminate\Support\Str::limit($item->isi, 80) }}

                            </td>

                            <!-- AKSI -->
                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <!-- DETAIL -->
                                    <a
                                        href="{{ route('berita.show', Crypt::encryptString($item->id_berita)) }}"
                                        class="btn btn-sm btn-info text-white"
                                        title="Detail Berita">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <!-- EDIT -->
                                    <a
                                        href="{{ route('berita.edit', $item->id_berita) }}"
                                        class="btn btn-sm btn-edit"
                                        title="Edit">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <!-- HAPUS -->
                                    <form
                                        action="{{ route('berita.destroy', $item->id_berita) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus berita ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-delete"
                                            title="Hapus">

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

                                <i class="bi bi-newspaper fs-1 text-muted"></i>

                                <p class="text-muted mt-2 mb-0">
                                    Belum ada berita.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- TOTAL -->
        <div class="text-muted small mt-3">
            Total berita: {{ $berita->count() }}
        </div>

    </div>
</div>
@endsection

@push('scripts')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tabelBerita').DataTable({
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
                    searchPlaceholder: "Cari berita...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    zeroRecords: "Data berita tidak ditemukan",
                    emptyTable: "Belum ada data berita",
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
                        cell.innerHTML = info.start + i + 1;
                    });
                }
            });
        });
        // NOTIFIKASI HILANG 5 DETIK
        setTimeout(function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function () {
                    alert.remove();
                }, 500);
            }
        }, 5000);
    </script>
@endpush