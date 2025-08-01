<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{ route('ketua_yayasan.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Keseluruhan Data
            </a>
            <div class="sb-sidenav-menu-heading">Data</div>
            <a class="nav-link" href="{{ route('ketua_yayasan.anak.dataanak') }}">
                <div class="sb-nav-link-icon"><i class="fa fa-child"></i></div>
                Data Anak
            </a>
            <div class="sb-sidenav-menu-heading">Pengajuan</div>
            <a class="nav-link" href="{{ route('ketua_yayasan.kegiatan.index') }}">
                <div class="sb-nav-link-icon"><i class="fa fa-tasks"></i></div>
                Kegiatan
            </a>
            <a class="nav-link" href="{{ route('ketua_yayasan.kunjungan.index') }}">
                <div class="sb-nav-link-icon"><i class="fa fa-tasks"></i></div>
                Kunjungan
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        @if (Auth::check())
            @php
                $role = Auth::user()->role;
            @endphp

            @if ($role == 'admin')
                Admin Yayasan
            @elseif ($role == 'ketua_yayasan')
                Ketua Yayasan
            @else
                Pengguna
            @endif
        @else
            Guest
        @endif
    </div>
</nav>
