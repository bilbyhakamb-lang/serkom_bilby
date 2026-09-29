
<form action="{{ route('admin.profil-sekolah.save') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    <h4>Edit Profil Sekolah</h4>

    <label>Nama Sekolah</label>
    <input type="text" name="nama_sekolah"
        value="{{ old('nama_sekolah', $profilSekolah->nama_sekolah ?? '') }}">

    <label>Kepala Sekolah</label>
    <input type="text" name="kepala_sekolah"
        value="{{ old('kepala_sekolah', $profilSekolah->kepala_sekolah ?? '') }}">

    <label>NPSN</label>
    <input type="text" name="npsn"
        value="{{ old('npsn', $profilSekolah->npsn ?? '') }}">

    <label>Tahun Berdiri</label>
    <input type="number" name="tahun_berdiri"
        value="{{ old('tahun_berdiri', $profilSekolah->tahun_berdiri ?? '') }}">

    <label>Alamat Sekolah</label>
    <textarea name="alamat">{{ old('alamat', $profilSekolah->alamat ?? '') }}</textarea>

    <label>Kontak</label>
    <input type="text" name="kontak"
        value="{{ old('kontak', $profilSekolah->kontak ?? '') }}">

    <label>Visi dan Misi</label>
    <textarea name="visi_misi">{{ old('visi_misi', $profilSekolah->visi_misi ?? '') }}</textarea>

    <label>Deskripsi</label>
    <textarea name="deskripsi">{{ old('deskripsi', $profilSekolah->deskripsi ?? '') }}</textarea>

    <label>Logo Sekolah</label>
    @if (!empty($profilSekolah->logo))
        <img src="{{ asset('storage/' . $profilSekolah->logo) }}"
             width="100" alt="Logo Sekolah">
    @endif
    <input type="file" name="logo" accept="image/*">

    <label>Foto Sekolah</label>
    @if (!empty($profilSekolah->foto))
        <img src="{{ asset('storage/' . $profilSekolah->foto) }}"
             width="150" alt="Foto Sekolah">
    @endif
    <input type="file" name="foto" accept="image/*">

    <button type="submit">Simpan Perubahan</button>
</form>