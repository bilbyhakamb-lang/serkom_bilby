@extends('admin_app')

@section('content')
<th>Ini Halaman Guru</th>

{{-- <div class="container">

    <h2 style="margin-bottom: 20px;">Kelola Data Guru</h2>

    <!-- FORM TAMBAH GURU -->
    <div style="
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    ">

        <h3 style="margin-bottom: 15px;">Tambah Data Guru</h3>

        <form action="{{ route('guru.store') }}" method="POST">
            @csrf

            <div style="display: flex; gap: 15px; flex-wrap: wrap;">

                <input
                    type="text"
                    name="nama_guru"
                    placeholder="Nama Guru"
                    style="padding: 10px; width: 200px; border: 1px solid #ccc; border-radius: 6px;"
                >

                <input
                    type="text"
                    name="nip"
                    placeholder="NIP"
                    style="padding: 10px; width: 180px; border: 1px solid #ccc; border-radius: 6px;"
                >

                <input
                    type="text"
                    name="mapel"
                    placeholder="Mata Pelajaran"
                    style="padding: 10px; width: 200px; border: 1px solid #ccc; border-radius: 6px;"
                >

                <input
                    type="text"
                    name="foto"
                    placeholder="Nama Foto"
                    style="padding: 10px; width: 180px; border: 1px solid #ccc; border-radius: 6px;"
                >

                <button
                    type="submit"
                    style="
                        padding: 10px 20px;
                        background: #064e3b;
                        color: white;
                        border: none;
                        border-radius: 6px;
                        cursor: pointer;
                    "
                >
                    + Tambah Guru
                </button>

            </div>

        </form>

    </div>


    <!-- TABEL DATA GURU -->
    <div style="
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    ">

        <h3 style="margin-bottom: 15px;">Data Guru</h3>

        <table style="
            width: 100%;
            border-collapse: collapse;
        ">

            <tr style="background: #000000; color: white;">

                <th style="padding: 12px;">No</th>
                <th style="padding: 12px;">Nama Guru</th>
                <th style="padding: 12px;">NIP</th>
                <th style="padding: 12px;">Mata Pelajaran</th>
                <th style="padding: 12px;">Foto</th>

            </tr>

            @foreach ($guru as $data)

            <tr style="border-bottom: 1px solid #ddd;">

                <td style="padding: 12px;">
                    {{ $loop->iteration }}
                </td>

                <td style="padding: 12px;">
                    {{ $data->nama_guru }}
                </td>

                <td style="padding: 12px;">
                    {{ $data->nip }}
                </td>

                <td style="padding: 12px;">
                    {{ $data->mapel }}
                </td>

                <td style="padding: 12px;">
                    {{ $data->foto }}
                </td>

            </tr>

            @endforeach

        </table>

    </div>

</div> --}}

@endsection