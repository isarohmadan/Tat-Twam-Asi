@extends('user.layout.main')

@section('content')
<h1 class="mt-4">Pengajuan Kegiatan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Tambahkan pengajuan jika ingin mengajukan kegiatan</li>
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
        <a href="{{ route('user.tambahpengajuankegiatan') }}" class="btn btn-primary">+ Pengajuan Kegiatan</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Instansi</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kegiatans as $kegiatan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kegiatan->judul_kegiatan }}</td>
                <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d/m/Y') }}</td>
                <td>{{ $kegiatan->nama_instansi }}</td>
                <td>
                    <span class="badge bg-{{ 
    $kegiatan->status_pengajuan == 'disetujui' ? 'success' :
    ($kegiatan->status_pengajuan == 'ditolak' || $kegiatan->status_pengajuan == 'dibatalkan' ? 'danger' : 'warning')
}}">
    {{ ucfirst($kegiatan->status_pengajuan) }}
</span>
                </td>
                <td>
                    @if ($kegiatan->status_pengajuan == 'ditolak' && $kegiatan->alasan_penolakan)
                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                        data-bs-target="#alasanModal{{ $kegiatan->id }}">
                        Lihat Alasan
                    </button>

                    <!-- Modal Alasan Penolakan -->
                    <div class="modal fade" id="alasanModal{{ $kegiatan->id }}" tabindex="-1"
                        aria-labelledby="alasanModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="alasanModalLabel">Alasan Penolakan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $kegiatan->alasan_penolakan }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($kegiatan->status_pengajuan == 'disetujui' && $kegiatan->catatan)
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                        data-bs-target="#catatanModal{{ $kegiatan->id }}">
                        Lihat Catatan
                    </button>

                    <!-- Modal Catatan Persetujuan -->
                    <div class="modal fade" id="catatanModal{{ $kegiatan->id }}" tabindex="-1"
                        aria-labelledby="catatanModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="catatanModalLabel">Catatan Persetujuan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>{{ $kegiatan->catatan }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </td>
                <td>
                    <a href="{{ asset('storage/' . $kegiatan->surat_pengajuan) }}" target="_blank"
                        class="btn btn-sm btn-info">
                        Lihat Surat
                    </a>

                    <!-- Tombol Ajukan Pembatalan hanya jika status disetujui & belum pernah ajukan -->
                    @if ($kegiatan->status_pengajuan == 'disetujui' && is_null($kegiatan->status_pembatalan))
                    <button class="btn btn-sm btn-danger mt-1" data-bs-toggle="modal"
                        data-bs-target="#batalModal{{ $kegiatan->id }}">
                        Ajukan Pembatalan
                    </button>
                    @elseif ($kegiatan->status_pembatalan)
                    <p class="text-muted mt-1 mb-0">
                        Pembatalan: <strong>{{ ucfirst($kegiatan->status_pembatalan) }}</strong>
                    </p>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Ajukan Pembatalan -->
    @foreach ($kegiatans as $kegiatan)
    @if ($kegiatan->status_pengajuan == 'disetujui' && is_null($kegiatan->status_pembatalan))
    <div class="modal fade" id="batalModal{{ $kegiatan->id }}" tabindex="-1"
        aria-labelledby="batalModalLabel{{ $kegiatan->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('user.batalkan.kegiatan', $kegiatan->id) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batalModalLabel{{ $kegiatan->id }}">Ajukan Pembatalan Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="alasan_pembatalan">Alasan Pembatalan:</label>
                        <textarea class="form-control" name="alasan_pembatalan" rows="4" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Kirim Permintaan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
    @endforeach

</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@endsection
