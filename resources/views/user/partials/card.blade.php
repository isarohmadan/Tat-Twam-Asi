  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      @php
          $otherBeritas = $beritas->where('id', '!=', optional($featuredBerita)->id);
      @endphp
      
      @forelse($otherBeritas as $berita)
          <div class="swiper-slide">
              {{-- Debug: Uncomment to check post data --}}
              {{-- @dd($berita) --}}
              
              <div class="card h-100 shadow-sm gsap-blog-card position-relative" 
                   data-card-index="{{ $loop->index }}">
                  <!-- Featured Badge -->
                  @php
                      // Check if post is featured (using either is_featured or featured column)
                      $isFeatured = $berita->is_featured ?? $berita->featured ?? false;
                      $isNew = $berita->created_at->diffInDays(now()) <= 3;
                      $showBadge = $isFeatured || $isNew;
                  @endphp
                  
                  @if($showBadge)
                      <div class="position-absolute top-0 end-0 m-2" style="z-index: 10;">
                          <span class="badge {{ $isFeatured ? 'bg-danger' : 'bg-primary' }} px-3 py-2 text-white" 
                                style="font-size: 0.8rem; border-radius: 50px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                              <i class="fas {{ $isFeatured ? 'fa-fire' : 'fa-star' }} me-1"></i>
                              {{ $isFeatured ? 'Hot!' : 'New' }}
                          </span>
                      </div>
                  @endif
                  <a href="#" data-bs-toggle="modal"
                      data-bs-target="#beritaModal{{ $berita->id }}" class="gsap-card-link">
                      @if ($berita->featuredImage)
                          <div class="card-image-container" style="overflow: hidden; border-radius: 0.375rem 0.375rem 0 0;">
                              <img class="card-img-top gsap-card-image" 
                                   src="{{ Storage::url($berita->featuredImage->path) }}"
                                   alt="{{ $berita->judul }}" 
                                   style="height: 250px; width: 100%; object-fit: cover; transition: transform 0.5s ease; transform: scale(1);" />
                          </div>
                      @endif
                  </a>
                  <div class="card-body d-flex flex-column">
                      <div class="small text-muted mb-2 gsap-card-date" style="opacity: 0; transform: translateY(10px);">
                          {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->locale('id')->translatedFormat('j F Y') }}
                      </div>
                      <h5 class="card-title gsap-card-title" style="opacity: 0; transform: translateY(15px);">
                          {{ $berita->judul }}
                      </h5>
                      <p class="card-text gsap-card-text" style="opacity: 0; transform: translateY(20px);">
                          {{ Str::limit($berita->ringkasan, 100) }}
                      </p>
                      <button class="btn gsap-card-btn mt-auto" data-bs-toggle="modal"
                          data-bs-target="#beritaModal{{ $berita->id }}"
                          style="background-color: #388E3C; color: white; padding: 6px 18px; font-size: 14px; border-radius: 50px; display: inline-flex; align-items: center; justify-content: center; transition: all 0.4s ease; max-width: fit-content; border: none; opacity: 0; transform: translateY(25px); box-shadow: 0 3px 12px rgba(56, 142, 60, 0.25);">
                          <span class="btn-circle"
                              style="background-color: white; color: #388E3C; border-radius: 50%; width: 28px; height: 28px; display: flex; justify-content: center; align-items: center; margin-right: 10px; font-size: 16px; transition: transform 0.3s ease;">
                              <i class="bi bi-arrow-right"></i>
                          </span>
                          Baca Selengkapnya
                      </button>
                  </div>
              </div>
          </div>
      @empty
          <div class="swiper-slide">
              <div class="alert alert-info gsap-no-news w-100" style="opacity: 0; transform: translateY(30px);">
                  Tidak ada berita tersedia
              </div>
          </div>
      @endforelse
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>
  <style>


    .swiper {
      width: 100%;
      padding: 20px 0 60px;
      overflow: hidden;
    }
    
    .swiper-pagination {
      position: relative;
      bottom: 0;
      margin-top: 40px;
    }
    
    .swiper-pagination-bullet {
      width: 10px;
      height: 10px;
      background: #ddd;
      opacity: 1;
      margin: 0 5px;
      transition: all 0.3s ease;
    }
    .content-title{
        font-size:3rem;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      margin-top: -4rem;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: all 0.3s ease;
    }

    
    .swiper-pagination-bullet-active {
      background: #388E3C;
      transform: scale(1.2);
    }
    
    .swiper-slide {
      height: auto;
      display: flex;
      justify-content: center;
      padding: 10px;
    }
    
    .swiper-slide .card {
      width: 100%;
      border: 1px solid rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .swiper-slide .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }


    .swiper-slide img {
      display: block;
      width: 100%;
      height: 500px;
      object-fit: cover;
    }
  </style>
  <!-- Initialize Swiper -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          dynamicBullets: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          576: {
            slidesPerView: 1,
            spaceBetween: 20
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 25
          },
          992: {
            slidesPerView: 3,
            spaceBetween: 30
          }
        },
        on: {
          init: function() {
            // Animate cards when swiper is initialized
            gsap.utils.toArray('.gsap-blog-card').forEach((card, i) => {
              gsap.to(card, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                delay: i * 0.1,
                ease: 'power2.out'
              });
            });
          }
        }
      });
      
      // Reinitialize Swiper when modals are closed
      document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function () {
          swiper.update();
        });
      });
    });
  </script>
{{-- Modal Loop for Semua Berita --}}
@foreach ($beritas as $berita)
    <div class="modal fade gsap-modal" id="beritaModal{{ $berita->id }}" tabindex="-1"
        aria-labelledby="beritaModalLabel{{ $berita->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border: none; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                <div class="modal-header" style="border-bottom: 1px solid #e9ecef; border-radius: 16px 16px 0 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <h5 class="modal-title fw-bold" id="beritaModalLabel{{ $berita->id }}" style="color: #2c3e50;">
                        Detail Berita
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" 
                            style="filter: none; opacity: 0.8;"></button>
                </div>
                <div class="modal-body" style="padding: 2rem;">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($berita->images && $berita->images->count() > 0)
                                <div id="carousel{{ $berita->id }}" class="carousel slide mb-4 gsap-modal-carousel"
                                    data-bs-ride="carousel" style="border-radius: 12px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.1);">
                                    <div class="carousel-inner">
                                        @foreach ($berita->images as $index => $image)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ Storage::url($image->path) }}"
                                                    class="d-block w-100" alt="{{ $berita->judul }}"
                                                    style="max-height: 400px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($berita->images->count() > 1)
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carousel{{ $berita->id }}" data-bs-slide="prev"
                                            style="background: rgba(0,0,0,0.3); border-radius: 50%; width: 50px; height: 50px; top: 50%; transform: translateY(-50%); left: 15px;">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carousel{{ $berita->id }}" data-bs-slide="next"
                                            style="background: rgba(0,0,0,0.3); border-radius: 50%; width: 50px; height: 50px; top: 50%; transform: translateY(-50%); right: 15px;">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    @endif
                                </div>
                            @endif

                            <h2 class="mb-3 gsap-modal-title" style="color: #2c3e50; font-weight: 700; line-height: 1.3;">
                                {{ $berita->judul }}
                            </h2>
                            <div class="text-muted mb-4 gsap-modal-date" style="font-size: 0.95rem; font-weight: 500;">
                                <i class="bi bi-calendar3 me-2"></i>
                                {{-- Menampilkan tanggal dengan format F j, Y --}}
                                {{ $berita->tanggal_publikasi ? $berita->tanggal_publikasi->format('F j, Y') : 'Tanggal tidak tersedia' }}
                            </div>
                            <div class="fs-5 mb-4 fw-semibold gsap-modal-summary" style="color: #34495e; line-height: 1.6; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; border-left: 4px solid #388E3C;">
                                {{ $berita->ringkasan }}
                            </div>
                            <div class="fs-6 gsap-modal-content" style="line-height: 1.8; color: #2c3e50;">
                                {!! nl2br(e($berita->isi)) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e9ecef; border-radius: 0 0 16px 16px; background: #f8f9fa;">
                    <button type="button" class="btn" data-bs-dismiss="modal" 
                            style="background-color: #6c757d; color: white; border-radius: 25px; padding: 8px 24px; border: none; transition: all 0.3s ease;">
                        <i class="bi bi-x-circle me-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Enhanced Styles for Professional Blog Cards -->
<style>
    /* Professional Card Hover Effects */
    .gsap-blog-card:hover,
    .gsap-featured-card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
    }

    .gsap-featured-link:hover .gsap-featured-image,
    .gsap-card-link:hover .gsap-card-image {
        transform: scale(1.08) !important;
    }

    /* Button Hover Effects */
    .gsap-featured-btn:hover,
    .gsap-card-btn:hover {
        background-color: #2e7d32 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(56, 142, 60, 0.4) !important;
    }

    .gsap-featured-btn:hover .btn-circle,
    .gsap-card-btn:hover .btn-circle {
        transform: translateX(5px) !important;
    }

    /* Modal Enhancements */
    .gsap-modal .modal-content {
        animation: modalSlideIn 0.4s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Card Image Loading Effect */
    .gsap-featured-image,
    .gsap-card-image {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200px 100%;
        animation: shimmer 1.5s infinite linear;
    }

    .gsap-featured-image[src],
    .gsap-card-image[src] {
        animation: none;
        background: none;
    }

    @keyframes shimmer {
        0% { background-position: -200px 0; }
        100% { background-position: calc(200px + 100%) 0; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .gsap-featured-btn,
        .gsap-card-btn {
            font-size: 14px !important;
            padding: 6px 16px !important;
        }
        
        .gsap-featured-btn .btn-circle {
            width: 30px !important;
            height: 30px !important;
            font-size: 18px !important;
        }
    }

    /* Card Text Gradients */
    .card-title {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 600;
    }

    /* Smooth transitions for all interactive elements */
    .card, .btn, .card-img-top, .btn-circle {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Blog Cards Animation Timeline
    const blogTl = gsap.timeline({
        scrollTrigger: {
            trigger: '.gsap-blog-container',
            start: 'top 85%',
            end: 'bottom 20%',
            toggleActions: 'play none none reverse'
        }
    });

    // Container fade in
    blogTl.to('.gsap-blog-container', {
        opacity: 1,
        y: 0,
        duration: 0.8,
        ease: "power3.out"
    });

    // Featured card animation
    if (document.querySelector('.gsap-featured-card')) {
        blogTl.to('.gsap-featured-card', {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power3.out"
        }, "-=0.4")
        .to('.gsap-featured-date', {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power2.out"
        }, "-=0.6")
        .to('.gsap-featured-title', {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power2.out"
        }, "-=0.4")
        .to('.gsap-featured-text', {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power2.out"
        }, "-=0.4")
        .to('.gsap-featured-btn', {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "back.out(1.7)"
        }, "-=0.2");
    }

    // Regular blog cards animation
    const blogCards = document.querySelectorAll('.gsap-blog-card');
    if (blogCards.length > 0) {
        blogTl.to('.gsap-blog-card', {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.15,
            ease: "power3.out"
        }, "-=0.6");

        // Individual card content animations
        blogCards.forEach((card, index) => {
            const cardTl = gsap.timeline({
                scrollTrigger: {
                    trigger: card,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse'
                }
            });

            cardTl.to(card.querySelector('.gsap-card-date'), {
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: "power2.out"
            })
            .to(card.querySelector('.gsap-card-title'), {
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: "power2.out"
            }, "-=0.3")
            .to(card.querySelector('.gsap-card-text'), {
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: "power2.out"
            }, "-=0.3")
            .to(card.querySelector('.gsap-card-btn'), {
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: "back.out(1.7)"
            }, "-=0.2");
        });
    }

    // No news alert animation
    if (document.querySelector('.gsap-no-news')) {
        gsap.to('.gsap-no-news', {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: "power2.out",
            scrollTrigger: {
                trigger: '.gsap-no-news',
                start: 'top 90%',
                toggleActions: 'play none none reverse'
            }
        });
    }

    // Modal animations
    document.querySelectorAll('.gsap-modal').forEach(modal => {
        modal.addEventListener('shown.bs.modal', function() {
            const modalTl = gsap.timeline();
            
            modalTl.fromTo(modal.querySelector('.gsap-modal-title'), {
                opacity: 0,
                y: 20
            }, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power2.out"
            })
            .fromTo(modal.querySelector('.gsap-modal-date'), {
                opacity: 0,
                y: 15
            }, {
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: "power2.out"
            }, "-=0.4")
            .fromTo(modal.querySelector('.gsap-modal-summary'), {
                opacity: 0,
                y: 20
            }, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power2.out"
            }, "-=0.3")
            .fromTo(modal.querySelector('.gsap-modal-content'), {
                opacity: 0,
                y: 25
            }, {
                opacity: 1,
                y: 0,
                duration: 0.7,
                ease: "power2.out"
            }, "-=0.4");

            // Carousel animation if exists
            const carousel = modal.querySelector('.gsap-modal-carousel');
            if (carousel) {
                gsap.fromTo(carousel, {
                    opacity: 0,
                    scale: 0.95
                }, {
                    opacity: 1,
                    scale: 1,
                    duration: 0.8,
                    ease: "power2.out"
                });
            }
        });
    });

    // Enhanced hover effects
    blogCards.forEach(card => {
        const image = card.querySelector('.gsap-card-image');
        const btn = card.querySelector('.gsap-card-btn');
        const btnCircle = btn?.querySelector('.btn-circle');

        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                y: -8,
                boxShadow: "0 15px 40px rgba(0,0,0,0.15)",
                duration: 0.4,
                ease: "power2.out"
            });
            
            if (image) {
                gsap.to(image, {
                    scale: 1.08,
                    duration: 0.6,
                    ease: "power2.out"
                });
            }
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                y: 0,
                boxShadow: "0 1px 3px rgba(0,0,0,0.12)",
                duration: 0.4,
                ease: "power2.out"
            });
            
            if (image) {
                gsap.to(image, {
                    scale: 1,
                    duration: 0.6,
                    ease: "power2.out"
                });
            }
        });

        // Button hover effects
        if (btn && btnCircle) {
            btn.addEventListener('mouseenter', () => {
                gsap.to(btnCircle, {
                    x: 5,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });

            btn.addEventListener('mouseleave', () => {
                gsap.to(btnCircle, {
                    x: 0,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });
        }
    });

    // Featured card hover effects
    const featuredCard = document.querySelector('.gsap-featured-card');
    if (featuredCard) {
        const featuredImage = featuredCard.querySelector('.gsap-featured-image');
        const featuredBtn = featuredCard.querySelector('.gsap-featured-btn');
        const featuredBtnCircle = featuredBtn?.querySelector('.btn-circle');

        featuredCard.addEventListener('mouseenter', () => {
            gsap.to(featuredCard, {
                y: -8,
                boxShadow: "0 15px 40px rgba(0,0,0,0.15)",
                duration: 0.4,
                ease: "power2.out"
            });
            
            if (featuredImage) {
                gsap.to(featuredImage, {
                    scale: 1.08,
                    duration: 0.6,
                    ease: "power2.out"
                });
            }
        });

        featuredCard.addEventListener('mouseleave', () => {
            gsap.to(featuredCard, {
                y: 0,
                boxShadow: "0 1px 3px rgba(0,0,0,0.12)",
                duration: 0.4,
                ease: "power2.out"
            });
            
            if (featuredImage) {
                gsap.to(featuredImage, {
                    scale: 1,
                    duration: 0.6,
                    ease: "power2.out"
                });
            }
        });

        // Featured button hover effects
        if (featuredBtn && featuredBtnCircle) {
            featuredBtn.addEventListener('mouseenter', () => {
                gsap.to(featuredBtnCircle, {
                    x: 5,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });

            featuredBtn.addEventListener('mouseleave', () => {
                gsap.to(featuredBtnCircle, {
                    x: 0,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });
        }
    }
});
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">