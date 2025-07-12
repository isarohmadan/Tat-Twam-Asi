@extends('user.layout.main')

@section('content')
    <h1 class="mt-4">Pengajuan Baru</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pengajuan Baru</li>
    </ol>

    <!-- Tambahkan pembungkus agar form tidak terlalu lebar -->
    <div class="container-form">
        <form action="{{ route('user.storekunjungan') }}" method="post">
            @csrf
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control simple-input" name='nama_pengaju' id="nama_pengaju"
                            required>
                        <!-- name diubah dari 'nama' menjadi 'nama_pengaju' -->
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control simple-input" name='alamat' id="alamat" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="no_hp" class="col-sm-2 col-form-label">No Handphone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control simple-input" name='no_hp' id="no_hp" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="judul_kegiatan" class="col-sm-2 col-form-label">Tujuan Kunjungan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control simple-input" name='judul_kegiatan' id="judul_kegiatan"
                            required>
                        <!-- name tetap 'judul_kegiatan' -->
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tanggal_kegiatan" class="col-sm-2 col-form-label">Tanggal Kunjungan</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control simple-input" name='tanggal_kegiatan'
                            id="tanggal_kegiatan" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="instansi" class="col-sm-2 col-form-label">Instansi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control simple-input" name='instansi' id="instansi" required>
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

        @media (max-width: 576px) {
            .container-form {
                padding: 0 15px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var unavailableRanges = @json($unavailableRanges); // Dikirim dari controller

            // Inisialisasi flatpickr untuk input tanggal kunjungan
            flatpickr("#tanggal_kegiatan", {
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
        });
    </script>
@endsection
