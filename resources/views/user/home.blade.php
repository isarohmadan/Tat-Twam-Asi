@extends('user.layout.main')

@section('header')
    <!-- Banner Carousel -->
     <div id="bannerCarousel" class="carousel slide mb-4" data-bs-ride="carousel" style="background-color: #f8f9fa;">
        <div class="carousel-inner" style="max-height: 400px; display: flex; align-items: center;">
            @foreach ($banners as $index => $banner)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('storage/' . $banner->image_path)}}" 
                            class="img-fluid" 
                             alt="Banner {{ $index + 1 }}"
                             style="object-fit: contain; max-height: 400px; width: auto;">
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
    @include('user.partials.card')
    {{-- Tambahkan bagian blog jika diperlukan --}}
@endsection
