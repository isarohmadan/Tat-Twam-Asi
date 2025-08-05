@extends('user.layout.main')

@if (session('success'))
    <!-- Overlay -->
    <div id="toastOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark opacity-50"
        style="z-index: 1040; display: block;"></div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-50 start-50 translate-middle p-3" style="z-index: 1050;">
        <div id="successToast" class="toast align-items-center text-dark bg-white border-0 rounded shadow-lg"
            role="alert" aria-live="assertive" aria-atomic="true" style="max-width: 500px; width: 90%; padding: 20px;">
            <div class="d-flex">
                <!-- Toast Body -->
                <div class="toast-body">
                    <strong class="fs-4">Success</strong>
                    <p class="mt-2">{{ session('success') }}</p>
                </div>
                <button type="button" class="btn-close btn-close-black me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize toast to show it with GSAP animation
            var toastElement = document.getElementById('successToast');
            var overlayElement = document.getElementById('toastOverlay');

            if (toastElement) {
                // GSAP toast animation
                gsap.fromTo(toastElement, 
                    { 
                        scale: 0.8, 
                        opacity: 0,
                        y: -50 
                    },
                    { 
                        scale: 1, 
                        opacity: 1,
                        y: 0,
                        duration: 0.6,
                        ease: "back.out(1.7)"
                    }
                );

                var toast = new bootstrap.Toast(toastElement);
                toast.show();

                // Event listener to hide overlay when toast is closed
                toastElement.addEventListener('hidden.bs.toast', function() {
                    gsap.to(overlayElement, {
                        opacity: 0,
                        duration: 0.3,
                        onComplete: function() {
                            overlayElement.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
@endif

@section('header')
    <!-- Banner Swiper with GSAP Animation -->
    <div class="banner-container gsap-banner" style="opacity: 1; transform: none;">
        <div class="swiper bannerSwiper p-0">
            <div class="swiper-wrapper">
                @foreach ($banners as $index => $banner)
                    <div class="swiper-slide p-0 border-none">
                        <div style="position: relative; width: 100%; height: 100%;">
                            <img src="{{ asset('storage/' . $banner->image_path) }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; object-position:center;"
                                 alt="Banner {{ $index + 1 }}">
                            @if($index === 0)
                                <div  style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.7); display: flex; align-items: center; justify-content: center; text-align: center; z-index: 10;">
                                    <div class="container-description" style="margin: 0 auto; padding: 0 1rem;">
                                        <div style="margin: 0 auto; animation: fadeInUp 1s ease-out; font-family: 'Montserrat', sans-serif; padding: 0 1rem;">
                                            <h3 style="font-size: clamp(1rem, 5vw, 2rem); margin-bottom: 1rem; color: white; font-weight: 700; line-height: 1.2;">Satyam Siwam Sundaram Pendidikan dan Cinta Kasih untuk Anak Negeri</h3>
                                            <p style="font-size: clamp(0.75rem, 2vw, 1rem); line-height: 1.6; margin-bottom: 2rem; color: white; font-weight: 400; max-width: 90%; margin-left: auto; margin-right: auto;">Menjadi wadah pelindung dan pendidikan sosial yang mendidik generasi muda dengan nilai luhur Agama Hindu, membangun manusia berkarakter, berpengetahuan, dan berintegritas untuk mewujudkan masyarakat Bali yang peduli dan maju.</p>
                                            <a href="{{ route('user.userkegiatan') }}" class="btn-carousel">Ajukan Kegiatan</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Custom Styles untuk Swiper v8 -->
    <style>

        .btn-carousel{
            background-color: #388E3C;
            color: white;
            padding: 12px 24px;
            font-size: 14px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.4s;
            max-width: fit-content;
            border: none;
            opacity: 1;
            transform: translate(0px, 0px);
            box-shadow: rgba(56, 142, 60, 0.25) 0px 3px 12px;
            translate: none;
            rotate: none;
            scale: none;
        }
        .btn-carousel:hover{
            background-color:#388E3C;
            color: white;
            padding: 12px 24px;
            font-size: 14px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.4s;
            max-width: fit-content;
            border: none;
            opacity: 1;
            transform: translate(0px, 0px); 
            box-shadow: rgba(56, 142, 60, 0.25) 0px 3px 12px;
            translate: 0px 4px;
            rotate: none;
            scale: none;
        }
        .banner-container {
            position: relative;
            margin: 5rem 0 2rem 0;
        }

        .bannerSwiper {
            width: 100%;
            height: 100vh;
            position: relative;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .swiper-slide {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
        }
        .container-description{
            width: 70vw;
        }

        .banner-slide-content {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .banner-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px;
        }

        /* Navigation Buttons */
        .swiper-button-next,
        .swiper-button-prev {
            width: 50px;
            height: 50px;
            margin-top: -25px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            border: none;
            color: #388E3C !important;
            font-weight: bold;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 10;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
            font-weight: 900;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #388E3C;
            color: white !important;
            transform: scale(1.1);
            box-shadow: 0 8px 30px rgba(56, 142, 60, 0.3);
        }

        .swiper-button-next {
            right: 20px;
        }

        .swiper-button-prev {
            left: 20px;
        }

        /* Pagination */
        .swiper-pagination {
            bottom: 20px !important;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
        }

        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            transition: all 0.3s ease;
            cursor: pointer;
            opacity: 1;
            margin: 0 6px !important;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .swiper-pagination-bullet-active {
            background: #388E3C !important;
            transform: scale(1.3);
            box-shadow: 0 0 15px rgba(56, 142, 60, 0.5);
            border-color: #388E3C;
        }
        .swiper{
            padding: 0px 0 40px !important;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .bannerSwiper {
                height: 500px;
            }

            .container-description{
            width: 90vw;
        }

            .swiper-button-next,
            .swiper-button-prev {
                width: 40px;
                height: 40px;
                margin-top: -20px;
            }

            .swiper-button-next:after,
            .swiper-button-prev:after {
                font-size: 16px;
            }

            .swiper-button-next {
                right: 10px;
            }

            .swiper-button-prev {
                left: 10px;
            }
        }

        @media (max-width: 480px) {
            .container-description{
            width: 100vw;
        }
            
            .bannerSwiper {
                height: 600px;
                border-radius: 12px;
            }
        }
    </style>

    <!-- Swiper Initialization Script -->
     <script>

        
function galleryOpenModal(src, alt) {

                const modal = document.getElementById('galleryModal');
                const modalImg = document.getElementById('galleryModalImage');
                modalImg.src = src;
                modalImg.alt = alt;
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
                
                // Trigger reflow
                setTimeout(() => {
                    modal.style.opacity = '1';
                }, 10);
        }
        
        function galleryCloseModal() {
            const modal = document.getElementById('galleryModal');
            modal.style.opacity = '0';
            
            setTimeout(() => {
                modal.classList.remove('show');
                document.body.style.overflow = 'auto';
            }, 300);
        }
        // Main GSAP and ScrollTrigger initialization
        document.addEventListener('DOMContentLoaded', function() {


            // Register ScrollTrigger plugin if available
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);
                
                // Function to initialize all title underlines
                const initTitleUnderlines = () => {
                    
                    // Animate section title underlines
                    document.querySelectorAll('.section-title').forEach((title, i) => {
                        const underline = title.querySelector('.title-underline');
                        if (!underline) {
                            console.warn('No underline element found for title:', title);
                            return;
                        }
                        
                        // Set initial state
                        gsap.set(underline, { width: 0 });
                        
                        // Create ScrollTrigger
                        gsap.to(underline, {
                            scrollTrigger: {
                                trigger: title,
                                start: 'top 80%',
                                toggleActions: 'play none none reverse',
                                onEnter: () => gsap.to(underline, { 
                                    width: '100%', 
                                    duration: 0.8, 
                                    ease: 'power2.out' 
                                }),
                                onLeaveBack: () => gsap.to(underline, { 
                                    width: 0, 
                                    duration: 0.4 
                                })
                            }
                        });
                        
                    });
                };
                
                // Initialize after a short delay to ensure DOM is ready
                setTimeout(initTitleUnderlines, 100);
                
                // Re-initialize when content is dynamically loaded
                if (window.livewire) {
                    window.livewire.on('contentChanged', () => {
                        setTimeout(initTitleUnderlines, 300);
                    });
                }
            } else {
                console.error('GSAP or ScrollTrigger not loaded');
            }
            // Add passive event listener to window
            const addPassiveEventListener = (element, event, handler) => {
                const options = { passive: true };
                element.addEventListener(event, handler, options);
                return () => element.removeEventListener(event, handler, options);
            };

            // Animate title underlines on scroll
            const animateTitles = () => {
                gsap.utils.toArray('.title-wrapper').forEach((title, i) => {
                    const underline = title.querySelector('.title-underline');
                    if (!underline) return;
                    
                    // Set initial state
                    gsap.set(underline, { width: 0 });
                    
                    // Create ScrollTrigger
                    ScrollTrigger.create({
                        trigger: title,
                        start: 'top 80%',
                        end: 'top 50%',
                        onEnter: () => {
                            gsap.to(underline, {
                                width: '100%',
                                duration: 0.8,
                                ease: 'power2.out',
                                delay: i * 0.3
                            });
                        },
                        once: true
                    });
                });
            };

            // Initialize animations
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);
                animateTitles();
            } else {
                console.warn('GSAP or ScrollTrigger not loaded');
            }

            // Initialize Swiper instances
            const bannerSwiper = new Swiper(".bannerSwiper", {
                // Basic settings
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                centeredSlides: true,
                
                // Autoplay
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                
                // Speed and effect
                speed: 800,
                effect: 'slide',
                
                // Navigation
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                
                // Pagination
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                    dynamicMainBullets: 3,
                },
                
                // Touch settings
                touchRatio: 1,
                touchAngle: 45,
                grabCursor: true,
                
                // Keyboard
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },
                
                // Breakpoints
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 1,
                        spaceBetween: 15,
                    },
                    1024: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    }
                },
                
                // Event callbacks
                on: {
                    init: function() {
                        // GSAP animation for initial slide
                        if (typeof gsap !== 'undefined') {
                            gsap.fromTo(this.slides[this.activeIndex].querySelector('.banner-image'), {
                                scale: 1.2,
                                opacity: 0
                            }, {
                                scale: 1,
                                opacity: 1,
                                duration: 1,
                                ease: "power3.out"
                            });
                        }
                    },
                    
                    slideChangeTransitionStart: function() {
                        // Animate outgoing slide
                        if (typeof gsap !== 'undefined') {
                            const prevSlide = this.slides[this.previousIndex];
                            if (prevSlide) {
                                gsap.to(prevSlide.querySelector('.banner-image'), {
                                    scale: 0.95,
                                    opacity: 0.7,
                                    duration: 0.4,
                                    ease: "power2.out"
                                });
                            }
                        }
                    },
                    
                    slideChangeTransitionEnd: function() {
                        // Animate incoming slide
                        if (typeof gsap !== 'undefined') {
                            const activeSlide = this.slides[this.activeIndex];
                            if (activeSlide) {
                                gsap.fromTo(activeSlide.querySelector('.banner-image'), {
                                    scale: 1.1,
                                    opacity: 0.8
                                }, {
                                    scale: 1,
                                    opacity: 1,
                                    duration: 0.6,
                                    ease: "power3.out"
                                });
                                
                                // Animate banner content
                                const bannerContent = activeSlide.querySelector('.banner-content');
                                if (bannerContent) {
                                    gsap.fromTo(bannerContent, {
                                        y: 30,
                                        opacity: 0
                                    }, {
                                        y: 0,
                                        opacity: 1,
                                        duration: 0.8,
                                        ease: "power2.out",
                                        delay: 0.2
                                    });
                                }
                            }
                        }
                    },
                    
                    touchStart: function() {
                        this.autoplay.stop();
                    },
                    
                    touchEnd: function() {
                        var self = this;
                        setTimeout(function() {
                            self.autoplay.start();
                        }, 3000);
                    }
                }
            });

            // Enhanced hover effects
            const swiperContainer = document.querySelector('.bannerSwiper');
            
            if (swiperContainer) {
                swiperContainer.addEventListener('mouseenter', function() {
                    bannerSwiper.autoplay.stop();
                    
                    if (typeof gsap !== 'undefined') {
                        gsap.to('.swiper-button-next, .swiper-button-prev', {
                            scale: 1.05,
                            duration: 0.3,
                            ease: "power2.out"
                        });
                    }
                });
                
                swiperContainer.addEventListener('mouseleave', function() {
                    bannerSwiper.autoplay.start();
                    
                    if (typeof gsap !== 'undefined') {
                        gsap.to('.swiper-button-next, .swiper-button-prev', {
                            scale: 1,
                            duration: 0.3,
                            ease: "power2.out"
                        });
                    }
                });
            }

            // Button click animations
            const nextBtn = document.querySelector('.swiper-button-next');
            const prevBtn = document.querySelector('.swiper-button-prev');
            
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    if (typeof gsap !== 'undefined') {
                        gsap.to(this, {
                            scale: 0.9,
                            duration: 0.1,
                            ease: "power2.out",
                            yoyo: true,
                            repeat: 1
                        });
                    }
                });
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    if (typeof gsap !== 'undefined') {
                        gsap.to(this, {
                            scale: 0.9,
                            duration: 0.1,
                            ease: "power2.out",
                            yoyo: true,
                            repeat: 1
                        });
                    }
                });
            }

            // GSAP entrance animation
            if (typeof gsap !== 'undefined') {
                gsap.to('.gsap-banner', {
                    opacity: 1,
                    y: 0,
                    duration: 1.2,
                    ease: "power3.out",
                    delay: 0.3
                });
            }
        });
     
    </script>
 

 @endsection
 @section('content')
    @include('user.partials.about')

    <!-- Dokumentasi Kegiatan Section -->
    <section class="">
        <div class="container-fluid">
            <div class="text-center mb-3">
                <div class="title-wrapper" style="display: inline-block; position: relative; margin-bottom: 30px;">
                    <h2 class="fw-bold section-title m-0 d-inline-block position-relative pb-0" style="font-family: 'Montserrat', sans-serif; color: var(--text-dark);">
                        <span class="position-relative pb-0">
                            Kegiatan
                            <span class="title-underline" style="position: absolute; bottom: -8px; left: 0; width: 0; height: 3px; background-color: #388E3C; border-radius: 2px; display: block;"></span>
                        </span>
                    </h2>
                </div>
                <!-- <div class="mx-auto" style="width: 100px; height: 2px; background-color: #388E3C; margin: 10px auto 20px;"></div> -->
            </div>
            
            <div class="gsap-cards" style="opacity: 1; transform: none;">
                @include('user.partials.card')
            </div>
        </div>
    </section>

    <!-- Google Maps Embed Section -->
    <section id="lokasi" class="py-5 bg-white">
        <div class="">
                     <div class="title-wrapper  w-100 text-center" style="display: inline-block; position: relative; margin-bottom: 30px;">
                    <h2 class="fw-bold section-title m-0 d-inline-block position-relative pb-0" style="font-family: 'Montserrat', sans-serif; color: var(--text-dark);">
                        <span class="position-relative pb-0">
                            Lokasi Kami
                            <span class="title-underline" style="position: absolute; bottom: -8px; left: 0; width: 0; height: 3px; background-color: #388E3C; border-radius: 2px; display: block;"></span>
                        </span>
                    </h2>
                </div>

            <div class="row-cang mt-4">
                <!-- Kolom Kiri - Peta -->
                <div class="col-lg-6 parent-map-responsive">
                    <div class="map-responsive" style="">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.2912655050854!2d115.22401457482862!3d-8.66382529138366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2408e79748df7%3A0xd8e1edc529646a83!2sPanti%20Asuhan%20Tat%20Twam%20Asi!5e0!3m2!1sid!2sid!4v1749219181720!5m2!1sid!2sid"
                            width="100%" height="400" style="border:0;" 
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <div class=" gallery-section ">
                    <div class="gallery-container">
                   
                        <div class="gallery-masonry">
                            @php
                                $galleryItems = [
                                    ['src' => 'images/unnamed.webp', 'alt' => 'Gallery 1'],
                                    ['src' => 'images/unnamed (1).webp', 'alt' => 'Gallery 2'],
                                    ['src' => 'images/unnamed (2).webp', 'alt' => 'Gallery 3'],
                                    ['src' => 'images/unnamed (3).webp', 'alt' => 'Gallery 4'],
                                    ['src' => 'images/unnamed (4).webp', 'alt' => 'Gallery 5'],
                                    ['src' => 'images/unnamed (4).webp', 'alt' => 'Gallery 6'],
                                    ['src' => 'images/unnamed (5).webp', 'alt' => 'Gallery 7'],
                                    ['src' => 'images/unnamed (6).webp', 'alt' => 'Gallery 8'],
                                    ['src' => 'images/unnamed (7).webp', 'alt' => 'Gallery 9'],
                                    ['src' => 'images/unnamed (8).webp', 'alt' => 'Gallery 10'],
                                    ['src' => 'images/unnamed (9).webp', 'alt' => 'Gallery 11'],
                                ];
                            @endphp
                            
                            @foreach($galleryItems as $index => $item)
                            <div class="gallery-item" onclick="galleryOpenModal('{{ asset($item['src']) }}', '{{ $item['alt'] }}')">
                                <div class="gallery-item-content">
                                    <img src="{{ asset($item['src']) }}" alt="{{ $item['alt'] }}" loading="lazy">
                                    <div class="gallery-item-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div> 
                </div>
            </div>
                  
    <!-- Gallery Modal -->
    <div id="galleryModal" class="gallery-modal">
        <span class="gallery-modal-close" onclick="galleryCloseModal()">&times;</span>
        <img class="gallery-modal-content" id="galleryModalImage">
    </div>
            </div>
        </div>
        <!-- card  -->
    </section>

    <style>

        .row-cang {
            grid-template-columns: repeat(2, 1fr);
            display: grid;
            gap: 1rem;
        }
        /* Gallery Section Specific Styles */
        .gallery-section {
            width: 100%;
        }
        
        .gallery-container {
            min-height: 100vh;
        }
        
        .gallery-title {
            margin-bottom: 20px;
            color: #333;
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .gallery-masonry {
            column-count: 2;
            column-gap: 15px;
        }
        
        .gallery-item {
            break-inside: avoid;
            margin-bottom: 15px;
            display: inline-block;
            width: 100%;
        }
        
        .gallery-item-content {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .gallery-item-content img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover .gallery-item-content {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        
        .gallery-item-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .gallery-item:hover .gallery-item-overlay {
            opacity: 1;
        }
        
        .gallery-item-overlay i {
            color: white;
            font-size: 2rem;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover .gallery-item-overlay i {
            transform: scale(1.2);
        }
        
        /* Gallery Modal */
        .gallery-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            overflow: auto;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        
        .gallery-modal.show {
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 1;
        }
        
        .gallery-modal-content {
            max-width: 90%;
            max-height: 90vh;
            width: auto;
            height: auto;
            border-radius: 8px;
            animation: galleryZoomIn 0.3s;
        }
        
        .gallery-modal-close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            z-index: 1001;
        }
        
        .gallery-modal-close:hover {
            color: #bbb;
        }
        
        @keyframes galleryZoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        
        @media (max-width: 768px) {
            .row-cang {
                gap: 0.5rem;
            }
            .gallery-masonry {
                column-count: 2;
                column-gap: 5px;
            }
            
            .gallery-item-overlay i {
                font-size: 1.5rem;
            }
            .gallery-item {
                margin-bottom: 5px;
            }
        }
        
        /* Reset some styles that might conflict with card.blade.php */
        .gallery-section .card,
        .gallery-section .card-body,
        .gallery-section .card-title,
        .gallery-section .card-text {
            all: revert;
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
    
        .mt-4 {
            margin-top: 1.5rem;
        }
        
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        
        /* PERBAIKAN STICKY MAP */
        .sticky-map-container {
            position: sticky;
            top: 20px;
            height: 80vh; /* Gunakan vh untuk height yang konsisten */
            max-height: 600px;
            min-height: 400px;
            z-index: 10; /* Tambahkan z-index */
        }
        
        /* PERBAIKAN MAP DENGAN ASPECT RATIO */
        .parent-map-responsive {
            width: 100%;
            /* Remove fixed 100vh height */
        }
        
        .map-responsive {
            position: sticky;
            top: 20px;
            width: 100%;
            /* Gunakan aspect ratio yang konsisten */
            aspect-ratio: 4/3; /* Rasio 4:3 (landscape) */
            max-height: 70vh; /* Batasi tinggi maksimal */
            min-height: 400px; /* Tinggi minimal */
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: #f0f0f0; /* Fallback background */
        }
        
        .map-responsive iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 12px;
        }
        
        /* Gallery Container - Beri height yang cukup untuk scrolling */
        .gallery-container {
            min-height: 120vh; /* Pastikan ada konten untuk di-scroll */
            overflow: hidden;
        }
        
        .masonry-grid {
            column-count: 2;
            column-gap: 15px;
            column-fill: balance;
        }
        
        .masonry-item {
            break-inside: avoid;
            margin-bottom: 15px;
            display: inline-block;
            width: 100%;
        }
        
        .masonry-content {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .masonry-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        
        .masonry-content img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        
        .masonry-content:hover img {
            transform: scale(1.05);
        }
        
        /* Masonry overlay */
        .masonry-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .masonry-overlay i {
            color: white;
            font-size: 2rem;
            transition: transform 0.3s ease;
        }
        
        .masonry-item:hover .masonry-overlay {
            opacity: 1;
        }
        
        .masonry-item:hover .masonry-overlay i {
            transform: scale(1.2);
        }
        

  
        .modal.show {
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 1;
        }
        
        @keyframes zoomIn {
            from {transform: scale(0.8);}
            to {transform: scale(1);}
        }
        
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            z-index: 1001;
        }
        
        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }


        
        /* Responsive */
        @media (max-width: 991.98px) {
            .col-6 {
                width: 100%;
            }
            
            .sticky-map-container {
                position: relative;
                top: auto;
                height: 400px;
                margin-bottom: 20px;
            }
            
            .gallery-container {
                min-height: auto;
            }
            
            .masonry-grid {
                column-count: 2;
            }
        }
        
        @media (max-width: 768px) {
            .masonry-overlay i {
                font-size: 1.5rem;
            }
            
            .row-cang {    
            grid-template-columns: repeat(1, 1fr);
            gap: 1rem;
            }
            
            .map-responsive {
            aspect-ratio: 4/3;
            max-height: 40vh;
            min-height: 250px;
        }
        
    </style>


@endsection

@section('scripts')
    <script>
       

        // Wait for the document to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
             // Gallery Modal Functions
     
        
        // Close modal when clicking outside the image
        document.getElementById('galleryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                galleryCloseModal();
            }
        });
        
        // Close with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                galleryCloseModal();
            }
        });
            // Check if GSAP is loaded
            if (typeof gsap !== 'undefined' && gsap) {
                // Register ScrollTrigger plugin
                gsap.registerPlugin(ScrollTrigger);

                // Create a timeline for the initial load animation
                const tl = gsap.timeline();

            // Banner Animation - Professional entrance
            tl.to('.gsap-banner', {
                opacity: 1,
                y: 0,
                duration: 1.2,
                ease: "power3.out"
            })
            .to('.banner-image', {
                opacity: 1,
                scale: 1,
                duration: 0.8,
                ease: "power2.out"
            }, "-=0.8")
            .to('.gsap-control', {
                opacity: 1,
                duration: 0.6,
                stagger: 0.2,
                ease: "power2.out"
            }, "-=0.4");

            // Documentation Section Animation with ScrollTrigger
            gsap.to('.gsap-documentation', {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: '.gsap-documentation',
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                }
            });

            gsap.to('.gsap-title', {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: '.gsap-title',
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            });

            // Cards Animation
            gsap.to('.gsap-cards', {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: '.gsap-cards',
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });

            // Location Section - Sophisticated Animation
            const locationTl = gsap.timeline({
                scrollTrigger: {
                    trigger: '.gsap-location',
                    start: 'top 75%',
                    end: 'bottom 25%',
                    toggleActions: 'play none none reverse'
                }
            });

            locationTl.to('.gsap-location', {
                opacity: 1,
                y: 0,
                duration: 1.2,
                ease: "power3.out"
            })
            .to('.gsap-line-left', {
                scaleX: 1,
                duration: 0.8,
                ease: "power2.out"
            }, "-=0.8")
            .to('.gsap-line-right', {
                scaleX: 1,
                duration: 0.8,
                ease: "power2.out"
            }, "-=0.8")
            .to('.gsap-location-title', {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "back.out(1.7)"
            }, "-=0.4");

            // Map and Contact Info - Parallel Animation
            const mapContactTl = gsap.timeline({
                scrollTrigger: {
                    trigger: '.gsap-map',
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });

            mapContactTl.to('.gsap-map', {
                opacity: 1,
                x: 0,
                duration: 1,
                ease: "power3.out"
            })
            .to('.gsap-contact-info', {
                opacity: 1,
                x: 0,
                duration: 1,
                ease: "power3.out"
            }, "-=0.8")
            .to('.gsap-contact-title', {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power2.out"
            }, "-=0.6")
            .to('.gsap-contact-desc', {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power2.out"
            }, "-=0.4")
            .to('.gsap-contact-subtitle', {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power2.out"
            }, "-=0.4")
            .to('.gsap-contact-item', {
                opacity: 1,
                x: 0,
                duration: 0.5,
                stagger: 0.1,
                ease: "power2.out"
            }, "-=0.2");

            // Professional hover animations
            const contactItems = document.querySelectorAll('.gsap-contact-item');
            contactItems.forEach(item => {
                item.addEventListener('mouseenter', () => {
                    gsap.to(item, {
                        x: 10,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
                
                item.addEventListener('mouseleave', () => {
                    gsap.to(item, {
                        x: 0,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
            });

            // Smooth scroll enhancement
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = document.querySelector(link.getAttribute('href'));
                    if (target) {
                        gsap.to(window, {
                            duration: 1.5,
                            scrollTo: {
                                y: target,
                                offsetY: 80
                            },
                            ease: "power3.inOut"
                        });
                    }
                });
            });

            // Parallax effect for banner
            gsap.to('.banner-image', {
                yPercent: -30,
                ease: "none",
                scrollTrigger: {
                    trigger: '.gsap-banner',
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            });

            // Performance optimization - refresh ScrollTrigger on window resize
            window.addEventListener('resize', () => {
                ScrollTrigger.refresh();
            });
            } else {
                console.error('GSAP is not loaded properly');
            }
        }, { once: true }); // Ensure this only runs once
    </script>
    
@endsection