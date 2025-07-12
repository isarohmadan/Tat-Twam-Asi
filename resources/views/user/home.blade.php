@extends('user.layout.main')

@if (session('success'))
    <!-- Overlay -->
    <div id="toastOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark opacity-50" style="z-index: 1040; display: block;"></div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-50 start-50 translate-middle p-3" style="z-index: 1050;">
        <div id="successToast" class="toast align-items-center text-dark bg-white border-0 rounded shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" style="max-width: 500px; width: 90%; padding: 20px;">
            <div class="d-flex">
                <!-- Toast Body -->
                <div class="toast-body">
                    <strong class="fs-4">Success</strong>
                    <p class="mt-2">{{ session('success') }}</p>
                </div>
                <button type="button" class="btn-close btn-close-black me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize toast to show it
            var toastElement = document.getElementById('successToast');
            var overlayElement = document.getElementById('toastOverlay');

            if (toastElement) {
                var toast = new bootstrap.Toast(toastElement);
                toast.show();
                
                // Event listener to hide overlay when toast is closed
                toastElement.addEventListener('hidden.bs.toast', function () {
                    overlayElement.style.display = 'none'; // Hide overlay when toast is closed
                });
            }
        });
    </script>
@endif


@section('header')
    <!-- Banner Carousel -->
    <div id="bannerCarousel" class="carousel slide mb-4" data-bs-ride="carousel" style="background-color: #f8f9fa;">
        <div class="carousel-inner" style="max-height: 400px; display: flex; align-items: center;">
            @foreach ($banners as $index => $banner)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('storage/' . $banner->image_path) }}" class="img-fluid"
                            alt="Banner {{ $index + 1 }}" style="object-fit: contain; max-height: 400px; width: auto;">
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection


@section('content')
    @include('user.partials.about')

    <!-- Spacing between about and card sections -->
    <div class="my-5"></div>

    <!-- Dokumentasi Kegiatan Section -->
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold">Dokumentasi Kegiatan yang Sudah Terlaksana</h2>
                <div class="divider mx-auto bg-primary" style="height: 3px; width: 80px;"></div>
            </div>
        </div>
    </div>

    @include('user.partials.card')

    <!-- Google Maps Embed -->
    <section id="lokasi" class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-primary text-center mb-5">Lokasi Kami</h2>
            <div class="row">
                <!-- Kolom Kiri - Peta -->
                <div class="col-md-6 mb-4">
                    <div class="map-responsive">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.2912655050854!2d115.22401457482862!3d-8.66382529138366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2408e79748df7%3A0xd8e1edc529646a83!2sPanti%20Asuhan%20Tat%20Twam%20Asi!5e0!3m2!1sid!2sid!4v1749219181720!5m2!1sid!2sid"
                            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Kolom Kanan - Informasi Lokasi dan Kontak -->
                <div class="col-md-6">
                    <h4 class="text-primary fw-bold mb-3">Mengenai Lokasi Kami</h4>
                    <p class="text-muted mb-4">Kami berlokasi di pusat kota denpasar dengan akses yang sangat mudah
                        dijangkau, tempat yang nyaman untuk
                        berkembang dan belajar. Kunjungi kami untuk informasi lebih lanjut.</p>

                    <h5 class="text-dark fw-bold mb-3">Informasi Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><strong>Alamat:</strong> Jalan Jaya Giri IX No.6 Denpasar-Bali</li>
                        <li class="mb-2"><strong>Telepon:</strong> (0361) 231401</li>
                        <li class="mb-2"><strong>Hp:</strong> 085 935 150 401</li>
                        <li class="mb-2"><strong>Email:</strong> <a href="mailto:pa.tatwamasi@gmail.com"
                                class="text-decoration-none text-primary">pa.tatwamasi@gmail.com</a></li>
                        <li><strong>No. Rekening:</strong> 0017-01-006109-53-2 BRI Cabang Denpasar</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Style for responsive map -->
    <style>
        .map-responsive {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-responsive iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }
    </style>
@endsection
