
@extends('admin_app')

@section('title', $title)

@section('content')

<style>
    .siswa-page {
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 30px;
        box-sizing: border-box;
        color: #26352d;
}

    .siswa-heading {
        margin-bottom: 25px;
    }

    .siswa-heading h2 {
        font-size: 26px;
        font-weight: 700;
        margin: 0 0 7px;
        color: #24352b;
    }

    .siswa-heading p {
        font-size: 14px;
        color: #7b857e;
        margin: 0;
    }

    .siswa-card {
        background: #fff;
        width: 100%;
        border: 1px solid #e7ebe8;
        border-radius: 14px;
        box-shadow: 0 3px 14px rgba(0, 0, 0, .04);
        overflow: hidden;
    }

    .siswa-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        border-bottom: 1px solid #edf0ed;
    }

    .siswa-toolbar h4 {
        font-size: 18px;
        font-weight: 650;
        margin: 0;
        color: #26352d;
    }

    .siswa-toolbar-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .siswa-search {
        width: 230px;
        position: relative;
    }

    .siswa-search i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #849087;
        font-size: 14px;
    }

    .siswa-search input {
        width: 100%;
        height: 39px;
        padding: 8px 12px 8px 34px;
        border: 1px solid #e0e6e1;
        border-radius: 8px;
        outline: none;
        font-size: 13px;
        box-sizing: border-box;
        background: #fff;
    }

    .siswa-search input:focus {
        border-color: #39865a;
        box-shadow: 0 0 0 3px rgba(57, 134, 90, .10);
    }

    .btn-tambah-siswa {
        height: 39px;
        padding: 0 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: none;
        border-radius: 8px;
        background: #159b68;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: .2s;
    }

    .btn-tambah-siswa:hover {
        background: #117d54;
        color: #fff;
    }

    .siswa-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .siswa-table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
        margin: 0;
    }

    .siswa-table thead {
        background: #f7f9f8;
    }

    .siswa-table th {
        padding: 15px 18px;
        text-align: left;
        color: #68766d;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .5px;
        text-transform: uppercase;
        border-bottom: 1px solid #e7ebe8;
        white-space: nowrap;
    }

    .siswa-table td {
        padding: 16px 18px;
        font-size: 13px;
        color: #354239;
        border-bottom: 1px solid #edf0ed;
        vertical-align: middle;
    }

    .siswa-table tbody tr:hover {
        background: #f8fbf9;
    }

    .siswa-table tbody tr:last-child td {
        border-bottom: none;
    }

    .siswa-no {
        color: #879188 !important;
        width: 60px;
    }

    .siswa-nisn {
        font-weight: 600;
        color: #34453a !important;
        white-space: nowrap;
    }

    .siswa-nama {
        font-weight: 600;
        color: #27372d !important;
        min-width: 180px;
    }

    .gender-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .gender-laki {
        background: #eaf4ee;
        color: #27804d;
    }

    .gender-perempuan {
        background: #f4edf8;
        color: #8953a4;
    }

    .siswa-tahun {
        white-space: nowrap;
    }

    .siswa-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .btn-aksi {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        border: 1px solid #e5e9e6;
        background: #fff;
        font-size: 13px;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .btn-edit {
        color: #27804d;
    }

    .btn-edit:hover {
        background: #eaf4ee;
        border-color: #b8d8c3;
    }

    .btn-hapus {
        color: #d64545;
    }

    .btn-hapus:hover {
        background: #fff0f0;
        border-color: #f0c4c4;
    }

    .siswa-empty {
        padding: 38px 15px !important;
        text-align: center;
        color: #89928b !important;
        font-size: 13px !important;
    }

    .siswa-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 22px;
        border-top: 1px solid #edf0ed;
        color: #758078;
        font-size: 12px;
    }

    .siswa-alert {
        padding: 12px 16px;
        margin-bottom: 18px;
        border-radius: 8px;
        background: #eaf6ee;
        color: #247344;
        font-size: 13px;
    }

    .siswa-alert-error {
        background: #fff0f0;
        color: #b52e38;
    }

    @media (max-width: 768px) {
        .siswa-page {
            padding: 20px 14px;
        }

        .siswa-heading h2 {
            font-size: 22px;
        }

        .siswa-toolbar {
            align-items: flex-start;
            flex-direction: column;
            padding: 16px;
        }

        .siswa-toolbar-actions {
            width: 100%;
        }

        .siswa-search {
            width: 100%;
            flex: 1;
        }

        .siswa-footer {
            padding: 14px 16px;
        }
    }

    @media (max-width: 480px) {
        .siswa-toolbar-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .siswa-search {
            width: 100%;
        }

        .btn-tambah-siswa {
            width: 100%;
        }
    }
</style>

<div class="siswa-page">

    <div class="siswa-heading">
        <h2>Kelola Data Siswa</h2>
        <p>Kelola dan lihat informasi data siswa sekolah.</p>
    </div>

    @if (session('success'))
        <div class="siswa-alert">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="siswa-alert siswa-alert-error">
            <i class="bi bi-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="siswa-card">

        <div class="siswa-toolbar">
            <h4>Daftar Siswa</h4>

            <div class="siswa-toolbar-actions">
                <div class="siswa-search">
                    <i class="bi bi-search"></i>
                    <input type="text" id="cariSiswa"
                           placeholder="Cari nama atau NISN...">
                </div>

                <a href="{{ route('siswa.form') }}" class="btn-tambah-siswa">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Siswa
                </a>
            </div>
        </div>

        <div class="siswa-table-wrap">
            <table class="siswa-table" id="tabelSiswa">
                <thead>
                    <tr>
                        <th style="width: 65px;">No</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun Masuk</th>
                        <th style="width: 115px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($siswa as $item)
                        <tr class="siswa-row">
                            <td class="siswa-no">{{ $loop->iteration }}</td>
                            <td class="siswa-nisn">{{ $item->nisn }}</td>
                            <td class="siswa-nama">{{ $item->nama_siswa }}</td>
                            <td>
                                @if ($item->jenis_kelamin == 'Laki-Laki')
                                    <span class="gender-badge gender-laki">
                                        Laki-Laki
                                    </span>
                                @else
                                    <span class="gender-badge gender-perempuan">
                                        Perempuan
                                    </span>
                                @endif
                            </td>
                            <td class="siswa-tahun">{{ $item->tahun_masuk }}</td>
                            <td>
                                <div class="siswa-actions">
                                    <a href="{{ route('siswa.form', encrypt($item->id_siswa)) }}"
                                       class="btn-aksi btn-edit"
                                       title="Edit data">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('siswa.destroy', encrypt($item->id_siswa)) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn-aksi btn-hapus"
                                                title="Hapus data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="6" class="siswa-empty">
                                <i class="bi bi-people" style="font-size: 24px; display: block; margin-bottom: 8px;"></i>
                                Belum ada data siswa.
                            </td>
                        </tr>
                    @endforelse

                    <tr id="hasilKosong" style="display: none;">
                        <td colspan="6" class="siswa-empty">
                            Data siswa tidak ditemukan.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="siswa-footer">
            <span>Jumlah siswa: {{ $siswa->count() }}</span>
            <span>Data siswa sekolah</span>
        </div>

    </div>
</div>

<script>
    document.getElementById('cariSiswa').addEventListener('input', function () {
        const kataKunci = this.value.toLowerCase().trim();
        const baris = document.querySelectorAll('#tabelSiswa .siswa-row');
        let jumlahTampil = 0;

        baris.forEach(function (row) {
            const cocok = row.textContent.toLowerCase().includes(kataKunci);
            row.style.display = cocok ? '' : 'none';

            if (cocok) {
                jumlahTampil++;
            }
        });

        const hasilKosong = document.getElementById('hasilKosong');
        hasilKosong.style.display =
            (jumlahTampil === 0 && baris.length > 0) ? '' : 'none';
    });
</script>

@endsection