@extends('user.layout.main')

@section('content')
    <h1 class="mt-4">Pengajuan Kegiatan Baru</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Isi Data Untuk Melakukan Pengajuan Kegiatan</li>
    </ol>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container-form">
        <form action="{{ route('user.storekegiatan') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="my-3 p-3 bg-body rounded shadow-sm">

                <div class="mb-3 row">
                    <label for="nama_pengaju" class="col-sm-2 col-form-label">Nama Pengaju</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control simple-input" name="nama_pengaju" id="nama_pengaju"
                            value="{{ old('nama_pengaju') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control simple-input" name="alamat" id="alamat"
                            value="{{ old('alamat') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="no_telepon" class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control simple-input" name="no_telepon" id="no_telepon"
                            value="{{ old('no_telepon') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="judul_kegiatan" class="col-sm-2 col-form-label">Judul Kegiatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control simple-input" name="judul_kegiatan" id="judul_kegiatan"
                            value="{{ old('judul_kegiatan') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Kegiatan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control simple-input" name="deskripsi" id="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tanggal_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control simple-input" name="tanggal_mulai" id="tanggal_mulai"
                            value="{{ old('tanggal_mulai') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tanggal_selesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control simple-input" name="tanggal_selesai" id="tanggal_selesai"
                            value="{{ old('tanggal_selesai') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_instansi" class="col-sm-2 col-form-label">Nama Instansi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control simple-input" name="nama_instansi" id="nama_instansi"
                            value="{{ old('nama_instansi') }}" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="surat_pengajuan" class="col-sm-2 col-form-label">Surat Pengajuan (PDF)</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control simple-input" name="surat_pengajuan" id="surat_pengajuan"
                            accept=".pdf" required>
                        <small class="text-muted">Format file harus PDF, maksimal 2MB</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary" name="submit">AJUKAN</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <style>
        .simple-input {
            border: none;
            border-bottom: 1px solid #ced4da;
            border-radius: 0;
            box-shadow: none;
        }

        .simple-input:focus {
            border-bottom: 2px solid #0d6efd;
            outline: none;
            box-shadow: none;
        }

        .container-form {
            max-width: 850px;
            margin: auto;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var unavailableRanges = @json($unavailableRanges); // Dikirim dari controller

            // Inisialisasi flatpickr untuk input tanggal mulai
            flatpickr("#tanggal_mulai", {
                disable: unavailableRanges.map(range => {
                    return {
                        from: range.from,
                        to: range.to
                    };
                }), // Menonaktifkan rentang tanggal mulai sampai selesai jika status 'disetujui'
                dateFormat: "Y-m-d",
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    var date = dayElem.dateObj;
                    var dateStr = date.toISOString().split('T')[0]; // Format date YYYY-MM-DD

                    // Cek jika tanggal ada di rentang unavailableRanges
                    for (let range of unavailableRanges) {
                        if (dateStr >= range.from && dateStr <= range.to) {
                            dayElem.setAttribute('title', 'Jadwal sudah terisi'); // Menambahkan tooltip
                            dayElem.style.opacity = "0.5"; // Mengatur transparansi tanggal
                        }
                    }
                }
            });

            // Jika ada input tanggal selesai, atur juga agar tidak bisa memilih rentang tanggal yang sudah disetujui
            flatpickr("#tanggal_selesai", {
                disable: unavailableRanges.map(range => {
                    return {
                        from: range.from,
                        to: range.to
                    };
                }), // Menonaktifkan rentang tanggal mulai sampai selesai jika status 'disetujui'
                dateFormat: "Y-m-d",
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    var date = dayElem.dateObj;
                    var dateStr = date.toISOString().split('T')[0];

                    // Cek jika tanggal ada di rentang unavailableRanges
                    for (let range of unavailableRanges) {
                        if (dateStr >= range.from && dateStr <= range.to) {
                            dayElem.setAttribute('title', 'Jadwal sudah terisi');
                            dayElem.style.opacity = "0.5"; // Mengatur transparansi tanggal
                        }
                    }
                }
            });
        });
    </script>

@endsection
