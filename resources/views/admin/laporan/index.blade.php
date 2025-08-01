@extends('admin.layout.reusable')

@section('content')
    <h1 class="mt-4">Laporan Pengajuan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Laporan Pengajuan</li>
    </ol>

    <!-- Laporan Kegiatan -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Laporan Kegiatan
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Kegiatan</th>
                        <th>Nama Kegiatan</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatan as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->judul_kegiatan }}</td>
                            <td>{{ $item->status_pengajuan }}</td>
                            <td>{{ $item->tanggal_mulai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Laporan Kunjungan -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Laporan Kunjungan
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Kunjungan</th>
                        <th>Tujuan Kunjungan</th>
                        <th>Status Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungan as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->tujuan_kunjungan }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->tanggal_pengajuan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
