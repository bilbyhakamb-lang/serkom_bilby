@extends('admin_app')

@section('title', $title)

@section('content')

<style>
    .dashboard-page {
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 30px;
        box-sizing: border-box;
    }

    .dashboard-header {
        margin-bottom: 24px;
    }

    .dashboard-header h2 {
        font-size: 26px;
        font-weight: 700;
        margin: 0 0 7px;
        color: #24352b;
    }

    .dashboard-header p {
        font-size: 14px;
        color: #7b857e;
        margin: 0;
    }

    .dashboard-welcome {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 28px 30px;
        margin-bottom: 25px;
        border-radius: 14px;
        background: linear-gradient(120deg, #194d35, #28764e);
        color: #fff;
        box-shadow: 0 5px 18px rgba(25, 77, 53, .12);
    }

    .dashboard-welcome::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .06);
        right: 65px;
        top: -125px;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-label {
        display: inline-block;
        padding: 6px 11px;
        margin-bottom: 12px;
        border-radius: 20px;
        background: rgba(255, 255, 255, .14);
        color: #e4f4e9;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .5px;
    }

    .welcome-content h3 {
        font-size: 23px;
        font-weight: 700;
        margin: 0 0 9px;
        color: #fff;
    }

    .welcome-content p {
        margin: 0;
        max-width: 560px;
        color: #e0eee4;
        font-size: 13px;
        line-height: 1.7;
    }

    .welcome-icon {
        position: relative;
        z-index: 1;
        width: 85px;
        height: 85px;
        min-width: 85px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        background: rgba(255, 255, 255, .13);
        color: #fff;
        font-size: 42px;
    }

    .section-title {
        font-size: 17px;
        font-weight: 700;
        color: #29382e;
        margin: 0 0 16px;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 28px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 17px;
        padding: 22px;
        background: #fff;
        border: 1px solid #e8ede9;
        border-radius: 13px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, .035);
        transition: transform .2s, box-shadow .2s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 18px rgba(0, 0, 0, .07);
    }

    .stat-icon {
        width: 58px;
        height: 58px;
        min-width: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 25px;
    }

    .stat-icon.siswa {
        color: #24804c;
        background: #e9f5ed;
    }

    .stat-icon.guru {
        color: #3973b9;
        background: #edf4fc;
    }

    .stat-info p {
        font-size: 13px;
        color: #7c867f;
        margin: 0 0 6px;
    }

    .stat-info h3 {
        font-size: 27px;
        font-weight: 700;
        line-height: 1;
        color: #26352d;
        margin: 0;
    }

    .quick-section {
        margin-bottom: 25px;
    }

    .quick-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .quick-card {
        display: flex;
        align-items: center;
        gap: 14px;
        min-height: 90px;
        padding: 17px;
        border: 1px solid #e8ede9;
        border-radius: 12px;
        background: #fff;
        text-decoration: none;
        box-shadow: 0 3px 12px rgba(0, 0, 0, .035);
        transition: .2s;
    }

    .quick-card:hover {
        transform: translateY(-3px);
        border-color: #b9d7c3;
        box-shadow: 0 7px 18px rgba(0, 0, 0, .07);
    }

    .quick-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 11px;
        background: #edf5ef;
        color: #28764e;
        font-size: 21px;
    }

    .quick-info {
        flex: 1;
        min-width: 0;
    }

    .quick-info h5 {
        font-size: 13px;
        font-weight: 650;
        color: #2d3a31;
        margin: 0 0 5px;
    }

    .quick-info p {
        font-size: 11px;
        color: #879088;
        margin: 0;
        line-height: 1.5;
    }

    .quick-arrow {
        color: #9ba69e;
        font-size: 14px;
    }

    .dashboard-note {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 17px 20px;
        border: 1px solid #e3ece5;
        border-radius: 11px;
        background: #f7faf7;
        color: #68766d;
        font-size: 12px;
        line-height: 1.6;
    }

    .dashboard-note i {
        color: #39865a;
        font-size: 19px;
    }

    @media (max-width: 900px) {
        .quick-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {
        .dashboard-page {
            padding: 20px 14px;
        }

        .dashboard-header h2 {
            font-size: 22px;
        }

        .dashboard-welcome {
            padding: 22px;
        }

        .welcome-content h3 {
            font-size: 19px;
        }

        .welcome-icon {
            width: 60px;
            height: 60px;
            min-width: 60px;
            font-size: 30px;
        }

        .dashboard-stats {
            gap: 12px;
        }

        .stat-card {
            align-items: flex-start;
            flex-direction: column;
            padding: 16px;
            gap: 12px;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;
            font-size: 20px;
        }

        .stat-info h3 {
            font-size: 23px;
        }

        .quick-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }

    @media (max-width: 380px) {
        .welcome-icon {
            display: none;
        }
    }
</style>

<div class="dashboard-page">

    <div class="dashboard-header">
        <h2>Dashboard</h2>
        <p>Ringkasan informasi dan pengelolaan data sekolah.</p>
    </div>

    <div class="dashboard-welcome">
        <div class="welcome-content">
            <span class="welcome-label">SISTEM INFORMASI SEKOLAH</span>
            <h3>Selamat Datang di Dashboard</h3>
            <p>
                Kelola informasi sekolah, data guru, siswa, berita,
                ekstrakurikuler, dan galeri dalam satu halaman.
            </p>
        </div>

        <div class="welcome-icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>
    </div>

    <h4 class="section-title">Statistik Sekolah</h4>

    <div class="dashboard-stats">

        <div class="stat-card">
            <div class="stat-icon siswa">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-info">
                <p>Total Siswa</p>
                <h3>{{ $jumlahSiswa }}</h3>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon guru">
                <i class="bi bi-person-workspace"></i>
            </div>
            <div class="stat-info">
                <p>Total Guru</p>
                <h3>{{ $jumlahGuru }}</h3>
            </div>
        </div>

    </div>

    <div class="quick-section">
        <h4 class="section-title">Akses Cepat</h4>

        <div class="quick-grid">

            <a href="{{ route('admin.profile') }}" class="quick-card">
                <div class="quick-icon">
                    <i class="bi bi-building"></i>
                </div>
                <div class="quick-info">
                    <h5>Profil Sekolah</h5>
                    <p>Kelola informasi sekolah</p>
                </div>
                <i class="bi bi-chevron-right quick-arrow"></i>
            </a>

            <a href="{{ route('admin.guru') }}" class="quick-card">
                <div class="quick-icon">
                    <i class="bi bi-person-gear"></i>
                </div>
                <div class="quick-info">
                    <h5>Data Guru</h5>
                    <p>Kelola data guru sekolah</p>
                </div>
                <i class="bi bi-chevron-right quick-arrow"></i>
            </a>

            <a href="{{ route('admin.siswa') }}" class="quick-card">
                <div class="quick-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="quick-info">
                    <h5>Data Siswa</h5>
                    <p>Kelola data siswa sekolah</p>
                </div>
                <i class="bi bi-chevron-right quick-arrow"></i>
            </a>

            <a href="{{ route('admin.berita') }}" class="quick-card">
                <div class="quick-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="quick-info">
                    <h5>Berita</h5>
                    <p>Kelola berita sekolah</p>
                </div>
                <i class="bi bi-chevron-right quick-arrow"></i>
            </a>

            <a href="{{ route('admin.ekstrakulikuler') }}" class="quick-card">
                <div class="quick-icon">
                    <i class="bi bi-trophy"></i>
                </div>
                <div class="quick-info">
                    <h5>Ekstrakurikuler</h5>
                    <p>Kelola kegiatan siswa</p>
                </div>
                <i class="bi bi-chevron-right quick-arrow"></i>
            </a>

            <a href="{{ route('admin.galeri') }}" class="quick-card">
                <div class="quick-icon">
                    <i class="bi bi-images"></i>
                </div>
                <div class="quick-info">
                    <h5>Galeri</h5>
                    <p>Kelola dokumentasi sekolah</p>
                </div>
                <i class="bi bi-chevron-right quick-arrow"></i>
            </a>

        </div>
    </div>

    <div class="dashboard-note">
        <i class="bi bi-info-circle-fill"></i>
        <span>
            Gunakan menu akses cepat untuk membuka dan mengelola
            informasi sekolah sesuai kebutuhan.
        </span>
    </div>

</div>

@endsection