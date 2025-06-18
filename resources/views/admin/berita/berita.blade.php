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
                                <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" name="gambar[]" multiple required>
                                @error('gambar') <span class="text-danger">{{ $message }}</span> @enderror
                                <small class="form-text text-muted">Format: jpeg, png, jpg, gif, svg. Max size: 2MB per gambar</small>
                            </div>
                            <div class="form-group">
                                <label>Gambar Utama</label>
                                <select class="form-control" name="featured_image" required>
                                    <option value="0">Pilih gambar utama (default gambar pertama)</option>
                                </select>
                                <small class="form-text text-muted">Gambar yang akan ditampilkan sebagai thumbnail</small>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Publikasi</label>
                                <input type="date" class="form-control @error('tanggal_publikasi') is-invalid @enderror" name="tanggal_publikasi" value="{{ old('tanggal_publikasi') }}" required>
                                @error('tanggal_publikasi') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>

                    {{-- Daftar Berita --}}
                    <h4>Daftar Berita</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Gambar Utama</th>
                                    <th>Jumlah Gambar</th>
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
                                            @if($berita->featuredImage)
                                                <img src="{{ Storage::url($berita->featuredImage->path) }}" alt="Gambar Utama" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>{{ $berita->images->count() }}</td>
                                        <td>{{ $berita->tanggal_publikasi instanceof \Carbon\Carbon ? $berita->tanggal_publikasi->format('d M Y') : $berita->tanggal_publikasi }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal{{ $berita->id }}">Edit</button>
                                            <form action="{{ route('beritas.destroy', $berita->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Berita -->
                                    <div class="modal fade" id="editModal{{ $berita->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $berita->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $berita->id }}">Edit Berita</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('beritas.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label>Judul</label>
                                                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $berita->judul) }}" required>
                                                            @error('judul') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Ringkasan</label>
                                                            <textarea class="form-control @error('ringkasan') is-invalid @enderror" name="ringkasan" rows="2" required>{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                                                            @error('ringkasan') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Isi</label>
                                                            <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" rows="5" required>{{ old('isi', $berita->isi) }}</textarea>
                                                            @error('isi') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Gambar</label>
                                                            <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" name="gambar[]" multiple>
                                                            @error('gambar') <span class="text-danger">{{ $message }}</span> @enderror
                                                            <small class="form-text text-muted">Format: jpeg, png, jpg, gif, svg. Max size: 2MB per gambar</small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Gambar Utama</label>
                                                            <select class="form-control" name="featured_image" required>
                                                                <option value="0">Pilih gambar utama (default gambar pertama)</option>
                                                                @foreach($berita->images as $image)
                                                                    <option value="{{ $image->id }}" {{ $berita->featuredImage && $berita->featuredImage->id == $image->id ? 'selected' : '' }}>
                                                                        {{ $image->path }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <small class="form-text text-muted">Gambar yang akan ditampilkan sebagai thumbnail</small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Tanggal Publikasi</label>
                                                            <input type="date" class="form-control @error('tanggal_publikasi') is-invalid @enderror" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', \Carbon\Carbon::parse($berita->tanggal_publikasi)->format('Y-m-d')) }}" required>

                                                            @error('tanggal_publikasi') <span class="text-danger">{{ $message }}</span> @enderror
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Perbarui Berita</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit -->
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
