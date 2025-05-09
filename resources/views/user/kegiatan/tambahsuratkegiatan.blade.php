@extends('user.layout.main')

@section('content')

<h1 class="mt-4">Pengajuan Baru</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Pengajuan Baru</li>
</ol>

<!-- Tambahkan pembungkus agar form tidak terlalu lebar -->
<div class="container-form">
    <form action='' method='post'>
        <div class="my-3 p-3 bg-body rounded shadow-sm">

            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control simple-input" name='nama' id="nama">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control simple-input" name='alamat' id="alamat">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="no_hp" class="col-sm-2 col-form-label">No Handphone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control simple-input" name='no_hp' id="no_hp">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="judul_kegiatan" class="col-sm-2 col-form-label">Judul Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control simple-input" name='judul_kegiatan' id="judul_kegiatan">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="deskripsi_kegiatan" class="col-sm-2 col-form-label">Deskripsi Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control simple-input" name='deskripsi_kegiatan' id="deskripsi_kegiatan">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="tanggal_kegiatan" class="col-sm-2 col-form-label">Tanggal Kegiatan</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control simple-input" name='tanggal_kegiatan' id="tanggal_kegiatan">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="instansi" class="col-sm-2 col-form-label">Instansi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control simple-input" name='instansi' id="instansi">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="file_pdf" class="col-sm-2 col-form-label">File Surat PDF</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control simple-input" name='file_pdf' id="file_pdf">
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary" name="submit">AJUKAN</button>
                </div>
            </div>

        </div>
    </form>
</div>

<!-- Style tambahan -->
@media (max-width: 576px) {
    .container-form {
        padding: 0 15px;
    }
    <style>
        .simple-input {
            border: none;
            border-bottom: 1px solid #ced4da;
            border-radius: 0;
            box-shadow: none;
        }
        .simple-input:focus {
            border-bottom: 2px solid #0d6efd;
            outline: none;
            box-shadow: none;
        }
    
        .container-form {
            max-width: 850px; /* diperbesar dari 700px ke 850px */
            margin: auto;
        }
    </style>
}

@endsection