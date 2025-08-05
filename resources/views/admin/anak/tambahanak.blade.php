@extends('admin.layout.reusable')

@section('content')
    <div class="my-3 p-3 bg-body rounded" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 -4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="fw-bold">Tambah Data Anak</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Tambah Data Anak</li>
        </ol>
        <form action="{{ route('admin.anak.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="my-3 p-3 bg-body rounded shadow-sm">

                <div class="mb-3 row">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name='nik' id="nik">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Anak</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama' id="nama">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_orangtua" class="col-sm-2 col-form-label">Orang Tua/Wali</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama_orangtua' id="nama_orangtua">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tanggal_masuk_panti" class="col-sm-2 col-form-label">Tanggal Masuk Panti</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="tanggal_masuk_panti" id="tanggal_masuk_panti">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="keterangan" id="keterangan">
                            <option value="Yatim">Yatim</option>
                            <option value="Tidak Mampu">Tidak Mampu</option>
                            <option value="Piatu">Piatu</option>
                            <option value="Yatim Piatu">Yatim Piatu</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name='tanggal_lahir' id="tanggal_lahir">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="asal" class="col-sm-2 col-form-label">Asal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='asal' id="asal">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="sekolah" class="col-sm-2 col-form-label">Sekolah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='sekolah' id="sekolah">
                    </div>
                </div>

                {{-- ✅ Tambahan Form Upload Foto --}}
                <div class="mb-3 row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto Anak</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>

            </div>
        </form>
    @endsection
