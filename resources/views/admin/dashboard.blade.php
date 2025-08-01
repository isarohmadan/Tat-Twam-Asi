@extends('admin.layout.reusable')

@section('content')
    <h1 class="mt-4">Beranda</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Beranda</li>
    </ol>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/card.css') }}" rel="stylesheet">

    <div class="row">
        <!-- Card Laporan Pengajuan -->
        <div class="col-md-4 col-xl-3 mb-4">
            <a href="{{ route('admin.laporan.index') }}" class="text-decoration-none">
                <div class="card bg-c-teal order-card position-relative shadow-sm rounded hover-effect">
                    <div class="card-block p-3 text-white">
                        <h6 class="mb-3">Laporan Pengajuan</h6>
                        <h2 class="d-flex justify-content-between align-items-center ">
                            <i class="fa fa-file-alt fs-3 me-2"></i>
                        </h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card Kegiatan -->
        <div class="col-md-4 col-xl-3 mb-4">
            <a href="{{ route('admin.kegiatan.index') }}" class="text-decoration-none">
                <div class="card bg-c-blue order-card position-relative shadow-sm rounded hover-effect">
                    <div class="card-block p-3 text-white">
                        <h6 class="mb-3">Kegiatan</h6>
                        <h2 class="d-flex justify-content-between align-items-center ">
                            <i class="fa fa-tasks fs-3 me-2"></i>
                            <span class="fs-4 fw-bold">{{ $kegiatans->count() }}</span>
                        </h2>
                        <p class="d-flex justify-content-between m-0">
                            <span>Disetujui</span>
                            <span
                                class="fw-semibold">{{ $kegiatans->where('status_pengajuan', 'disetujui')->count() }}</span>
                            <span>Ditolak</span>
                            <span class="fw-semibold">{{ $kegiatans->where('status_pengajuan', 'ditolak')->count() }}</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card Kunjungan -->
        <div class="col-md-4 col-xl-3 mb-4">
            <a href="{{ route('admin.kunjungan.index') }}" class="text-decoration-none">
                <div class="card bg-c-green order-card position-relative shadow-sm rounded hover-effect">
                    <div class="card-block p-3 text-white">
                        <h6 class="mb-3">Kunjungan</h6>
                        <h2 class="d-flex justify-content-between align-items-center mb-3">
                            <i class="fa fa-tasks fs-3 me-2"></i>
                            <span class="fs-4 fw-bold">{{ $kunjungans->count() }}</span>
                        </h2>
                        <p class="d-flex justify-content-between m-0">
                            <span>Disetujui</span>
                            <span class="fw-semibold">{{ $kunjungans->where('status', 'disetujui')->count() }}</span>
                            <span>Ditolak</span>
                            <span class="fw-semibold">{{ $kunjungans->where('status', 'ditolak')->count() }}</span>
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card Data Anak -->
        <div class="col-md-4 col-xl-3 mb-4">
            <a href="{{ route('admin.anak.dataanak') }}" class="text-decoration-none">
                <div class="card bg-c-purple order-card position-relative shadow-sm rounded hover-effect">
                    <div class="card-block p-3 text-white">
                        <h6 class="mb-3">Data Anak</h6>
                        <h2 class="d-flex justify-content-between align-items-center ">
                            <i class="fa fa-child fs-3 me-2"></i>
                            <span class="fs-4 fw-bold">{{ $jumlahAnak }}</span>
                        </h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card Banner -->
        <div class="col-md-4 col-xl-3 mb-4">
            <a href="{{ route('banners.index') }}" class="text-decoration-none">
                <div class="card bg-c-yellow order-card position-relative shadow-sm rounded hover-effect">
                    <div class="card-block p-3 text-white">
                        <h6 class="mb-3">Banner</h6>
                        <h2 class="d-flex justify-content-between align-items-center ">
                            <i class="fa fa-image fs-3 me-2"></i>
                            <span class="fs-4 fw-bold">{{ $jumlahBanner }}</span>
                        </h2>
                    </div>
                </div>
            </a>
        </div>
        <!-- Card Berita -->
        <div class="col-md-4 col-xl-3 mb-4">
            <a href="{{ route('beritas.index') }}" class="text-decoration-none">
                <div class="card bg-c-orange order-card position-relative shadow-sm rounded hover-effect">
                    <div class="card-block p-3 text-white">
                        <h6 class="mb-3">berita</h6>
                        <h2 class="d-flex justify-content-between align-items-center ">
                            <i class="fa fa-newspaper fs-3 me-2"></i>
                            <span class="fs-4 fw-bold">{{ $jumlahBerita }}</span>
                        </h2>
                    </div>
                </div>
            </a>
        </div>
        <!-- Card Berita -->
        <div class="col-md-4 col-xl-3 mb-4">
            <a href="{{ route('admin.kegiatan.kegiatan_photos') }}" class="text-decoration-none">
                <div class="card bg-c-orange order-card position-relative shadow-sm rounded hover-effect">
                    <div class="card-block p-3 text-white">
                        <h6 class="mb-3">Dokumentasi Kegiatan</h6>
                        <h2 class="d-flex justify-content-between align-items-center ">
                            <i class="fa fa-image fs-3 me-2"></i>

                        </h2>
                    </div>
                </div>
            </a>
        </div>
    </div>





    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-area me-1"></i>
            Data Anak Setiap Bulan
        </div>
        <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script>
        window.chartData = {
            labels: @json($data->pluck('bulan')),
            values: @json($data->pluck('jumlah')),
        };
    </script>
    <script src="{{ asset('js/chart-area-demo.js') }}"></script>

    <style>
        .hover-effect:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .bg-c-blue {
            background-color: #3498db !important;
        }

        .bg-c-green {
            background-color: #2ecc71 !important;
        }

        .bg-c-purple {
            background-color: #9b59b6 !important;
        }

        .bg-c-yellow {
            background-color: #f1c40f !important;
        }

        .bg-c-orange {
            background-color: #e67e22 !important;
        }

        .bg-c-teal {
            background-color: #008080 !important;
        }

        .card {
            min-height: 140px;
        }
    </style>
@endsection
