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
        <h1 class="h3 mb-2 text-gray-800">Pengajuan Kunjungan</h1>

        <!-- Tombol Lihat Jadwal -->
        <div class="mb-3">
            <a href="{{ route('ketua_yayasan.jadwal.index') }}" class="btn btn-primary">
                <i class="fas fa-calendar-alt"></i> Lihat Jadwal
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="pb-3">
                    <form class="d-flex" action="" method="get">
                        <input class="form-control me-1" type="search" name="katakunci"
                            value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                        <button class="btn btn-secondary" type="submit">Cari</button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengaju</th>
                                <th>Nama</th>
                                <th>Tujuan Kunjungan</th>
                                <th>Instansi</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <th>Detail</th>
                                <th>Pembatalan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjungans as $kunjungan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kunjungan->user->name ?? 'N/A' }}</td>
                                    <td>{{ $kunjungan->nama_pengaju }}</td>
                                    <td>{{ $kunjungan->tujuan_kunjungan }}</td>
                                    <td>{{ $kunjungan->instansi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}</td>
                                    <td>
                                        <span
                                            class="badge 
                                            @if ($kunjungan->status == 'disetujui') bg-success
                                            @elseif($kunjungan->status == 'ditolak') bg-danger
                                            @elseif($kunjungan->status == 'dibatalkan') bg-danger
                                            @else bg-warning @endif">
                                            {{ ucfirst($kunjungan->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($kunjungan->status == 'menunggu')
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#approveModal{{ $kunjungan->id }}">
                                                    <i class="fas fa-check"></i> Setuju
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm ms-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#rejectModal{{ $kunjungan->id }}">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-muted">Telah diverifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $kunjungan->id }}">
                                            <i class="fas fa-info-circle"></i> Detail
                                        </button>
                                    </td>
                                    <td>
                                        @if ($kunjungan->status_pembatalan == 'menunggu')
                                            <!-- Tombol Setujui dan Tolak Pembatalan hanya muncul jika status_pembatalan = 'menunggu' -->
                                            <div class="mt-2">
                                                <button type="button" class="btn btn-outline-success btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#approveCancelModal{{ $kunjungan->id }}">
                                                    Setujui Pembatalan
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#rejectCancelModal{{ $kunjungan->id }}">
                                                    Tolak Pembatalan
                                                </button>
                                            </div>
                                        @elseif ($kunjungan->status_pembatalan == 'disetujui')
                                            <span class="badge bg-success d-block mt-2">Dibatalkan</span>
                                        @elseif ($kunjungan->status_pembatalan == 'ditolak')
                                            <span class="badge bg-danger d-block mt-2">Pembatalan Ditolak</span>
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

    @foreach ($kunjungans as $kunjungan)
        <!-- Approve Modal -->
        <div class="modal fade" id="approveModal{{ $kunjungan->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('ketua_yayasan.kunjungan.approve', $kunjungan->id) }}" method="POST">@csrf
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
        <div class="modal fade" id="rejectModal{{ $kunjungan->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('ketua_yayasan.kunjungan.reject', $kunjungan->id) }}" method="POST">@csrf
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

        @if ($kunjungan->status_pembatalan == 'menunggu')
            <!-- Modal Setujui Pembatalan -->
            <div class="modal fade" id="approveCancelModal{{ $kunjungan->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('ketua_yayasan.kunjungan.setujuiPembatalan', $kunjungan->id) }}"
                        method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Setujui Pembatalan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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

            <!-- Modal Tolak Pembatalan -->
            <div class="modal fade" id="rejectCancelModal{{ $kunjungan->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('ketua_yayasan.kunjungan.tolakPembatalan', $kunjungan->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tolak Pembatalan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
            $('#dataTable').DataTable();
        });
    </script>
@endsection
