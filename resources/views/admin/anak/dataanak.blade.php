@extends('admin.layout.reusable')

@section('content')
     <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h2 class="fw-bold">Kelola Data Anak</h2>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- Search and buttons -->
        <div class="pb-3">
            <form class="d-flex" action="{{ route('admin.anak.dataanak') }}" method="GET" id="searchForm">
                <input class="form-control me-1" type="search" name="katakunci" id="katakunci"
                    value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search"
                    oninput="this.form.submit()">
            </form>
        </div>
        <div class="d-flex gap-2 pb-3">
            <a href="{{ route('admin.anak.tambahanak') }}" class="btn btn-primary">+ Tambah Data</a>
            <a href="{{ route('admin.anak.export') }}" class="btn btn-success">Export Excel</a>
        </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <!-- ... bagian thead tetap sama ... -->
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-1">NIK</th>
                    <th class="col-md-1">Foto</th>
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
                        <td>{{ $index + 1 + ($data->currentPage() - 1) * 25 }}</td>
                        <td>{{ $anak->nik }}</td>
                        <td>
                            @if ($anak->foto)
                                <img src="{{ asset('storage/' . $anak->foto) }}" class="rounded-circle" alt="Foto Anak"
                                    width="50" height="50">
                            @else
                                <img src="{{ asset('images/default-pic.jpg') }}" class="rounded-circle" alt="Foto Default"
                                    width="50" height="50">
                            @endif
                        </td>
                        <td>{{ $anak->nama }}</td>
                        <td>{{ $anak->nama_orangtua }}</td>
                        <td>{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td>{{ $anak->asal }}</td>
                        <td>{{ $anak->sekolah }}</td>
                        <td>
                            <!-- Tombol Detail -->
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $anak->id }}">
                                <i class="fas fa-eye"></i> Detail
                            </button>

                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $anak->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <!-- Tombol Delete -->
                            <form action="{{ route('admin.anak.destroy', $anak->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-between">
            <div>
                Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
            </div>
            <div>
                <!-- Pagination with search parameter -->
                {{ $data->appends(['katakunci' => Request::get('katakunci')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <!-- Modal Section - DI LUAR semua div utama -->
    @foreach ($data as $anak)
        <!-- Modal Detail -->
        <div class="modal fade" id="detailModal{{ $anak->id }}" tabindex="-1"
            aria-labelledby="detailModalLabel{{ $anak->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel{{ $anak->id }}">Detail Anak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                @if ($anak->foto)
                                    <img src="{{ asset('storage/' . $anak->foto) }}" class="img-fluid rounded"
                                        width="200">
                                @else
                                    <img src="{{ asset('images/default-pic.jpg') }}" class="img-fluid rounded"
                                        width="200">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>NIK</th>
                                        <td>: {{ $anak->nik }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>: {{ $anak->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Orangtua</th>
                                        <td>: {{ $anak->nama_orangtua }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Asal</th>
                                        <td>: {{ $anak->asal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sekolah</th>
                                        <td>: {{ $anak->sekolah }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('admin.anak.exportpdf', $anak->id) }}" target="_blank" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal{{ $anak->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $anak->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $anak->id }}">Edit Data Anak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.anak.update', $anak->id) }}" method="POST"
                        enctype="multipart/form-data">
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
                                <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua"
                                    value="{{ $anak->nama_orangtua }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ $anak->tanggal_lahir->format('Y-m-d') }}" required>
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
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto (Opsional)</label>
                                <input type="file" class="form-control" id="foto" name="foto"
                                    accept="image/*">
                                <input type="hidden" name="foto_lama" value="{{ $anak->foto }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
    @endforeach

    <!-- Pastikan script Bootstrap di-load -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
@endsection
