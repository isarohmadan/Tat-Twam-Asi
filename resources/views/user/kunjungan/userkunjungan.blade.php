@extends('user.layout.main')

@section('content')
    <h1 class="mt-4">Pengajuan Kunjungan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Silahkan Ajukan Kunjungan</li>
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
            <a href="{{ route('user.tambahpengajuankunjungan') }}" class="btn btn-primary">+ Kunjungan Baru</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengaju</th>
                    <th>Tujuan Kunjungan</th>
                    <th>Instansi</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
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
                                class="badge bg-{{ $kunjungan->status == 'disetujui' ? 'success' : ($kunjungan->status == 'ditolak' ? 'danger' : 'warning') }}">
                                {{ ucfirst($kunjungan->status) }}
                            </span>
                        </td>
                        <td>
                            @if ($kunjungan->status == 'ditolak' && $kunjungan->alasan_penolakan)
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#alasanModal{{ $kunjungan->id }}">
                                    Lihat Alasan
                                </button>

                                <!-- Modal Alasan Penolakan -->
                                <div class="modal fade" id="alasanModal{{ $kunjungan->id }}" tabindex="-1"
                                    aria-labelledby="alasanModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="alasanModalLabel">Alasan Penolakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $kunjungan->alasan_penolakan }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($kunjungan->status == 'disetujui' && $kunjungan->catatan)
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#catatanModal{{ $kunjungan->id }}">
                                    Lihat Catatan
                                </button>

                                <!-- Modal Catatan Persetujuan -->
                                <div class="modal fade" id="catatanModal{{ $kunjungan->id }}" tabindex="-1"
                                    aria-labelledby="catatanModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="catatanModalLabel">Catatan Persetujuan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $kunjungan->catatan }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $kunjungan->id }}">
                                Detail
                            </button>

                            <!-- Modal Detail Kunjungan -->
                            <div class="modal fade" id="detailModal{{ $kunjungan->id }}" tabindex="-1"
                                aria-labelledby="detailModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel">Detail Kunjungan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Informasi Pengaju</h6>
                                                    <p><strong>Nama:</strong> {{ $kunjungan->nama_pengaju }}</p>
                                                    <p><strong>Alamat:</strong> {{ $kunjungan->alamat }}</p>
                                                    <p><strong>No. HP:</strong> {{ $kunjungan->no_hp }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Informasi Kunjungan</h6>
                                                    <p><strong>Tujuan:</strong> {{ $kunjungan->tujuan_kunjungan }}</p>
                                                    <p><strong>Instansi:</strong> {{ $kunjungan->instansi }}</p>
                                                    <p><strong>Tanggal Kunjungan:</strong>
                                                        {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                            @if ($kunjungan->surat_pengajuan)
                                                <div class="mt-3">
                                                    <a href="{{ asset('storage/' . $kunjungan->surat_pengajuan) }}"
                                                        target="_blank" class="btn btn-sm btn-info">
                                                        Lihat Surat Pengajuan
                                                    </a>
                                                </div>
                                            @endif
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

        {{ $kunjungans->links() }}
    </div>
@endsection

@section('scripts')
    <!-- Pastikan Bootstrap JS sudah terload -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
