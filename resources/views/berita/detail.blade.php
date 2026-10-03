@extends('admin_app')

@section('title', 'Detail Berita')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0" style="border-radius: 14px;">
        <div class="card-body p-4">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h4 class="fw-bold mb-1">Detail Berita</h4>
                    <p class="text-muted mb-0">
                        Informasi lengkap mengenai berita
                    </p>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="d-flex gap-2">
                    <a href="{{ route('berita.edit', $berita->id_berita) }}"
                       class="btn btn-edit">
                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Berita
                    </a>

                    <a href="{{ route('admin.berita') }}"
                       class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <hr>

            <!-- KONTEN BERITA -->
            <div class="row mt-4">

                <!-- GAMBAR BERITA -->
                <div class="col-md-4 text-center mb-4">
                    @if(!empty($berita->gambar))
                        <img
                            src="{{ asset('storage/' . $berita->gambar) }}"
                            alt="{{ $berita->judul }}"
                            class="img-fluid rounded shadow-sm"
                            style="width: 100%; max-height: 350px; object-fit: cover;"
                        >
                    @else
                        <div class="bg-light rounded p-5 text-muted">
                            <i class="bi bi-image fs-1"></i>
                            <p class="mb-0 mt-2">Tidak ada gambar</p>
                        </div>
                    @endif
                </div>

                <!-- INFORMASI BERITA -->
                <div class="col-md-8">
                    <h3 class="fw-bold mb-3">
                        {{ $berita->judul }}
                    </h3>

                    <!-- TANGGAL DAN PENULIS -->
                    <div class="text-muted mb-3">
                        <span class="me-3">
                            <i class="bi bi-calendar me-1"></i>
                            @if($berita->tanggal)
                                {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                            @else
                                -
                            @endif
                        </span>

                        <span>
                            <i class="bi bi-person me-1"></i>
                            {{ $berita->user->name ?? 'Admin' }}
                        </span>
                    </div>

                    <hr>

                    <!-- ISI BERITA -->
                    <h5 class="fw-semibold mb-3">Isi Berita</h5>

                    <div class="lh-base" style="white-space: pre-line;">
                        {{ $berita->isi }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>

/* TOMBOL EDIT */
.btn-edit {
    background: #28563e;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 16px;
    transition: .2s ease;
}

.btn-edit:hover {
    background: #18392b;
    color: white;
    transform: translateY(-2px);
}
</style>


@endsection