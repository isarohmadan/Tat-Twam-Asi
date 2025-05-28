@extends('admin.layout.reusable')

@section('content')
    <h1 class="mt-4">Data Anak</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Data Anak</li>
    </ol>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3">
            <form class="d-flex" action="" method="get">
                <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}"
                    placeholder="Masukkan kata kunci" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
        </div>
        <div class="pb-3">
            <a href="{{ route('admin.anak.tambahanak') }}" class="btn btn-primary">+ Tambah Data</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-1">NIK</th>
                    <th class="col-md-1">Nama</th>
                    <th class="col-md-1">Nama Orangtua</th>
                    <th class="col-md-1">Tanggal Lahir</th>
                    <th class="col-md-1">Asal</th>
                    <th class="col-md-1">Sekolah</th>
                    <th class="col-md-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $anak)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anak->nik }}</td>
                        <td>{{ $anak->nama }}</td>
                        <td>{{ $anak->nama_orangtua }}</td>
                        <td>{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td>{{ $anak->asal }}</td>
                        <td>{{ $anak->sekolah }}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $anak->id }}">
                                <i class="fas fa-edit text-white"></i> Edit
                            </button>

                            <form action="{{ route('admin.anak.destroy', $anak->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash text-white"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $anak->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $anak->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $anak->id }}">Edit Data Anak</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.anak.update', $anak->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik"
                                                value="{{ $anak->nik }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Anak</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                value="{{ $anak->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_orangtua" class="form-label">Nama Orangtua</label>
                                            <input type="text" class="form-control" id="nama_orangtua"
                                                name="nama_orangtua" value="{{ $anak->nama_orangtua }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                name="tanggal_lahir" value="{{ $anak->tanggal_lahir->format('Y-m-d') }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="asal" class="form-label">Asal</label>
                                            <input type="text" class="form-control" id="asal" name="asal"
                                                value="{{ $anak->asal }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sekolah" class="form-label">Sekolah</label>
                                            <input type="text" class="form-control" id="sekolah" name="sekolah"
                                                value="{{ $anak->sekolah }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
@endsection
