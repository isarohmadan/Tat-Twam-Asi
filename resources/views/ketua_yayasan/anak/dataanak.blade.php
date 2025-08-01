@extends('ketua_yayasan.layout.reusable')

@section('content')
    <div class="my-3 p-3 bg-body rounded" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 -4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="fw-bold">Kelola Data Anak</h2>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Kelola Data Anak</li>
        </ol>
        <!-- Search and buttons -->
        <div class="pb-3">
            <form class="d-flex" id="searchForm">
                <input class="form-control me-1" type="search" name="katakunci" id="katakunci"
                    value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            </form>
        </div>
        <div class="d-flex gap-2 pb-3">
            <a href="{{ route('ketua_yayasan.anak.export') }}" class="btn btn-success">Export Excel</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm"style="font-size: 14px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th class="text-left" style="width:30%;">Nama</th>
                        <th class="text-left" style="width: 8%;">Foto</th>
                        <th class="text-center" style="width: 20%;">Tanggal Masuk</th>
                        <th class="text-left" style="width: 20%;">Asal</th> <!-- Adjusted width -->
                        <th class="text-left" style="width: 20%;">Sekolah</th> <!-- Adjusted width -->
                        <th class="text-center" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $anak)
                        <tr>
                            <td class="text-center">{{ $index + 1 + ($data->currentPage() - 1) * 25 }}</td>
                            <td class="text-left">{{ $anak->nama }}</td>
                            <td class="text-left">
                                @if ($anak->foto)
                                    <img src="{{ asset('storage/' . $anak->foto) }}" class="rounded-circle" alt="Foto Anak"
                                        width="50" height="50">
                                @else
                                    <img src="{{ asset('images/default-pic.jpg') }}" class="rounded-circle"
                                        alt="Foto Default" width="40" height="40">
                                @endif
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($anak->tanggal_masuk_panti)->format('d-m-Y') }}
                            </td>
                            <td class="text-left">{{ $anak->asal }}</td>
                            <td class="text-left">{{ $anak->sekolah }}</td>
                            <td class="text-center">
                                <!-- Action buttons with inline styles -->
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $anak->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="d-flex justify-content-between">
                <div>
                    Menampilkan {{ $data->firstItem() }} sampai {{ $data->lastItem() }} dari {{ $data->total() }} data
                    total
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
                                            <th>Orangtua</th>
                                            <td>: {{ $anak->nama_orangtua }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>: {{ $anak->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Masuk</th>
                                            <td>: {{ $anak->tanggal_masuk_panti }}</td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td>: {{ $anak->keterangan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}
                                            </td>
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
                            <a href="{{ route('ketua_yayasan.anak.exportpdf', $anak->id) }}" target="_blank"
                                class="btn btn-danger">
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
        <script src="{{ asset('js/chart-area-demo.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // Trigger search on input change
                $('#katakunci').on('input', function() {
                    var query = $(this).val();

                    $.ajax({
                        url: '{{ route('admin.anak.dataanak') }}', // Make sure this URL is correct
                        method: 'GET',
                        data: {
                            katakunci: query,
                        },
                        success: function(data) {
                            // Update the table content dynamically
                            $('table tbody').html(data);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
