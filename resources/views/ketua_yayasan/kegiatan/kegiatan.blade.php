@extends('ketua_yayasan.layout.reusable')

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
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Pengajuan Kegiatan</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengaju</th>
                                <th>Judul Kegiatan</th>
                                <th>Instansi</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Surat</th>
                                <th>Aksi</th>
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
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                    <td>
                                        @if ($kegiatan->status_pengajuan == 'menunggu')
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#approveModal{{ $kegiatan->id }}">
                                                    <i class="fas fa-check"></i> Setuju
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#rejectModal{{ $kegiatan->id }}">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-muted">Telah diverifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $kegiatan->id }}">
                                            <i class="fas fa-info-circle"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @foreach ($kegiatans as $kegiatan)
        <!-- Approve Modal -->
        <div class="modal fade" id="approveModal{{ $kegiatan->id }}" tabindex="-1" aria-labelledby="approveModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('ketua_yayasan.kegiatan.approve', $kegiatan->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="approveModalLabel">Setujui Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan (Opsional)</label>
                                <textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Setujui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal{{ $kegiatan->id }}" tabindex="-1" aria-labelledby="rejectModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('ketua_yayasan.kegiatan.reject', $kegiatan->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="rejectModalLabel">Tolak Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="alasan_penolakan" class="form-label">Alasan Penolakan</label>
                                <textarea class="form-control" name="alasan_penolakan" id="alasan_penolakan" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Tolak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                                    <label>Nama Pengaju:</label>
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
