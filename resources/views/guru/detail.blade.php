@extends('admin_app')

<link rel="icon" type="image/png" href="{{ asset('assets/images/logo sekolah.jpg') }}">

@php
    use Illuminate\Support\Facades\Crypt;
@endphp

@section('title', $title ?? 'Detail Guru')

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="guru-header mb-4">
        <div>
            <h2>Detail Guru</h2>
            <p>Informasi lengkap mengenai guru sekolah.</p>
        </div>
        <i class="bi bi-person-workspace header-icon"></i>
    </div>

    <!-- CARD DETAIL -->
    <div class="guru-card">

        <!-- JUDUL CARD -->
        <div class="card-heading mb-4">
            <div>
                <h5 class="mb-1">
                    <i class="bi bi-info-circle me-2"></i>
                    Informasi Guru
                </h5>
                <p class="text-muted small mb-0">
                    Detail informasi guru yang dipilih
                </p>
            </div>

            <a href="{{ route('admin.guru') }}" class="btn btn-back">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>
        </div>

        <!-- ISI DETAIL -->
        <div class="row g-4">

            <!-- FOTO GURU -->
            <div class="col-md-4">
                <div class="guru-profile">
                    @if($guru->foto && file_exists(public_path('storage/' . $guru->foto)))
                        <img
                            src="{{ asset('storage/' . $guru->foto) }}"
                            alt="{{ $guru->nama_guru }}"
                            class="guru-photo">
                    @else
                        <div class="guru-photo-empty">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    @endif
                    <h4>{{ $guru->nama_guru }}</h4>

                    <span class="badge badge-mapel">
                        {{ $guru->mapel ?: 'Mata pelajaran belum diisi' }}
                    </span>

                    <p class="guru-nip mt-3 mb-0">
                        NIP: {{ $guru->nip ?: '-' }}
                    </p>
                </div>
            </div>

            <!-- INFORMASI GURU -->
            <div class="col-md-8">
                <div class="guru-information">

                    <h5 class="information-title">
                        Informasi Lengkap
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-borderless detail-table">
                            <tbody>
                                <tr>
                                    <th width="38%">Nama Lengkap</th>
                                    <td width="15px">:</td>
                                    <td>{{ $guru->nama_guru }}</td>
                                </tr>
                                <tr>
                                    <th>NIP</th>
                                    <td>:</td>
                                    <td>{{ $guru->nip ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <td>:</td>
                                    <td>
                                        <span class="badge badge-mapel">
                                            {{ $guru->mapel ?: '-' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat Pada</th>
                                    <td>:</td>
                                    <td>
                                        {{ $guru->created_at
                                            ? $guru->created_at->translatedFormat('d F Y, H:i')
                                            : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Terakhir Diperbarui</th>
                                    <td>:</td>
                                    <td>
                                        {{ $guru->updated_at
                                            ? $guru->updated_at->translatedFormat('d F Y, H:i')
                                            : '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
<!-- TOMBOL EDIT -->
<div class="mt-4 pt-3 border-top">
    <a href="{{ route('guru.edit', Crypt::encryptString((string) $guru->id_guru)) }}"
       class="btn btn-edit">
        <i class="bi bi-pencil-square me-1"></i>
        Edit Data Guru
    </a>
</div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- STYLE -->
<style>
/* HEADER */
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

/* CARD */
.guru-card {
    background: white;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
}

/* CARD HEADING */
.card-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    border-bottom: 1px solid #e8eee9;
    padding-bottom: 15px;
}

.card-heading h5 {
    color: #28563e;
    font-weight: 700;
}

/* PROFIL GURU */
.guru-profile {
    background: #f5f8f5;
    border: 1px solid #e5ece6;
    border-radius: 12px;
    padding: 25px 15px;
    text-align: center;
    height: 100%;
}

.guru-photo {
    width: 160px;
    height: 160px;
    object-fit: cover;
    border-radius: 50%;
    border: 5px solid white;
    box-shadow: 0 3px 12px rgba(0, 0, 0, .12);
    margin-bottom: 18px;
}

.guru-photo-empty {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    background: #e2ece5;
    color: #6b9278;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 18px;
    border: 5px solid white;
    box-shadow: 0 3px 12px rgba(0, 0, 0, .08);
}

.guru-photo-empty i {
    font-size: 75px;
}

.guru-profile h4 {
    color: #18392b;
    font-weight: 700;
    font-size: 20px;
    overflow-wrap: anywhere;
}

.guru-nip {
    color: #718078;
    font-size: 14px;
}

/* INFORMASI */
.guru-information {
    padding: 5px 10px;
}

.information-title {
    color: #28563e;
    font-weight: 700;
    border-bottom: 1px solid #e8eee9;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.detail-table th {
    color: #718078;
    font-weight: 600;
    padding-left: 0;
    white-space: nowrap;
}

.detail-table td {
    color: #34483b;
    overflow-wrap: anywhere;
}

/* BADGE */
.badge-mapel {
    background: #e2f3e8;
    color: #28563e;
    border: 1px solid #c7e6d0;
    padding: 7px 10px;
    border-radius: 6px;
}

/* TOMBOL KEMBALI */
.btn-back {
    background: #edf4ef;
    color: #28563e;
    border: 1px solid #d5e5d9;
    border-radius: 8px;
    padding: 9px 15px;
}

.btn-back:hover {
    background: #dcebe0;
    color: #18392b;
}

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

/* RESPONSIVE */
@media (max-width: 768px) {
    .guru-header {
        padding: 20px;
    }

    .guru-header h2 {
        font-size: 20px;
    }

    .guru-card {
        padding: 18px;
    }

    .card-heading {
        align-items: flex-start;
    }

    .guru-information {
        padding: 5px 0;
    }

    .detail-table th {
        white-space: normal;
    }
}
</style>
@endsection