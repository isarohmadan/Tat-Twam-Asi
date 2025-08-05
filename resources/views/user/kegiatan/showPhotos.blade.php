@extends('user.layout.main')

@section('content')
    <h1 class="mt-4">Foto Kegiatan: {{ $kegiatan->judul_kegiatan }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Foto Kegiatan</li>
    </ol>

    <div class="row">
        @foreach ($photos as $photo)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $photo->photo_path) }}" class="card-img-top" alt="Foto Kegiatan">
                </div>
            </div>
        @endforeach
    </div>
@endsection
