@extends('user.layout.main')

@section('header')
    <section id="hero" class="hero section dark-background">
        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
         <div class="caroussel">    
             @foreach($banners as $index => $banner)
            <div>
                <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner Image">
            </div>
            @endforeach  
         </div>  
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>
        </div>
    </section>
@endsection

@section('content')
    @include('user.partials.about')
    @include('user.partials.card')

    {{-- Blog Posts Section (copy dari HTML utama) --}}
    {{-- Masukkan bagian blog dan pagination di sini --}}
@endsection


