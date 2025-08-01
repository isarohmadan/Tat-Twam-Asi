@extends('admin.layout.reusable')

@section('content')
    <div class="my-3 p-3 bg-body rounded" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 -4px 6px rgba(0, 0, 0, 0.1);">
        <h2 class="fw-bold">Tambah Banner</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Tambah Banner</li>
        </ol>
        <div class="card-body">
            <!-- Form untuk upload banner baru -->
            <div class="mb-4">
                <h4>Banner Baru</h4>
                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="banner_image">Gambar Banner</label>
                        <input type="file" class="form-control-file @error('banner_image') is-invalid @enderror"
                            id="banner_image" name="banner_image" required>
                        @error('banner_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted">Format: jpeg, png, jpg, gif, svg. Max size:
                            3MB</small>
                    </div>
                    <div class="form-group">
                        <label for="order">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ $nextOrder }}"
                            min="1">

                    </div>
                    <button type="submit" class="btn btn-primary">Unggah Banner</button>
                </form>
            </div>

            <!-- Daftar banner -->
            <h4>Daftar Banner</h4>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Urutan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $index => $banner)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner Image"
                                        style="max-width: 200px; max-height: 100px;">
                                </td>
                                <td>{{ $banner->order }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#editModal{{ $banner->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this banner?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $banner->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editModalLabel{{ $banner->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $banner->id }}">Edit
                                                Banner</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="banner_image">New Banner Image (Leave empty to
                                                        keep current)</label>
                                                    <input type="file" class="form-control-file" id="banner_image"
                                                        name="banner_image">
                                                    <small class="form-text text-muted">Current image:</small>
                                                    <img src="{{ asset('storage/' . $banner->image_path) }}"
                                                        alt="Current Banner" style="max-width: 100%;">
                                                </div>
                                                <div class="form-group">
                                                    <label for="order">Urutan</label>
                                                    <input type="number" class="form-control" id="order" name="order"
                                                        value="{{ $banner->order }}" min="1">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi modal
            $('.modal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var modal = $(this);
            });
        });
    </script>
@endsection
