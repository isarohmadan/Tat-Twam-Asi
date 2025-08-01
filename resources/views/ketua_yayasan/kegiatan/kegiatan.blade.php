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
    <div class="my-3 p-3 bg-body rounded" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 -4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="fw-bold">Pengajuan Kegiatan</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengajuan Kegiatan</li>
        </ol>
        <div class="mb-3">
            <a href="{{ route('ketua_yayasan.jadwal.index') }}" class="btn btn-primary">
                <i class="fas fa-calendar-alt"></i> Lihat Jadwal
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
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
                                <th>Pembatalan</th>
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
        @elseif($kegiatan->status_pengajuan == 'dibatalkan') bg-danger
        @elseif($kegiatan->status_pengajuan == 'terlaksana') bg-success
        @else bg-warning @endif">
                                            {{ ucfirst($kegiatan->status_pengajuan) }}
                                        </span>
                                    </td>
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
                                    <td>
                                        @if ($kegiatan->status_pembatalan == 'menunggu')
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-outline-success btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#approveCancelModal{{ $kegiatan->id }}">
                                                    Setujui Pembatalan
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#rejectCancelModal{{ $kegiatan->id }}">
                                                    Tolak Pembatalan
                                                </button>
                                            </div>
                                        @elseif ($kegiatan->status_pembatalan == 'disetujui')
                                            <span class="badge bg-success d-block mt-2">Dibatalkan</span>
                                        @elseif ($kegiatan->status_pembatalan == 'ditolak')
                                            <span class="badge bg-danger d-block mt-2">Pembatalan Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Aksi Lainnya -->
                                        @if ($kegiatan->status_pengajuan == 'disetujui')
                                            <form
                                                action="{{ route('ketua_yayasan.kegiatan.markAsCompleted', $kegiatan->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Tandai Sebagai Terlaksana
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach ($kegiatans as $kegiatan)
        <!-- Approve Modal -->
        <div class="modal fade" id="approveModal{{ $kegiatan->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('ketua_yayasan.kegiatan.approve', $kegiatan->id) }}" method="POST">@csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Setujui Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label>Catatan (Opsional):</label>
                            <textarea class="form-control" name="catatan" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Setujui</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal{{ $kegiatan->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('ketua_yayasan.kegiatan.reject', $kegiatan->id) }}" method="POST">@csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tolak Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label>Alasan Penolakan</label>
                            <textarea class="form-control" name="alasan_penolakan" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Tolak</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Detail Modal -->
        <div class="modal fade" id="detailModal{{ $kegiatan->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pengajuan Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Informasi Pengaju:</h6>
                        <p>Nama: {{ $kegiatan->nama_pengaju }}</p>
                        <p>Alamat: {{ $kegiatan->alamat }}</p>
                        <p>No Telepon: {{ $kegiatan->no_telepon }}</p>

                        <h6>Informasi Kegiatan:</h6>
                        <p>Judul: {{ $kegiatan->judul_kegiatan }}</p>
                        <p>Deskripsi: {{ $kegiatan->deskripsi }}</p>
                        <p>Instansi: {{ $kegiatan->nama_instansi }}</p>

                        <h6>Tanggal:</h6>
                        <p>{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d/m/Y') }} -
                            {{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d/m/Y') }}</p>

                        <h6>Status:</h6>
                        <span
                            class="badge 
    @if ($kegiatan->status_pengajuan == 'disetujui') bg-success
    @elseif($kegiatan->status_pengajuan == 'ditolak') bg-danger
    @elseif($kegiatan->status_pengajuan == 'dibatalkan') bg-danger
    @else bg-warning @endif">
                            {{ ucfirst($kegiatan->status_pengajuan) }}
                        </span>

                        @if ($kegiatan->alasan_penolakan)
                            <h6>Alasan Penolakan:</h6>
                            <p>{{ $kegiatan->alasan_penolakan }}</p>
                        @endif
                        @if ($kegiatan->catatan)
                            <h6>Catatan:</h6>
                            <p>{{ $kegiatan->catatan }}</p>
                        @endif
                        @if ($kegiatan->alasan_pembatalan)
                            <h6>Alasan Pembatalan dari User:</h6>
                            <p>{{ $kegiatan->alasan_pembatalan }}</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Approve Pembatalan Modal -->
        @if ($kegiatan->status_pembatalan == 'menunggu')
            <div class="modal fade" id="approveCancelModal{{ $kegiatan->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('ketua_yayasan.kegiatan.setujuiPembatalan', $kegiatan->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Setujui Pembatalan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Yakin menyetujui pembatalan?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Setujui</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="rejectCancelModal{{ $kegiatan->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('ketua_yayasan.kegiatan.tolakPembatalan', $kegiatan->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tolak Pembatalan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <label>Catatan (Opsional):</label>
                                <textarea class="form-control" name="catatan" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Tolak</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
