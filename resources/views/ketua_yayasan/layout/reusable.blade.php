<!DOCTYPE html>
<html lang="en">

<head>
    @include('ketua_yayasan.partials.header')

    @section('css')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @endsection

    @section('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection


    <!-- Menyertakan CSS secara langsung -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('css') <!-- Memastikan bagian css tambahan bisa ditambahkan di masing-masing view -->
</head>

<body class="sb-nav-fixed">
    @include('ketua_yayasan.partials.navbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('ketua_yayasan.partials.sidebar')
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @yield('content') <!-- Konten utama dari masing-masing view -->
                </div>
            </main>

            @include('ketua_yayasan.partials.footer')
        </div>
    </div>

    <!-- Menyertakan JS secara langsung -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Add FullCalendar CDN link here -->
    @stack('scripts') <!-- This is where FullCalendar's CDN link will be included -->
</body>

</html>