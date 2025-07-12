@extends('ketua_yayasan.layout.reusable')

@section('content')
     <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h2 class="fw-bold">Kelola Data Anak</h2>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- Search and buttons -->
        <div class="pb-3">
            <form class="d-flex" action="{{ route('ketua_yayasan.anak.dataanak') }}" method="GET" id="searchForm">
                <input class="form-control me-1" type="search" name="katakunci" id="katakunci"
                    value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search"
                    oninput="this.form.submit()">
            </form>
        </div>
        <div class="d-flex gap-2 pb-3">
            <a href="{{ route('ketua_yayasan.anak.export') }}" class="btn btn-success">Export Excel</a>
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
                        <a href="{{ route('ketua_yayasan.anak.exportpdf', $anak->id) }}" target="_blank" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
