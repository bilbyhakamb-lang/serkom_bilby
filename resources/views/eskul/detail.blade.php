@extends('admin_app')

@section('title', 'Detail Ekstrakurikuler')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">

                    <!-- Header -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap pb-3 mb-4 border-bottom">
                        <div>
                            <h3 class="fw-bold text-dark mb-1">
                                <i class="bi bi-eye text-success me-2"></i>
                                Detail Ekstrakurikuler
                            </h3>
                            <p class="text-muted small mb-0">
                                Informasi lengkap kegiatan ekstrakurikuler sekolah
                            </p>
                        </div>

                        <a href="{{ url('/ekstrakulikuler') }}"
                           class="btn btn-outline-secondary btn-sm rounded-pill px-3 mt-2">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    <!-- Foto -->
                    <div class="text-center mb-4">
                        @if(!empty($ekstrakurikuler->gambar))
                            <img
                                src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}"
                                alt="Foto Ekstrakurikuler"
                                width="120"
                                height="120"
                                class="rounded-circle object-fit-cover shadow-sm border">
                        @else
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center text-success fw-bold shadow-sm border"
                                 style="width: 120px; height: 120px; font-size: 40px;">
                                {{ strtoupper(substr($ekstrakurikuler->nama_ekskul ?? 'E', 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <!-- Informasi -->
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <tr>
                                <th width="35%" class="text-muted ps-0">
                                    Nama Ekstrakurikuler
                                </th>
                                <td class="fw-bold text-dark">
                                    : {{ $ekstrakurikuler->nama_ekskul }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted ps-0">Pembina</th>
                                <td class="text-dark">
                                    : {{ $ekstrakurikuler->pembina ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted ps-0">Jadwal Latihan</th>
                                <td class="text-dark">
                                    : {{ $ekstrakurikuler->jadwal_latihan ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted ps-0 align-top">Deskripsi</th>
                                <td class="text-dark align-top">
                                    : <span class="text-break">
                                        {{ $ekstrakurikuler->deskripsi ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection