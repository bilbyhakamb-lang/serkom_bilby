
@extends('admin_app')

@php
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Support\Str;
@endphp

@section('title', 'Kelola Galeri')

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="galeri-header mb-4">
        <div>
            <h2>Kelola Galeri</h2>
            <p>Kelola foto dan dokumentasi kegiatan sekolah.</p>
        </div>
        <i class="bi bi-images header-icon"></i>
    </div>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif

    <!-- CARD GALERI -->
    <div class="galeri-card">

        <!-- JUDUL CARD -->
        <div class="card-heading mb-4">
            <i class="bi bi-info-circle"></i>
            <h5 class="mb-0">Data Galeri</h5>

            <div class="ms-auto">
                <a href="{{ route('galeri.create') }}" class="btn btn-add">
                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Galeri
                </a>
            </div>
        </div>

        <!-- TABEL DATA -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="100">File</th>
                        <th>Judul</th>
                        <th>Keterangan</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th class="text-center" width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($galeri as $item)
                        <tr>
                            <!-- NOMOR -->
                            <td>{{ $loop->iteration }}</td>

                            <!-- FILE -->
                            <td>
                                @if($item->kategori === 'Foto')
                                    <img
                                        src="{{ asset('storage/' . $item->file) }}"
                                        class="galeri-image"
                                        alt="{{ $item->judul }}">
                                @else
                                    <video class="galeri-image" controls>
                                        <source
                                            src="{{ asset('storage/' . $item->file) }}"
                                            type="video/mp4">
                                        Browser tidak mendukung video.
                                    </video>
                                @endif
                            </td>

                            <!-- JUDUL -->
                            <td class="fw-semibold">
                                {{ $item->judul }}
                            </td>

                            <!-- KETERANGAN -->
                            <td>
                                {{ Str::limit($item->keterangan, 50) }}
                            </td>

                            <!-- KATEGORI -->
                            <td>
                                <span class="badge-kategori">
                                    {{ $item->kategori }}
                                </span>
                            </td>

                            <!-- TANGGAL -->
                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                            </td>

                            <!-- TOMBOL AKSI -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <!-- DETAIL -->
                                    <a
                                        href="{{ route('admin.galeri.detail', Crypt::encryptString((string) $item->id_galeri)) }}"
                                        class="btn action-btn btn-detail"
                                        title="Detail Galeri">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!-- EDIT -->
                                    <a
                                        href="{{ route('galeri.edit', Crypt::encryptString((string) $item->id_galeri)) }}"
                                        class="btn action-btn btn-edit"
                                        title="Edit Galeri">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- HAPUS -->
                                    <form
                                        action="{{ route('galeri.destroy', Crypt::encryptString((string) $item->id_galeri)) }}"
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
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-images empty-icon d-block mb-2"></i>
                                Belum ada data galeri.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TOTAL DATA -->
        <div class="text-muted small mt-3">
            Total galeri: {{ $galeri->count() }} data
        </div>

    </div>
</div>

<!-- STYLE -->
<style>
/* HEADER */
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
}

.header-icon {
    font-size: 42px;
    opacity: .85;
}

/* CARD */
.galeri-card {
    background: white;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
}

/* JUDUL CARD */
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

/* TABEL */
.table thead th {
    background: #edf4ef;
    color: #28563e;
    font-size: 14px;
    white-space: nowrap;
    padding: 14px;
}

.table tbody td {
    color: #34483b;
    font-size: 14px;
    padding: 14px;
    vertical-align: middle;
}

/* GAMBAR DAN VIDEO */
.galeri-image {
    width: 85px;
    height: 65px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #d9e8dc;
}

/* BADGE KATEGORI */
.badge-kategori {
    display: inline-block;
    background: #e3f1e7;
    color: #28563e;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* TOMBOL TAMBAH */
.btn-add {
    background: #28563e;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 16px;
    transition: .2s ease;
}

.btn-add:hover {
    background: #18392b;
    color: white;
}

/* TOMBOL AKSI */
.action-btn {
    width: 38px;
    height: 38px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    border-radius: 8px;
    transition: .2s ease;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, .15);
}

/* DETAIL - BIRU TOSKA */
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

/* HAPUS */
.btn-delete {
    background: #fce8e8;
    color: #b42318;
}

.btn-delete:hover {
    background: #f8d4d4;
    color: #912018;
}

/* DATA KOSONG */
.empty-icon {
    font-size: 42px;
    color: #9aafa0;
}

/* RESPONSIVE */
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

    .table {
        min-width: 800px;
    }
}
</style>

<!-- NOTIFIKASI HILANG OTOMATIS -->
<script>
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

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#tabelGuru').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: [1, 5] }  // Foto & Aksi tidak bisa disort
            ],
            language: {
                search: "",
                searchPlaceholder: "Cari nama guru...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                zeroRecords: "Data guru tidak ditemukan",
                emptyTable: "Belum ada data guru",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Next",
                    previous: "Prev"
                }
            },
            drawCallback: function () {
                const api = this.api();
                api.column(0, { page: 'current' }).nodes().each(function (cell, i) {
                    const info = api.page.info();
                    cell.innerHTML = info.start + i + 1;
                });
            }
        });
    });
</script>
@endpush