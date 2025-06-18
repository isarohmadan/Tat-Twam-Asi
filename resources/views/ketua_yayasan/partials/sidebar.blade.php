<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{ route('ketua_yayasan.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Keseluruhan Data
            </a>
            <div class="sb-sidenav-menu-heading">Data</div>
            <a class="nav-link" href="dataanak">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Data Anak
            </a>
            <div class="sb-sidenav-menu-heading">Pengajuan</div>
            <a class="nav-link" href="{{ route('ketua_yayasan.kegiatan.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Kegiatan
            </a>
            <a class="nav-link" href="kunjungan">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Kunjungan
            </a>
            <div class="sb-sidenav-menu-heading">Konten</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Beranda
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('ketua_yayasan.beritas.index') }}">Tambah Berita</a>
                    <a class="nav-link" href="{{ route('ketua_yayasan.banners.index') }}">Tambah Benner</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Start Bootstrap
    </div>
</nav>
