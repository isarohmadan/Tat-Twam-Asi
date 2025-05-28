{{-- Blog Posts Section --}}
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-12">
            @if($featuredBerita)
                <!-- Featured blog post-->
                <div class="card mb-4">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#beritaModal" 
                       onclick="showBerita({{ $featuredBerita->id }})">
                        <img class="card-img-top" src="{{ Storage::url($featuredBerita->gambar) }}" 
                             alt="{{ $featuredBerita->judul }}" style="height: 300px; object-fit: cover;" />
                    </a>
                    <div class="card-body">
                        <div class="small text-muted">{{ $featuredBerita->tanggal_publikasi->format('F j, Y') }}</div>
                        <h2 class="card-title">{{ $featuredBerita->judul }}</h2>
                        <p class="card-text">{{ Str::limit($featuredBerita->ringkasan, 150) }}</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#beritaModal" 
                                onclick="showBerita({{ $featuredBerita->id }})">
                            Read more →
                        </button>
                    </div>
                </div>
            @endif

            <div class="row">
                @foreach($beritas->chunk(2) as $chunk)
                    @foreach($chunk as $berita)
                        <div class="col-lg-6">
                            <!-- Blog post -->
                            <div class="card mb-4">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#beritaModal" 
                                   onclick="showBerita({{ $berita->id }})">
                                    <img class="card-img-top" src="{{ Storage::url($berita->gambar) }}" 
                                         alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;" />
                                </a>
                                <div class="card-body">
                                    <div class="small text-muted">{{ $berita->tanggal_publikasi->format('F j, Y') }}</div>
                                    <h2 class="card-title h4">{{ $berita->judul }}</h2>
                                    <p class="card-text">{{ Str::limit($berita->ringkasan, 100) }}</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#beritaModal" 
                                            onclick="showBerita({{ $berita->id }})">
                                        Read more →
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="beritaModal" tabindex="-1" aria-labelledby="beritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="beritaModalLabel">Detail Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="beritaLoading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div id="beritaContent" style="display: none;">
                    <h2 id="beritaJudul" class="mb-3"></h2>
                    <div class="text-muted mb-3" id="beritaTanggal"></div>
                    <img id="beritaGambar" src="" class="img-fluid rounded mb-3" alt="">
                    <div id="beritaRingkasan" class="fs-5 mb-3"></div>
                    <div id="beritaIsi" class="fs-5"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function showBerita(id) {
        // Show loading, hide content
        $('#beritaLoading').show();
        $('#beritaContent').hide();
        
        // Fetch berita data
        $.get(`/berita/${id}`, function(data) {
            // Populate modal
            $('#beritaJudul').text(data.judul);
            $('#beritaTanggal').text(new Date(data.tanggal_publikasi).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            }));
            $('#beritaGambar').attr('src', `/storage/${data.gambar}`).attr('alt', data.judul);
            $('#beritaRingkasan').text(data.ringkasan);
            $('#beritaIsi').html(data.isi.replace(/\n/g, '<br>'));
            
            // Hide loading, show content
            $('#beritaLoading').hide();
            $('#beritaContent').show();
        }).fail(function() {
            alert('Gagal memuat data berita');
            $('#beritaModal').modal('hide');
        });
    }
    
    // Reset modal when closed
    $('#beritaModal').on('hidden.bs.modal', function () {
        $('#beritaLoading').show();
        $('#beritaContent').hide();
    });
</script>
@endsection