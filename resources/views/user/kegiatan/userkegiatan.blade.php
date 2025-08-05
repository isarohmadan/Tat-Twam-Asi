@extends('user.layout.main')

@section('content')
    <h1 class="mt-4">Pengajuan Kegiatan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tambahkan pengajuan jika ingin mengajukan kegiatan</li>
    </ol>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3 d-flex justify-content-between align-items-center">
            <form class="d-flex" action="" method="get">
                <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}"
                    placeholder="Masukkan kata kunci" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Cari</button>
            </form>
            <a href="{{ route('user.tambahpengajuankegiatan') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Pengajuan Kegiatan
            </a>
        </div>
        <table class="table table-striped" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">No</th>
                    <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Judul Kegiatan</th>
                    <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Tanggal Mulai</th>
                    <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Tanggal Selesai</th>
                    <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Instansi</th>
                    <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Status</th>
                    <th style="border: 0.5px solid #ddd; padding: 10px; background-color: #f8f9fa;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kegiatans as $kegiatan)
                    <tr>
                        <td style="border: 0.5px solid #ddd; padding: 10px;">{{ $loop->iteration }}</td>
                        <td style="border: 0.5px solid #ddd; padding: 10px;">{{ $kegiatan->judul_kegiatan }}</td>
                        <td style="border: 0.5px solid #ddd; padding: 10px;">
                            {{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td style="border: 0.5px solid #ddd; padding: 10px;">
                            {{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d/m/Y') }}</td>
                        <td style="border: 0.5px solid #ddd; padding: 10px;">{{ $kegiatan->nama_instansi }}</td>
                        <td style="border: 0.5px solid #ddd; padding: 10px;">
                            <span
                                class="badge 
                        @if ($kegiatan->status_pengajuan == 'disetujui') bg-success
                        @elseif($kegiatan->status_pengajuan == 'ditolak') bg-danger
                        @elseif($kegiatan->status_pengajuan == 'dibatalkan') bg-danger
                        @elseif($kegiatan->status_pengajuan == 'terlaksana') bg-success
                        @else bg-warning @endif"
                                style="padding: 5px 10px; border-radius: 20px; font-size: 14px;">
                                {{ ucfirst($kegiatan->status_pengajuan) }}
                            </span>
                        </td>
                        <td class="d-flex flex-wrap justify-content-center gap-2" style="padding: 10px;">
                            <!-- Aksi dengan ikon -->
                            @if ($kegiatan->status_pengajuan == 'terlaksana')
                                @if ($kegiatan->photos->isEmpty())
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#uploadPhotosModal{{ $kegiatan->id }}">
                                        <i class="fas fa-upload"></i>
                                    </button>

                                    <!-- Modal untuk upload foto -->
                                    <div class="modal fade" id="uploadPhotosModal{{ $kegiatan->id }}" tabindex="-1"
                                        aria-labelledby="uploadPhotosModalLabel{{ $kegiatan->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="uploadPhotosModalLabel{{ $kegiatan->id }}">
                                                        Upload Foto
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form untuk upload foto -->
                                                    <form action="{{ route('user.kegiatan.submitPhoto', $kegiatan->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="judul" class="form-label">Judul Foto</label>
                                                            <input type="text" class="form-control" id="judul"
                                                                name="judul" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="deskripsi" class="form-label">Deskripsi Foto</label>
                                                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="photos" class="form-label">Pilih Foto</label>
                                                            <input type="file" class="form-control" id="photos"
                                                                name="photos[]" multiple required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('user.kegiatan.showPhotos', $kegiatan->id) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="fas fa-images"></i>
                                    </a>
                                @endif
                            @endif

                            <!-- Lihat Alasan / Catatan -->
                            @if ($kegiatan->status_pengajuan == 'ditolak' && $kegiatan->alasan_penolakan)
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#alasanModal{{ $kegiatan->id }}">
                                    <i class="fas fa-exclamation-circle"></i>
                                </button>
                            @elseif ($kegiatan->status_pengajuan == 'disetujui' && $kegiatan->catatan)
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#catatanModal{{ $kegiatan->id }}">
                                    <i class="fas fa-sticky-note"></i>
                                </button>
                            @endif

                            <!-- Lihat Surat Pengajuan -->
                            <a href="{{ asset('storage/' . $kegiatan->surat_pengajuan) }}" target="_blank"
                                class="btn btn-sm btn-info">
                                <i class="fas fa-file-pdf"></i>
                            </a>

                            <!-- Pembatalan Kegiatan -->
                            @if ($kegiatan->status_pengajuan == 'disetujui' && is_null($kegiatan->status_pembatalan))
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#batalModal{{ $kegiatan->id }}">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            @elseif ($kegiatan->status_pembatalan)
                                <p class="text-muted mt-1 mb-0">
                                    Pembatalan: <strong>{{ ucfirst($kegiatan->status_pembatalan) }}</strong>
                                </p>
                            @endif

                            <!-- Detail Kegiatan -->
                            <button type="button" class="btn btn-sm btn-primary mt-1" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $kegiatan->id }}">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <!-- Modal Details for Kegiatan -->
                            <div class="modal fade" id="detailModal{{ $kegiatan->id }}" tabindex="-1"
                                aria-labelledby="detailModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel">Detail Kegiatan:
                                                {{ $kegiatan->judul_kegiatan }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Judul Kegiatan:</strong> {{ $kegiatan->judul_kegiatan }}</p>
                                            <p><strong>Tanggal Mulai:</strong>
                                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d/m/Y') }}</p>
                                            <p><strong>Tanggal Selesai:</strong>
                                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d/m/Y') }}
                                            </p>
                                            <p><strong>Instansi:</strong> {{ $kegiatan->nama_instansi }}</p>
                                            <p><strong>Status Pengajuan:</strong>
                                                {{ ucfirst($kegiatan->status_pengajuan) }}</p>
                                            <p><strong>Alasan Penolakan:</strong>
                                                {{ $kegiatan->alasan_penolakan ?? 'Tidak ada' }}</p>
                                            <p><strong>Catatan Persetujuan:</strong>
                                                {{ $kegiatan->catatan ?? 'Tidak ada' }}</p>
                                            <p><strong>Surat Pengajuan:</strong> <a
                                                    href="{{ asset('storage/' . $kegiatan->surat_pengajuan) }}"
                                                    target="_blank">Lihat Surat</a></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <h5 class="modal-title" id="batalModalLabel{{ $kegiatan->id }}">Ajukan Pembatalan
                                        Kegiatan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label for="alasan_pembatalan">Alasan Pembatalan:</label>
                                    <textarea class="form-control" name="alasan_pembatalan" rows="4" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Kirim Permintaan</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
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
