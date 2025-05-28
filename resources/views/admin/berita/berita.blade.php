@extends('admin.layout.reusable')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Manajemen Berita</h3>
                </div>
                <div class="card-body">
                    {{-- Form Tambah Berita --}}
                    <div class="mb-4">
                        <h4>Tambah Berita Baru</h4>
                        <form action="{{ route('beritas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" required>
                                @error('judul') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" required>
                                @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Ringkasan</label>
                                <textarea class="form-control @error('ringkasan') is-invalid @enderror" name="ringkasan" rows="2" required>{{ old('ringkasan') }}</textarea>
                                @error('ringkasan') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Isi</label>
                                <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" rows="5" required>{{ old('isi') }}</textarea>
                                @error('isi') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" name="gambar" required>
                                @error('gambar') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="form-text text-muted">Format: jpeg, png, jpg, gif, svg. Max size: 2MB</small>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Publikasi</label>
                                <input type="date" class="form-control @error('tanggal_publikasi') is-invalid @enderror" name="tanggal_publikasi" required>
                                @error('tanggal_publikasi') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>

                    {{-- Notifikasi --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Daftar Berita --}}
                    <h4>Daftar Berita</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Gambar</th>
                                    <th>Tanggal Publikasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beritas as $index => $berita)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $berita->judul }}</td>
                                        <td>
                                            @if($berita->gambar)
                                                <img src="{{ Storage::url($berita->gambar) }}" alt="Gambar Berita" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>{{ $berita->tanggal_publikasi->format('d M Y') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal{{ $berita->id }}">Edit</button>
                                            <form action="{{ route('beritas.destroy', $berita->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="editModal{{ $berita->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $berita->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Berita</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <form action="{{ route('beritas.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Judul</label>
                                                            <input type="text" class="form-control" name="judul" value="{{ $berita->judul }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Slug</label>
                                                            <input type="text" class="form-control" name="slug" value="{{ $berita->slug }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Ringkasan</label>
                                                            <textarea class="form-control" name="ringkasan" rows="2" required>{{ $berita->ringkasan }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Isi</label>
                                                            <textarea class="form-control" name="isi" rows="5" required>{{ $berita->isi }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Gambar Baru (kosongkan jika tidak ganti)</label>
                                                            <input type="file" class="form-control-file" name="gambar">
                                                            <small class="form-text text-muted">Gambar sekarang:</small>
                                                            @if($berita->gambar)
                                                                <img src="{{ Storage::url($berita->gambar) }}" alt="Gambar Berita" style="max-width: 100%;">
                                                            @else
                                                                <span class="text-muted">Tidak ada gambar</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Publikasi</label>
                                                            <input type="date" class="form-control" name="tanggal_publikasi" value="{{ $berita->tanggal_publikasi->format('Y-m-d') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $beritas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.modal').on('show.bs.modal', function (event) {
            var modal = $(this);
        });
    });
</script>
@endsection