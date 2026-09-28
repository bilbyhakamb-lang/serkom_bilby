@extends('admin_app')

@section('content')
<th>Ini Halaman Siswa</th>

<div class="container">

    <h2 style="margin-bottom: 20px;">Kelola Data Siswa</h2>

    <!-- FORM TAMBAH SISWA -->
    <div style="
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    ">

        <h3 style="margin-bottom: 15px;">Tambah Data Siswa</h3>

        <form action="{{ route('siswa.store') }}" method="POST">
            @csrf

            <div style="display: flex; gap: 15px; flex-wrap: wrap;">

                <input
                    type="text"
                    name="nisn"
                    placeholder="NISN"
                    style="padding: 10px; width: 150px;"
                >

                <input
                    type="text"
                    name="nama_siswa"
                    placeholder="Nama Siswa"
                    style="padding: 10px; width: 200px;"
                >

                <select
                    name="jenis_kelamin"
                    style="padding: 10px; width: 180px;"
                >
                    <option value="">Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>

                <input
                    type="number"
                    name="tahun_masuk"
                    placeholder="Tahun Masuk"
                    style="padding: 10px; width: 150px;"
                >

                <button
                    type="submit"
                    style="
                        padding: 10px 20px;
                        background: #a85cff;
                        color: white;
                        border: none;
                        border-radius: 6px;
                    "
                >
                    + Tambah Siswa
                </button>

            </div>

        </form>

    </div>


    <!-- TABEL DATA SISWA -->
    <div style="
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    ">

        <h3 style="margin-bottom: 15px;">Data Siswa</h3>

        <table style="
            width: 100%;
            border-collapse: collapse;
        ">

            <tr style="background: #000000; color: white;">

                <th style="padding: 12px;">No</th>
                <th style="padding: 12px;">NISN</th>
                <th style="padding: 12px;">Nama Siswa</th>
                <th style="padding: 12px;">Jenis Kelamin</th>
                <th style="padding: 12px;">Tahun Masuk</th>

            </tr>


        </table>

    </div>

</div>

@endsection