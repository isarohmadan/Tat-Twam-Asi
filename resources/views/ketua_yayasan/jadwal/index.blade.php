@extends('ketua_yayasan.layout.reusable')

@section('css')
    <style>
        /* Menyesuaikan tampilan kalender */
        #calendar {
            margin-top: 20px;
            width: 100%;
            padding: 20px;
            background: #f4f7fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: block;
            font-size: 18px;
            /* Membuat font kalender lebih besar */
        }

        /* Menambahkan ukuran font lebih besar untuk tanggal */
        .flatpickr-day {
            font-size: 20px;
            /* Ukuran font tanggal lebih besar */
        }

        /* Menambahkan warna latar belakang untuk tanggal yang terblokir */
        .disabled {
            background-color: rgba(255, 0, 0, 0.3);
            /* Warna latar belakang merah muda transparan */
            color: #fff;
            /* Warna teks putih */
            cursor: not-allowed;
            /* Menunjukkan bahwa tanggal tersebut tidak dapat dipilih */
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            #calendar {
                padding: 10px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Jadwal Pengajuan Kunjungan dan Kegiatan</h1>

        <!-- Kalender untuk melihat jadwal -->
        <div id="calendar"></div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var unavailableRanges = @json($unavailableRanges);

            console.log(unavailableRanges); // Debug: Cek data yang diterima

            flatpickr("#calendar", {
                inline: true, // Menampilkan kalender inline
                disable: unavailableRanges.map(range => {
                    return {
                        from: range.from,
                        to: range.to
                    };
                }), // Menonaktifkan rentang tanggal yang sudah disetujui
                dateFormat: "Y-m-d", // Format tanggal yang diterima flatpickr
                onDayCreate: function(dObj, dStr, fp, dayElem) {
                    var date = dayElem.dateObj;
                    var dateStr = date.toISOString().split('T')[0]; // Format date YYYY-MM-DD

                    for (let range of unavailableRanges) {
                        if (dateStr >= range.from && dateStr <= range.to) {
                            // Menambahkan tooltip dan transparansi
                            dayElem.setAttribute('title', 'Jadwal sudah terisi');
                            dayElem.style.opacity = "0.5";
                            dayElem.classList.add(
                                'disabled'
                                ); // Menambahkan class 'disabled' untuk memberi warna latar belakang
                        }
                    }
                }
            });
        });
    </script>
@endsection
