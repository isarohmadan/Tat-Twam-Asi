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
                    @yield('content')
                    <!-- JS Bootstrap -->
                    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
                    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                    @stack('js')
                </div>
            </main>

            @include('ketua_yayasan.partials.footer')
        </div>
    </div>

</body>

</html>

<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
