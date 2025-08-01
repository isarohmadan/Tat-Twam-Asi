@extends('admin.layout.reusable')

@section('content')
    <div class="container">
        <h2 class="my-4">Jadwal Kegiatan dan Kunjungan yang Disetujui</h2>

        <div id="calendar"></div>
    </div>

    @push('scripts')
        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css" rel="stylesheet" />

        <style>
            /* Menghilangkan highlight hari ini secara menyeluruh */
            /* Mengubah tampilan elemen yang menandai hari ini di FullCalendar */
            .fc-day-today {
                background-color: transparent !important;
                /* Hilangkan background */
                color: inherit !important;
                /* Hilangkan warna teks */
                font-weight: normal !important;
                /* Hilangkan penebalan teks */
            }

            /* Menghilangkan border di hari ini */
            .fc-day-today .fc-daygrid-day-number {
                border: none !important;
                /* Hilangkan border pada hari ini */
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: @json($events),
                    eventClick: function(info) {
                        alert('Event:' + info.event.title);
                    },
                    highlightToday: false,
                    displayEventTime: false,
                    locale: 'id', // Set locale Indonesia
                });

                calendar.render();
            });
        </script>
    @endpush
@endsection
