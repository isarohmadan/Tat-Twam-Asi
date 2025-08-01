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
        <h2 class="fw-bold">Pengajuan Kegiatan</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengajuan Kegiatan</li>
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
            <form class="d-flex" action="{{ route('admin.kegiatan.index') }}" method="GET" id="searchForm">
                <input class="form-control me-1" type="search" name="katakunci" id="katakunci"
                    value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search"
                    oninput="this.form.submit()">
            </form>
        </div>

        <!-- Tabel Data Kegiatan -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul Kegiatan</th>
                        <th>Instansi</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Surat</th>
                        <th>Keterangan</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatans as $kegiatan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kegiatan->user->name ?? 'N/A' }}</td>
                            <td>{{ $kegiatan->judul_kegiatan }}</td>
                            <td>{{ $kegiatan->nama_instansi }}</td>
                            <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d/m/Y') }}</td>
                            <td>
                                <span
                                    class="badge 
                                    @if ($kegiatan->status_pengajuan == 'disetujui') bg-success
                                    @elseif($kegiatan->status_pengajuan == 'ditolak') bg-danger
                                    @else bg-warning @endif">
                                    {{ ucfirst($kegiatan->status_pengajuan) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ asset('storage/' . $kegiatan->surat_pengajuan) }}" target="_blank"
                                    class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                @if ($kegiatan->status_pengajuan == 'menunggu')
                                    <span class="text-muted">Menunggu verifikasi oleh ketua yayasan</span>
                                @elseif ($kegiatan->status_pengajuan == 'disetujui')
                                    <span class="text-muted">Disetujui</span>
                                @elseif ($kegiatan->status_pengajuan == 'ditolak')
                                    <span class="text-muted">Ditolak</span>
                                @else
                                    <span class="text-muted">Status tidak diketahui</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $kegiatan->id }}">
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
                Menampilkan {{ $kegiatans->firstItem() }} Sampai {{ $kegiatans->lastItem() }} Dari
                {{ $kegiatans->total() }} Data Total
            </div>
            <div>
                {{ $kegiatans->appends(['katakunci' => Request::get('katakunci')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <!-- Modals -->
    @foreach ($kegiatans as $kegiatan)
        <!-- Detail Modal -->
        <div class="modal fade" id="detailModal{{ $kegiatan->id }}" tabindex="-1" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Pengajuan Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Informasi Pengaju</h6>
                                <hr>
                                <div class="mb-3">
                                    <label>Nama:</label>
                                    <p>{{ $kegiatan->nama_pengaju }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>Alamat:</label>
                                    <p>{{ $kegiatan->alamat }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>No Telepon:</label>
                                    <p>{{ $kegiatan->no_telepon }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Informasi Kegiatan</h6>
                                <hr>
                                <div class="mb-3">
                                    <label>Judul Kegiatan:</label>
                                    <p>{{ $kegiatan->judul_kegiatan }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>Deskripsi Kegiatan:</label>
                                    <p>{{ $kegiatan->deskripsi }}</p>
                                </div>
                                <div class="mb-3">
                                    <label>Nama Instansi:</label>
                                    <p>{{ $kegiatan->nama_instansi }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Tanggal Mulai:</label>
                                    <p>{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Tanggal Selesai:</label>
                                    <p>{{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Status Pengajuan:</label>
                            <p>
                                <span
                                    class="badge 
                            @if ($kegiatan->status_pengajuan == 'disetujui') bg-success
                            @elseif($kegiatan->status_pengajuan == 'ditolak') bg-danger
                            @else bg-warning @endif">
                                    {{ ucfirst($kegiatan->status_pengajuan) }}
                                </span>
                            </p>
                        </div>
                        @if ($kegiatan->alasan_penolakan)
                            <div class="mb-3">
                                <label>Alasan Penolakan:</label>
                                <p>{{ $kegiatan->alasan_penolakan }}</p>
                            </div>
                        @endif
                        @if ($kegiatan->catatan)
                            <div class="mb-3">
                                <label>Catatan:</label>
                                <p>{{ $kegiatan->catatan }}</p>
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
