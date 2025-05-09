@extends('user.layout.main')

@section('content')
<h1 class="mt-4">Surat Kegiatan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Surat Kegiatan</li>
</ol>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="pb-3">
                  <form class="d-flex" action="" method="get">
                      <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
                  </form>
                </div>
                <div class="pb-3">
                  <a href='tambahsuratkegiatan' class="btn btn-primary">+ Ajukan Surat</a>
                </div>
          
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">Tanggal Pengajuan</th>
                            <th class="col-md-4">Judul Kegiatan</th>    
                            <th class="col-md-2">Status</th>
                        </tr>
                    </thead>
                </table>
               
          </div>
@endsection