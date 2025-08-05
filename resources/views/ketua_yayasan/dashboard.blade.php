@extends('ketua_yayasan.layout.reusable')

@section('content')
    <div class="my-3 p-3 bg-body rounded" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 -4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="fw-bold">Beranda</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Beranda</li>
        </ol>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="{{ asset('css/card.css') }}" rel="stylesheet">

        <div class="row">
            <!-- Card Kegiatan -->
            <div class="col-md-4 col-xl-3 mb-4">
                <a href="{{ route('ketua_yayasan.kegiatan.index') }}" class="text-decoration-none">
                    <div class="card bg-c-blue order-card position-relative shadow-sm rounded hover-effect">
                        <div class="card-block p-3 text-white">
                            @if ($jumlahMenungguKegiatan > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger"
                                    style="width: 28px; height: 28px; font-size: 14px; z-index: 1;">
                                    {{ $jumlahMenungguKegiatan }}
                                </span>
                            @endif
                            <h6 class="mb-3">KEGIATAN</h6>
                            <h2 class="d-flex justify-content-between align-items-center">
                                <i class="fa fa-tasks fs-3 me-2"></i>
                                <span class="fs-4 fw-bold">{{ $kegiatans->count() }}</span>
                            </h2>
                            <p class="d-flex justify-content-between m-0">
                                <span>Disetujui</span>
                                <span class="fw-semibold">
                                    {{ $kegiatans->where('status_pengajuan', 'disetujui')->count() }}
                                </span>
                                <span>Ditolak</span>
                                <span class="fw-semibold">
                                    {{ $kegiatans->where('status_pengajuan', 'ditolak')->count() }}
                                </span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card Kunjungan -->
            <div class="col-md-4 col-xl-3 mb-4">
                <a href="{{ route('ketua_yayasan.kunjungan.index') }}" class="text-decoration-none">
                    <div class="card bg-c-green order-card position-relative shadow-sm rounded hover-effect">
                        @if ($jumlahMenunggu > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger"
                                style="width: 28px; height: 28px; font-size: 14px; z-index: 1;">
                                {{ $jumlahMenunggu }}
                            </span>
                        @endif
                        <div class="card-block p-3 text-white">
                            <h6 class="mb-3">KUNJUNGAN</h6>
                            <h2 class="d-flex justify-content-between align-items-center mb-3">
                                <i class="fa fa-tasks fs-3 me-2"></i>
                                <span class="fs-4 fw-bold">{{ $kunjungans->count() }}</span>
                            </h2>
                            <p class="d-flex justify-content-between m-0">
                                <span>Disetujui</span>
                                <span class="fw-semibold">
                                    {{ $kunjungans->where('status', 'disetujui')->count() }}
                                </span>
                                <span>Ditolak</span>
                                <span class="fw-semibold">
                                    {{ $kunjungans->where('status', 'ditolak')->count() }}
                                </span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card Data Anak -->
            <div class="col-md-4 col-xl-3 mb-4">
                <a href="{{ route('ketua_yayasan.anak.dataanak') }}" class="text-decoration-none">
                    <div class="card bg-c-purple order-card position-relative shadow-sm rounded hover-effect">
                        <div class="card-block p-3 text-white">
                            <h6 class="mb-3">DATA ANAK</h6>
                            <h2 class="d-flex justify-content-between align-items-center">
                                <i class="fa fa-child fs-3 me-2"></i>
                                <span class="fs-4 fw-bold">{{ $jumlahAnak }}</span>
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
            <div class="card-body"><canvas id="myChart" width="400" height="130"></canvas></div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script>
            window.chartData = {
                labels: @json($data->pluck('bulan')), // Menampilkan bulan sebagai label
                values: @json($data->pluck('total')), // Menampilkan total biodata kumulatif
            };

            // Render chart
            window.onload = function() {
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line', // Jenis chart: line untuk menampilkan akumulasi
                    data: {
                        labels: window.chartData.labels, // Bulan
                        datasets: [{
                            label: 'Total Jumlah Biodata',
                            data: window.chartData.values, // Total biodata kumulatif per bulan
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna area
                            borderColor: 'rgba(54, 162, 235, 1)', // Warna border
                            borderWidth: 1,
                            fill: true // Mengisi area di bawah garis
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        </script>
        <script src="{{ asset('js/chart-area-demo.js') }}"></script>

        <style>
            .hover-effect:hover {
                transform: translateY(-5px);
                transition: transform 0.3s ease;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                cursor: pointer;
            }

            .bg-c-yellow {
                background-color: #f1c40f !important;
            }

            .bg-c-purple {
                background-color: #9b59b6 !important;
            }

            .card {
                min-height: 140px;
            }

            .card-block h6 {
                font-size: 16px;
                font-weight: bold;
                margin-bottom: 15px;
            }

            .card-block h2 {
                font-size: 22px;
                font-weight: bold;
            }

            .card-block .fs-4 {
                font-size: 1.5rem;
            }

            .card-block p {
                font-size: 14px;
            }

            /* Styling for the badge */
            .badge {
                position: absolute;
                top: 0;
                right: 0;
                transform: translate(50%, -50%);
            }
        </style>
    @endsection
