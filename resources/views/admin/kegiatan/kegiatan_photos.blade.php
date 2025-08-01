@extends('admin.layout.reusable')

@section('content')
    <h1 class="mt-4">Daftar Foto Kegiatan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Kelola Foto Kegiatan yang Diupload oleh Pengguna</li>
    </ol>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Kegiatan</th>
                    <th>Deskripsi Kegiatan</th> <!-- Kolom baru untuk deskripsi kegiatan -->
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kegiatanGrouped as $kegiatanId => $photos)
                    @php
                        $firstPhoto = $photos->first(); // Ambil foto pertama untuk judul kegiatan
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $firstPhoto->kegiatan->judul_kegiatan }}</td> <!-- Menampilkan judul kegiatan -->

                        <!-- Menampilkan deskripsi kegiatan -->
                        <td>{{ $firstPhoto->kegiatan->deskripsi }}</td> <!-- Menampilkan deskripsi kegiatan -->

                        <!-- Menampilkan foto -->
                        <td>
                            @foreach ($photos as $photo)
                                @if ($photo->photo_path)
                                    <!-- Pastikan foto ada -->
                                    <div class="d-inline-block me-2">
                                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Foto Kegiatan"
                                            style="width: 100px; height: auto;">
                                    </div>
                                @else
                                    <span>No Photo Available</span> <!-- Menampilkan pesan jika foto tidak ada -->
                                @endif
                            @endforeach
                        </td>

                        <!-- Tombol Lihat Detail dan Download Semua Foto -->
                        <td>
                            <a href="{{ route('admin.kegiatan.downloadAllPhotos', $kegiatanId) }}"
                                class="btn btn-sm btn-primary">Download Semua Foto</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $kegiatanPhotos->links() }}
    </div>
@endsection
