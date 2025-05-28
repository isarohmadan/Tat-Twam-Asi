@extends('admin.layout.reusable')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Banner Management</h3>
                    </div>
                    <div class="card-body">
                        <!-- Form untuk upload banner baru -->
                        <div class="mb-4">
                            <h4>Add New Banner</h4>
                            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="banner_image">Banner Image</label>
                                    <input type="file"
                                        class="form-control-file @error('banner_image') is-invalid @enderror"
                                        id="banner_image" name="banner_image" required>
                                    @error('banner_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="form-text text-muted">Format: jpeg, png, jpg, gif, svg. Max size:
                                        2MB</small>
                                </div>
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" class="form-control" id="order" name="order"
                                        value="{{ $nextOrder }}" min="1">

                                </div>
                                <button type="submit" class="btn btn-primary">Upload Banner</button>
                            </form>
                        </div>

                        <!-- Daftar banner -->
                        <h4>Banner List</h4>
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
                                        <th>Image</th>
                                        <th>Order</th>
                                        <th>Actions</th>
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
                                                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this banner?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal{{ $banner->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel{{ $banner->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $banner->id }}">Edit
                                                            Banner</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('banners.update', $banner->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="banner_image">New Banner Image (Leave empty to
                                                                    keep current)</label>
                                                                <input type="file" class="form-control-file"
                                                                    id="banner_image" name="banner_image">
                                                                <small class="form-text text-muted">Current image:</small>
                                                                <img src="{{ asset('storage/' . $banner->image_path) }}"
                                                                    alt="Current Banner" style="max-width: 100%;">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="order">Order</label>
                                                                <input type="number" class="form-control" id="order"
                                                                    name="order" value="{{ $banner->order }}"
                                                                    min="1">
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
