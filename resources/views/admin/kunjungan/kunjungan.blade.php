@extends('admin.layout.reusable')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .modal-body p {
            padding: 8px;
            background-color: #f8f9fa;
            border-radius: 4px;
            margin-bottom: 0;
        }

        .modal-body label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 5px;
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="my-3 p-3 bg-body rounded" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 -4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="fw-bold">Pengajuan Kunjungan</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengajuan Kunjungan</li>
        </ol>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-3">
            <a href="{{ route('admin.jadwal.index') }}" class="btn btn-primary">
                <i class="fas fa-calendar-alt"></i> Lihat Jadwal
            </a>
        </div>

        <!-- Pencarian Otomatis -->
        <div class="pb-3">
            <form class="d-flex" action="{{ route('admin.kunjungan.index') }}" method="GET" id="searchForm">
                <input class="form-control me-1" type="search" name="katakunci" id="katakunci"
                    value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search"
                    oninput="this.form.submit()">
            </form>
        </div>

        <!-- Tabel Data Kunjungan -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tujuan Kunjungan</th>
                        <th>Instansi</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungans as $kunjungan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kunjungan->nama_pengaju }}</td>
                            <td>{{ $kunjungan->tujuan_kunjungan }}</td>
                            <td>{{ $kunjungan->instansi }}</td>
                            <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}</td>
                            <td>
                                <span
                                    class="badge 
                                    @if ($kunjungan->status == 'disetujui') bg-success
                                    @elseif($kunjungan->status == 'ditolak') bg-danger
                                    @else bg-warning @endif">
                                    {{ ucfirst($kunjungan->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    @if ($kunjungan->status == 'menunggu')
                                        Menunggu verifikasi oleh ketua yayasan
                                    @elseif ($kunjungan->status == 'disetujui')
                                        Disetujui
                                    @elseif ($kunjungan->status == 'ditolak')
                                        Ditolak
                                    @else
                                        Status tidak diketahui
                                    @endif
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $kunjungan->id }}">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="d-flex justify-content-between">
            <div>
                Menampilkan {{ $kunjungans->firstItem() }} Sampai {{ $kunjungans->lastItem() }} Dari
                {{ $kunjungans->total() }} Data Total
            </div>
            <div>
                {{ $kunjungans->appends(['katakunci' => Request::get('katakunci')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <!-- Modals -->
    @foreach ($kunjungans as $kunjungan)
        <!-- Detail Modal -->
        <div class="modal fade" id="detailModal{{ $kunjungan->id }}" tabindex="-1" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Pengajuan Kunjungan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Informasi Pengaju</h6>
                                <hr>
                                <div class="mb-3">
                                    <label>Nama:</label>
                                    <p>{{ $kunjungan->nama_pengaju }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>Alamat:</label>
                                    <p>{{ $kunjungan->alamat }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>No Telepon:</label>
                                    <p>{{ $kunjungan->no_hp }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Informasi Kunjungan</h6>
                                <hr>
                                <div class="mb-3">
                                    <label>Tujuan Kunjungan:</label>
                                    <p>{{ $kunjungan->tujuan_kunjungan }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>Instansi:</label>
                                    <p>{{ $kunjungan->instansi }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Tanggal Kunjungan:</label>
                                    <p>{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Tanggal Pengajuan:</label>
                                    <p>{{ \Carbon\Carbon::parse($kunjungan->tanggal_pengajuan)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Status Pengajuan:</label>
                            <p>
                                <span class="text-muted">
                                    @if ($kunjungan->status == 'menunggu')
                                        Menunggu verifikasi oleh ketua yayasan
                                    @elseif ($kunjungan->status == 'disetujui')
                                        Disetujui
                                    @elseif ($kunjungan->status == 'ditolak')
                                        Ditolak
                                    @else
                                        Status tidak diketahui
                                    @endif
                                </span>
                            </p>
                        </div>
                        @if ($kunjungan->alasan_penolakan)
                            <div class="mb-3">
                                <label>Alasan Penolakan:</label>
                                <p>{{ $kunjungan->alasan_penolakan }}</p>
                            </div>
                        @endif
                        @if ($kunjungan->catatan)
                            <div class="mb-3">
                                <label>Catatan:</label>
                                <p>{{ $kunjungan->catatan }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#dataTable').DataTable();

            // Inisialisasi tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Debug modal
            console.log('Script initialized');
            $('[data-bs-toggle="modal"]').click(function() {
                console.log('Modal button clicked:', $(this).data('bs-target'));
            });
        });
    </script>
@endsection
