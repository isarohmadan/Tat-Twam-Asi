{{-- Blog Posts Section --}}
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            {{-- Featured Post (Berita Terbaru yang Besar) --}}
            @if(isset($featuredBerita))
                <div class="card mb-4">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#beritaModal{{ $featuredBerita->id }}">
                        @if($featuredBerita->featuredImage)
                            <img class="card-img-top" src="{{ Storage::url($featuredBerita->featuredImage->path) }}"
                                 alt="{{ $featuredBerita->judul }}" style="height: 400px; object-fit: cover;" />
                        @endif
                    </a>
                    <div class="card-body">
                        <div class="small text-muted">
                            {{-- Menampilkan tanggal dengan format F j, Y --}}
                            {{ $featuredBerita->tanggal_publikasi ? $featuredBerita->tanggal_publikasi->format('F j, Y') : 'Tanggal tidak tersedia' }}
                        </div>
                        <h2 class="card-title">{{ $featuredBerita->judul }}</h2>
                        <p class="card-text">{{ Str::limit($featuredBerita->ringkasan, 150) }}</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#beritaModal{{ $featuredBerita->id }}">
                            Read more →
                        </button>
                    </div>
                </div>
            @endif

            {{-- Other Posts --}}
            <div class="row">
                @forelse($beritas->where('id', '!=', optional($featuredBerita)->id)->chunk(2) as $chunk)
                    @foreach($chunk as $berita)
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#beritaModal{{ $berita->id }}">
                                    @if($berita->featuredImage)
                                        <img class="card-img-top" src="{{ Storage::url($berita->featuredImage->path) }}"
                                             alt="{{ $berita->judul }}" style="height: 250px; object-fit: cover;" />
                                    @endif
                                </a>
                                <div class="card-body">
                                    <div class="small text-muted">
                                        {{-- Menampilkan tanggal dengan format F j, Y --}}
                                        {{ $berita->tanggal_publikasi ? $berita->tanggal_publikasi->format('F j, Y') : 'Tanggal tidak tersedia' }}
                                    </div>
                                    <h2 class="card-title h4">{{ $berita->judul }}</h2>
                                    <p class="card-text">{{ Str::limit($berita->ringkasan, 100) }}</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#beritaModal{{ $berita->id }}">
                                        Read more →
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Tidak ada berita tersedia</div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

{{-- Modal Loop for Semua Berita --}}
@foreach($beritas as $berita)
    <div class="modal fade" id="beritaModal{{ $berita->id }}" tabindex="-1" aria-labelledby="beritaModalLabel{{ $berita->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="beritaModalLabel{{ $berita->id }}">Detail Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if($berita->images && $berita->images->count() > 0)
                                <div id="carousel{{ $berita->id }}" class="carousel slide mb-3" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($berita->images as $index => $image)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ Storage::url($image->path) }}" class="d-block w-100 rounded"
                                                     alt="{{ $berita->judul }}" style="max-height: 400px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $berita->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $berita->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @endif

                            <h2 class="mb-3">{{ $berita->judul }}</h2>
                            <div class="text-muted mb-3">
                                {{-- Menampilkan tanggal dengan format F j, Y --}}
                                {{ $berita->tanggal_publikasi ? $berita->tanggal_publikasi->format('F j, Y') : 'Tanggal tidak tersedia' }}
                            </div>
                            <div class="fs-5 mb-3 fw-bold">{{ $berita->ringkasan }}</div>
                            <div class="fs-5">{!! nl2br(e($berita->isi)) !!}</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
