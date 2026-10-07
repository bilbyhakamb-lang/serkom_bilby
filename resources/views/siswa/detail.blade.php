@extends('admin_app')

<link rel="icon" type="image/png" href="{{ asset('assets/images/logo sekolah.jpg') }}">

@php
    use Illuminate\Support\Facades\Crypt;
@endphp

@section('title', $title ?? 'Detail Data Siswa')

@section('content')
<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="siswa-header mb-4">
        <div>
            <h2>Detail Siswa</h2>
            <p>Informasi lengkap mengenai siswa sekolah.</p>
        </div>
        <i class="bi bi-person-vcard header-icon"></i>
    </div>

    <!-- CARD DETAIL SISWA -->
    <div class="siswa-card">

        <!-- JUDUL -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h5 class="mb-1">
                    <i class="bi bi-info-circle me-2"></i>
                    Informasi Siswa
                </h5>
                <small class="text-muted">
                    Detail informasi siswa yang dipilih
                </small>
            </div>

            <a href="{{ route('admin.siswa') }}" class="btn btn-back">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>
        </div>

        <hr>

        <!-- KONTEN DETAIL -->
        <div class="row g-4 mt-2">

            <!-- PROFIL SISWA -->
            <div class="col-md-4">
                <div class="siswa-profile">
                    <div class="siswa-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <h5 class="fw-bold mt-3 mb-2">
                        {{ $siswa->nama_siswa }}
                    </h5>

                    <span class="badge bg-success-subtle text-success border">
                        {{ $siswa->jenis_kelamin }}
                    </span>

                    <p class="text-muted mt-3 mb-0">
                        NISN: {{ $siswa->nisn }}
                    </p>
                </div>
            </div>

            <!-- INFORMASI LENGKAP -->
            <div class="col-md-8">
                <h5 class="fw-bold mb-3">Informasi Lengkap</h5>
                <hr>

                <div class="info-row">
                    <span>Nama Lengkap</span>
                    <strong>{{ $siswa->nama_siswa }}</strong>
                </div>

                <div class="info-row">
                    <span>NISN</span>
                    <strong>{{ $siswa->nisn }}</strong>
                </div>

                <div class="info-row">
                    <span>Jenis Kelamin</span>
                    <strong>{{ $siswa->jenis_kelamin }}</strong>
                </div>

                <div class="info-row">
                    <span>Tahun Masuk</span>
                    <strong>{{ $siswa->tahun_masuk }}</strong>
                </div>

                <!-- TOMBOL EDIT -->
                <div class="mt-4 pt-3 border-top">
                    <a href="{{ route('siswa.form', Crypt::encrypt($siswa->id_siswa)) }}"
                       class="btn btn-edit">
                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Data Siswa
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- CSS -->
<style>
.siswa-header {
    background: linear-gradient(135deg, #18392b, #32634a);
    color: white;
    padding: 25px 30px;
    border-radius: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.siswa-header h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 6px;
}

.siswa-header p {
    margin: 0;
    color: #dce9df;
}

.header-icon {
    font-size: 42px;
    opacity: .85;
}

.siswa-card {
    width: 100%;
    background: white;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
}

.siswa-card h5 {
    color: #263b30;
}

.siswa-profile {
    height: 100%;
    min-height: 300px;
    background: #f4f8f5;
    border: 1px solid #dce9df;
    border-radius: 12px;
    padding: 30px 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.siswa-avatar {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: #dce9df;
    color: #28563e;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 55px;
}

.info-row {
    display: flex;
    align-items: center;
    gap: 20px;
    background: #fafafa;
    border: 1px solid #e8ece9;
    border-radius: 9px;
    padding: 14px;
    margin-bottom: 10px;
}

.info-row span {
    width: 40%;
    color: #66736b;
}

.info-row strong {
    flex: 1;
    color: #263b30;
    font-weight: 600;
}

.btn-back {
    background: #edf4ef;
    color: #28563e;
    border: 1px solid #d9e8dc;
    border-radius: 8px;
}

.btn-back:hover {
    background: #dce9df;
    color: #18392b;
}

.btn-edit {
    background: #28563e;
    color: white;
    border-radius: 8px;
    padding: 10px 16px;
}

.btn-edit:hover {
    background: #18392b;
    color: white;
}

@media (max-width: 768px) {
    .siswa-header {
        padding: 20px;
    }

    .siswa-card {
        padding: 15px;
    }

    .info-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }

    .info-row span {
        width: 100%;
    }
}
</style>
@endsection