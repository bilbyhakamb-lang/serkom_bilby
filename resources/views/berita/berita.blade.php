
@extends('admin_app')

@section('title', $title)

@section('content')
<div class="container-fluid py-4 berita-page">

    <div class="berita-header mb-4">
        <div>
            <h2>Kelola Berita</h2>
            <p>Kelola informasi dan berita sekolah.</p>
        </div>
        <i class="bi bi-newspaper header-icon"></i>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="berita-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h5 class="mb-1">Daftar Berita</h5>
                <small class="text-muted">Berita yang telah diterbitkan</small>
            </div>

            <a href="{{ route('berita.create') }}" class="btn btn-add">
                <i class="bi bi-plus-circle"></i>
                Tambah Berita
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
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
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                @if($item->gambar)
                                    <img
                                        src="{{ asset('storage/'.$item->gambar) }}"
                                        alt="Gambar Berita"
                                        class="berita-image">
                                @else
                                    <div class="berita-placeholder">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>

                            <td class="fw-semibold">
                                {{ $item->judul }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                            </td>

                            <td class="isi-berita">
                                {{ \Illuminate\Support\Str::limit($item->isi, 80) }}
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a
                                        href="{{ route('berita.edit', $item->id_berita) }}"
                                        class="btn btn-sm btn-edit"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

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
                            <td colspan="6" class="text-center py-5">
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

        <div class="text-muted small mt-3">
            Total berita: {{ $berita->count() }}
        </div>
    </div>
</div>

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
    width: 100%;
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
}
</style>
@endsection