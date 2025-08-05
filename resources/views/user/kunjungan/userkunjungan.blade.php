@extends('user.layout.main')

@section('content')
<h1 class="mt-4">Pengajuan Kunjungan</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Silahkan Ajukan Kunjungan</li>
</ol>
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="pb-3 d-flex justify-content-between align-items-center">
        <!-- Search Form -->
        <form class="d-flex" action="" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}"
                placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>

        <!-- Button for New Kunjungan -->
        <a href="{{ route('user.tambahpengajuankunjungan') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Kunjungan Baru
        </a>
    </div>
    <table class="table table-striped" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">No</th>
                <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Nama Pengaju</th>
                <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Tujuan Kunjungan</th>
                <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Instansi</th>
                <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Tanggal Kunjungan</th>
                <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Status</th>
                <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Keterangan</th>
                <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kunjungans as $kunjungan)
            <tr>
                <td style="border: 0.5px solid #ddd; padding: 10px;">{{ $loop->iteration }}</td>
                <td style="border: 0.5px solid #ddd; padding: 10px;">{{ $kunjungan->nama_pengaju }}</td>
                <td style="border: 0.5px solid #ddd; padding: 10px;">{{ $kunjungan->tujuan_kunjungan }}</td>
                <td style="border: 0.5px solid #ddd; padding: 10px;">{{ $kunjungan->instansi }}</td>
                <td style="border: 0.5px solid #ddd; padding: 10px;">
                    {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}</td>
                <td style="border: 0.5px solid #ddd; padding: 10px;">
                    <span class="badge 
                        @if ($kunjungan->status == 'disetujui') bg-success
                        @elseif($kunjungan->status == 'ditolak' || $kunjungan->status == 'dibatalkan') bg-danger
                        @else bg-warning @endif" style="padding: 5px 10px; border-radius: 20px; font-size: 14px;">
                        {{ ucfirst($kunjungan->status) }}
                    </span>
                </td>
                <td style="border: 0.5px solid #ddd; padding: 10px;">
                    @if ($kunjungan->status == 'ditolak' && $kunjungan->alasan_penolakan)
                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                        data-bs-target="#alasanModal{{ $kunjungan->id }}">
                        Lihat Alasan
                    </button>
                    @elseif($kunjungan->status == 'disetujui' && $kunjungan->catatan)
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                        data-bs-target="#catatanModal{{ $kunjungan->id }}">
                        Lihat Catatan
                    </button>
                    @else
                    @endif
                </td>
                <td style="border: 0.5px solid #ddd; padding: 10px;">
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                        data-bs-target="#detailModal{{ $kunjungan->id }}">
                        <i class="fas fa-info-circle"></i> Detail
                    </button>
                    <!-- Modal Detail Kunjungan -->
                    @foreach ($kunjungans as $kunjungan)
                    <div class="modal fade" id="detailModal{{ $kunjungan->id }}" tabindex="-1"
                        aria-labelledby="detailModalLabel{{ $kunjungan->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $kunjungan->id }}">Detail Kunjungan:
                                        {{ $kunjungan->nama_pengaju }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Menampilkan detail kegiatan -->
                                    <p><strong>Nama Pengaju:</strong> {{ $kunjungan->nama_pengaju }}</p>
                                    <p><strong>Tujuan Kunjungan:</strong> {{ $kunjungan->tujuan_kunjungan }}</p>
                                    <p><strong>Instansi:</strong> {{ $kunjungan->instansi }}</p>
                                    <p><strong>Tanggal Kunjungan:</strong>
                                        {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}</p>
                                    <p><strong>Status Pengajuan:</strong> {{ ucfirst($kunjungan->status) }}</p>
                                    <p><strong>Alasan Penolakan:</strong>
                                        {{ $kunjungan->status == 'ditolak' && $kunjungan->alasan_penolakan ? $kunjungan->alasan_penolakan : 'Tidak ada' }}
                                    </p>
                                    <p><strong>Catatan Persetujuan:</strong>
                                        {{ $kunjungan->status == 'disetujui' && $kunjungan->catatan ? $kunjungan->catatan : 'Tidak ada' }}
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach



                    <!-- Modal Ajukan Pembatalan -->
                    @if ($kunjungan->status == 'disetujui' && is_null($kunjungan->status_pembatalan))
                    <button class="btn btn-sm btn-danger mt-1" data-bs-toggle="modal"
                        data-bs-target="#batalModal{{ $kunjungan->id }}">
                        Ajukan Pembatalan
                    </button>
                    @elseif ($kunjungan->status_pembatalan)
                    <p class="text-muted mt-1 mb-0">
                        Pembatalan: <strong>{{ ucfirst($kunjungan->status_pembatalan) }}</strong>
                    </p>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $kunjungans->links() }}
</div>

<!-- Modal Ajukan Pembatalan -->
@foreach ($kunjungans as $kunjungan)
@if ($kunjungan->status == 'disetujui' && is_null($kunjungan->status_pembatalan))
<div class="modal fade" id="batalModal{{ $kunjungan->id }}" tabindex="-1"
    aria-labelledby="batalModalLabel{{ $kunjungan->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('user.batalkan.kunjungan', $kunjungan->id) }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="batalModalLabel{{ $kunjungan->id }}">Ajukan Pembatalan
                        Kunjungan</h5>
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
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection