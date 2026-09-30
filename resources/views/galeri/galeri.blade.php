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

    <!-- CARD GALERI -->
    <div class="galeri-card">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div class="card-heading">
                <i class="bi bi-image"></i>
                <h5 class="mb-0">Data Galeri</h5>
            </div>

            <a href="{{ route('galeri.create') }}" class="btn btn-add">
                <i class="bi bi-plus-circle"></i>
                Tambah Galeri
            </a>
        </div>

        <!-- NOTIFIKASI -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABEL -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>File</th>
                        <th>Judul</th>
                        <th>Keterangan</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($galeri as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if($item->kategori === 'Foto')
                                <img
                                    src="{{ asset('storage/'.$item->file) }}"
                                    class="galeri-image"
                                    alt="{{ $item->judul }}">
                            @else
                                <video class="galeri-image" controls>
                                    <source src="{{ asset('storage/'.$item->file) }}">
                                    Browser tidak mendukung video.
                                </video>
                            @endif
                        </td>

                        <td class="fw-semibold">
                            {{ $item->judul }}
                        </td>

                        <td>
                            {{ Str::limit($item->keterangan, 50) }}
                        </td>

                        <td>
                            <span class="badge-kategori">
                                {{ $item->kategori }}
                            </span>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('galeri.edit', Crypt::encryptString((string) $item->id_galeri)) }}"
                                   class="btn btn-edit"
                                   title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('galeri.destroy', Crypt::encryptString((string) $item->id_galeri)) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-delete"
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-images fs-1 d-block mb-2"></i>
                            Belum ada data galeri.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
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

.galeri-card {
    background: white;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 3px 15px rgba(0,0,0,.06);
}

.card-heading {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #28563e;
}

.card-heading i {
    font-size: 22px;
}

.card-heading h5 {
    font-weight: 700;
}

.table thead th {
    background: #f1f6f2;
    color: #28563e;
    white-space: nowrap;
    padding: 14px;
}

.table tbody td {
    padding: 14px;
}

.galeri-image {
    width: 85px;
    height: 65px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #d9e8dc;
}

.badge-kategori {
    background: #e3f1e7;
    color: #28563e;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.btn-add {
    background: #28563e;
    color: white;
    border-radius: 8px;
    padding: 10px 18px;
}

.btn-add:hover {
    background: #18392b;
    color: white;
}

.btn-edit {
    background: #e3f1e7;
    color: #28563e;
}

.btn-delete {
    background: #fce8e8;
    color: #dc2626;
}

.btn-edit, .btn-delete {
    border-radius: 7px;
}

@media(max-width: 768px) {
    .galeri-header {
        padding: 20px;
    }

    .galeri-card {
        padding: 15px;
    }
}
</style>
@endsection