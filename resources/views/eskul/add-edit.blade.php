@extends('admin_app')

@section('title', $title)

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="eskul-header mb-4">
        <div>
            <h2>{{ $eskul->exists ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler' }}</h2>
            <p>Lengkapi informasi data ekstrakurikuler sekolah.</p>
        </div>
        <i class="bi bi-trophy header-icon"></i>
    </div>

    <!-- FORM -->
    <div class="eskul-card">

        <div class="card-heading mb-4">
            <i class="bi bi-info-circle"></i>
            <h5 class="mb-0">Informasi Ekstrakurikuler</h5>
        </div>

        <!-- ERROR -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM TAMBAH / EDIT -->
        <form action="{{ $eskul->exists
            ? route('eskul.update', ['id' => $eskul->id_ekskul])
            : route('eskul.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @if($eskul->exists)
                @method('PUT')
            @endif

            <div class="row g-3">

                <!-- NAMA ESKUL -->
                <div class="col-md-6">
                    <label class="form-label">Nama Ekstrakurikuler</label>
                    <input type="text"
                           name="nama_ekskul"
                           class="form-control"
                           value="{{ old('nama_ekskul', $eskul->nama_ekskul) }}"
                           placeholder="Masukkan nama ekstrakurikuler"
                           maxlength="40"
                           required>
                </div>

                <!-- PEMBINA -->
                <div class="col-md-6">
                    <label class="form-label">Nama Pembina</label>
                    <input type="text"
                           name="pembina"
                           class="form-control"
                           value="{{ old('pembina', $eskul->pembina) }}"
                           placeholder="Masukkan nama pembina"
                           maxlength="40"
                           required>
                </div>

                <!-- JADWAL -->
                <div class="col-12">
                    <label class="form-label">Jadwal Kegiatan</label>
                    <input type="text"
                           name="jadwal_latihan"
                           class="form-control"
                           value="{{ old('jadwal_latihan', $eskul->jadwal_latihan) }}"
                           placeholder="Contoh: Jumat, 14.00 - 16.00"
                           maxlength="40"
                           required>
                </div>

                <!-- DESKRIPSI -->
                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4"
                              placeholder="Masukkan deskripsi ekstrakurikuler"
                              required>{{ old('deskripsi', $eskul->deskripsi) }}</textarea>
                </div>

                <!-- GAMBAR -->
                <div class="col-12">
                    <label class="form-label">Gambar</label>
                    <input type="file"
                           name="gambar"
                           class="form-control"
                           accept="image/jpg,image/jpeg,image/png,image/webp"
                           {{ $eskul->exists ? '' : 'required' }}>

                    @if($eskul->exists && $eskul->gambar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$eskul->gambar) }}"
                                 alt="gambar"
                                 style="max-height:120px;border-radius:8px;">
                        </div>
                    @endif
                </div>

            </div>

            <!-- TOMBOL -->
            <div class="form-footer mt-4">
                <a href="{{ route('admin.ekstrakulikuler') }}"
                   class="btn btn-cancel">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit" class="btn btn-save">
                    <i class="bi bi-save"></i>
                    {{ $eskul->exists ? 'Simpan Perubahan' : 'Simpan Eskul' }}
                </button>
            </div>

        </form>
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

.card-heading i {
    font-size: 22px;
}

.card-heading h5 {
    font-weight: 700;
}

.form-label {
    color: #34483b;
    font-weight: 600;
    font-size: 14px;
}

.form-control {
    border: 1px solid #dce4de;
    border-radius: 8px;
    padding: 10px 12px;
}

.form-control:focus {
    border-color: #4d8061;
    box-shadow: 0 0 0 3px rgba(77,128,97,.12);
}

.form-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    border-top: 1px solid #e8eee9;
    padding-top: 20px;
}

.btn-save,
.btn-cancel {
    border-radius: 8px;
    padding: 10px 20px;
}

.btn-save {
    background: #28563e;
    color: white;
    border: 0;
}

.btn-save:hover {
    background: #18392b;
    color: white;
}

.btn-cancel {
    background: #edf0ed;
    color: #34483b;
}

.btn-cancel:hover {
    background: #dce4de;
    color: #18392b;
}

@media(max-width: 768px) {
    .eskul-header {
        padding: 20px;
    }

    .eskul-card {
        padding: 18px;
    }
}
</style>
@endsection