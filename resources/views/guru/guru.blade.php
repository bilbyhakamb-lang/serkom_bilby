@extends('admin_app')

@section('title', 'Kelola Guru')

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

    <!-- PESAN -->
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

    <!-- DAFTAR GURU -->
    <div class="guru-card">

        <div class="d-flex justify-content-between
                    align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h5 class="mb-1">Data Guru</h5>
                <small class="text-muted">
                    Daftar guru yang terdaftar
                </small>
            </div>

            <!-- TOMBOL TAMBAH GURU -->
            <a href="{{ route('guru.create') }}"
               class="btn btn-add">
                <i class="bi bi-plus-circle"></i>
                Tambah Guru
            </a>
        </div>

        <!-- TABEL DATA GURU -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Mata Pelajaran</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($guru as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <!-- FOTO GURU -->
                            <td>
                                @if($item->foto)
                                    <img
                                        src="{{ asset('storage/'.$item->foto) }}"
                                        alt="Foto Guru"
                                        class="guru-photo">
                                @else
                                    <div class="guru-placeholder">
                                        <i class="bi bi-person"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- NAMA GURU -->
                            <td class="fw-semibold">
                                {{ $item->nama_guru }}
                            </td>

                            <!-- NIP -->
                            <td>{{ $item->nip ?? '-' }}</td>

                            <!-- MATA PELAJARAN -->
                            <td>{{ $item->mapel }}</td>

                            <!-- AKSI -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <!-- TOMBOL EDIT -->
                                    <a href="{{ route('guru.edit', $item->id_guru) }}"
                                       class="btn btn-sm btn-edit"
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- TOMBOL HAPUS -->
                                    <form
                                        action="{{ route('guru.destroy', $item->id_guru) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
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
                                <i class="bi bi-person-x fs-1 text-muted"></i>
                                <p class="text-muted mt-2 mb-0">
                                    Belum ada data guru.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TOTAL GURU -->
        <div class="text-muted small mt-3">
            Total guru: {{ $guru->count() }}
        </div>

    </div>
</div>

<!-- CSS -->
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
    box-shadow: 0 3px 15px rgba(0,0,0,.06);
}

.guru-card h5 {
    color: #263b30;
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
    .guru-header {
        padding: 20px;
    }

    .guru-card {
        padding: 15px;
    }
}
</style>
@endsection
