@extends('admin_app')

@section('title', 'Kelola Ekstrakurikuler')

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="eskul-header mb-4">
        <div>
            <h2>Kelola Ekstrakurikuler</h2>
            <p>Kelola data kegiatan ekstrakurikuler sekolah.</p>
        </div>
        <i class="bi bi-trophy header-icon"></i>
    </div>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- CARD DATA -->
    <div class="eskul-card">

        <div class="card-heading mb-4">
            <i class="bi bi-info-circle"></i>
            <h5 class="mb-0">Informasi Ekstrakurikuler</h5>
            <div class="ms-auto">
                <a href="{{ route('eskul.create') }}"
                   class="btn btn-add">
                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Eskul
                </a>
            </div>
        </div>

        <!-- TABEL -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="90">Gambar</th>
                        <th>Nama Eskul</th>
                        <th>Pembina</th>
                        <th>Jadwal</th>
                        <th>Deskripsi</th>
                        <th class="text-center" width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($eskul as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- GAMBAR --}}
                            <td>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}"
                                         alt="{{ $item->nama_ekskul }}"
                                         style="width:80px;height:60px;object-fit:cover;border-radius:6px;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td class="fw-semibold">
                                {{ $item->nama_ekskul }}
                            </td>
                            <td>{{ $item->pembina }}</td>
                            <td>{{ $item->jadwal_latihan }}</td>
                            <td>{{ $item->deskripsi ?: '-' }}</td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('eskul.edit', ['id' => $item->getKey()]) }}"
                                       class="btn btn-edit btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('eskul.destroy', ['id' => $item->getKey()]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-delete btn-sm">
                                            <i class="bi bi-trash"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
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

        <div class="text-muted small mt-3">
            Total ekstrakurikuler: {{ $eskul->count() }} data
        </div>
    </div>
</div>

<style>
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

.eskul-card {
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
    border-bottom: 1px solid #e8eee9;
    padding-bottom: 15px;
}

.card-heading > i {
    font-size: 22px;
}

.card-heading h5 {
    font-weight: 700;
}

.table thead th {
    background: #edf4ef;
    color: #28563e;
    font-size: 14px;
    white-space: nowrap;
}

.table tbody td {
    color: #34483b;
    font-size: 14px;
}

.btn-add {
    background: #28563e;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 16px;
}

.btn-add:hover {
    background: #18392b;
    color: white;
}

.btn-edit {
    background: #e7f0e9;
    color: #28563e;
    border-radius: 7px;
}

.btn-edit:hover {
    background: #d2e5d7;
    color: #18392b;
}

.btn-delete {
    background: #fce8e8;
    color: #b42318;
    border-radius: 7px;
}

.btn-delete:hover {
    background: #f8d4d4;
    color: #912018;
}

.empty-icon {
    font-size: 42px;
    color: #9aafa0;
}

@media(max-width: 768px) {
    .eskul-header {
        padding: 20px;
    }

    .eskul-card {
        padding: 18px;
    }

    .card-heading {
        flex-wrap: wrap;
    }
}
</style>
@endsection