@extends('admin.layout.reusable')

@section('content')
    <form action="{{ route('admin.anak.store') }}" method="post">

        @csrf
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
                <label for="nama_orangtua" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama_orangtua' id="nama_orangtua">
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
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                </div>
            </div>
        </div>
    </form>
@endsection
