@extends('user.layout.main')

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
            <h2 class="fw-bold text-primary text-center mb-4">Lokasi Kami</h2>
            <div class="map-responsive">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.2912655050854!2d115.22401457482862!3d-8.66382529138366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2408e79748df7%3A0xd8e1edc529646a83!2sPanti%20Asuhan%20Tat%20Twam%20Asi!5e0!3m2!1sid!2sid!4v1749219181720!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" width="100%" height="450" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
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