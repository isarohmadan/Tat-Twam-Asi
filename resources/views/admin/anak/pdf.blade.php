<!DOCTYPE html>
<html>
<head>
    <title>Data Anak - Yayasan Tat Twam Asi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            border-bottom: 2px solid #333;
            margin-bottom: 20px;
            padding-bottom: 15px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
            padding: 5px 0;
        }

        .logo-cell {
            width: 80px;
            text-align: center;
        }

        .logo {
            width: 60px;
            height: 60px;
            border: 2px solid #333;
            background-color: #f0f0f0;
            text-align: center;
            line-height: 56px;
            font-weight: bold;
            font-size: 14px;
        }

        .org-info {
            padding-left: 15px;
        }

        .org-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .org-desc {
            font-size: 11px;
            color: #666;
        }

        .doc-info {
            text-align: right;
            width: 150px;
        }

        .doc-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .doc-date {
            font-size: 10px;
            color: #666;
        }

        /* Main Content */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .main-table td {
            vertical-align: top;
            padding: 10px 0;
        }

        .photo-cell {
            width: 130px;
            padding-right: 20px;
        }

        .photo-box {
            width: 120px;
            height: 150px;
            text-align: center;
        }

        .photo-box img {
            width: 118px;
            height: 148px;
            object-fit: cover;
        }

        /* Data Section */
        .data-section {
            width: 100%;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ccc;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        .data-table tr {
            border-bottom: 1px solid #eee;
        }

        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .data-table td {
            padding: 8px 10px;
            border-right: 1px solid #eee;
        }

        .data-label {
            width: 120px;
            font-weight: bold;
            background-color: #f0f0f0;
            font-size: 11px;
        }

        .data-value {
            font-size: 12px;
        }

        .nik-value {
            font-family: "Courier New", monospace;
            background-color: #e6f3ff;
            padding: 2px 5px;
            font-size: 11px;
            font-weight: bold;
        }

        .date-value {
            font-family: "Courier New", monospace;
            color: #006600;
            font-weight: bold;
        }

        /* Stats */
        .stats-section {
            margin: 15px 0;
        }

        .stats-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #333;
        }

        .stats-table td {
            width: 33.33%;
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            border-right: 1px solid white;
            font-weight: bold;
        }

        .stats-table td:last-child {
            border-right: none;
        }

        .stat-number {
            font-size: 16px;
            display: block;
            margin-bottom: 3px;
        }

        .stat-label {
            font-size: 9px;
        }

        /* Notes */
        .notes-section {
            margin: 15px 0;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            padding: 10px;
        }

        .notes-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .notes-content {
            font-size: 11px;
            line-height: 1.5;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-table td {
            font-size: 10px;
            color: #666;
            padding: 2px 0;
        }

        .footer-right {
            text-align: right;
        }

        /* Page break */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <table class="header-table">
                <tr>
                    <td class="logo-cell">
                    @php
                        $logoPath = public_path('images/logo.png');
                        $logoData = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : null;
                    @endphp

                    @if($logoData)
                        <img src="{{ $logoData }}" alt="Logo" style="width: 60px; height: 60px;">
                    @else
                        <div style="width: 60px; height: 60px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; font-size: 10px;">
                            LOGO
                        </div>
                    @endif
                    </td>
                    <td class="org-info">
                        <div class="org-name">Yayasan Tat Twam Asi</div>
                        <div class="org-desc">Lembaga Sosial & Pendidikan</div>
                    </td>
                    <td class="doc-info">
                        <div class="doc-title">PROFIL ANAK ASUH</div>
                        <div class="doc-date">{{ now()->format('d F Y') }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Main Content -->
        <table class="main-table">
            <tr>
                <td class="photo-cell">
                    <div class="photo-box">
                    @if(isset($anak->foto) && $anak->foto)
    <?php $imagePath = 'storage/' . $anak->foto; ?>
    @if(file_exists(public_path($imagePath)))
        <img src="{{ $imagePath }}" alt="Foto" style="width: 100%; height: 100%; object-fit: cover;">
    @else
        <div style="width: 100%; height: 100%; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
            <span>Foto tidak ditemukan</span>
        </div>
    @endif
@else
    <div style="width: 100%; height: 100%; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
        <span>Foto tidak tersedia</span>
    </div>
@endif
                    </div>
                </td>
                <td class="data-section">
                    <div class="section-title">INFORMASI PRIBADI</div>
                    
                    <table class="data-table">
                        <tr>
                            <td class="data-label">NIK</td>
                            <td class="data-value">
                                <span class="nik-value">{{ $anak->nik }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="data-label">Nama Lengkap</td>
                            <td class="data-value">{{ $anak->nama }}</td>
                        </tr>
                        <tr>
                            <td class="data-label">Nama Orangtua</td>
                            <td class="data-value">{{ $anak->nama_orangtua }}</td>
                        </tr>
                        <tr>
                            <td class="data-label">Jenis Kelamin</td>
                            <td class="data-value">{{ $anak->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td class="data-label">Tanggal Lahir</td>
                            <td class="data-value">
                                <span class="date-value">
                                    {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="data-label">Usia</td>
                            <td class="data-value">
                                {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->age }} tahun
                            </td>
                        </tr>
                        <tr>
                            <td class="data-label">Asal Daerah</td>
                            <td class="data-value">{{ $anak->asal }}</td>
                        </tr>
                        <tr>
                            <td class="data-label">Sekolah</td>
                            <td class="data-value">{{ $anak->sekolah }}</td>
                        </tr>
                        <tr>
                            <td class="data-label">Keterangan</td>
                            <td class="data-value">{{ $anak->keterangan }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="stats-section">
            <table class="stats-table">
                <tr>
                    <td>
                        <span class="stat-number">
                            {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->age }}
                        </span>
                <span class="stat-label">USIA (TAHUN)</span>
            </td>
            <td>
                <span class="stat-number">
                    {{ \Carbon\Carbon::parse($anak->tanggal_masuk_panti)->format('d-m-Y') }}
                </span>
                <span class="stat-label">TANGGAL MASUK</span>
            </td>
            <td>
                <span class="stat-number">
                {{ $anak->keterangan }}
                </span>
                <span class="stat-label">STATUS</span>
            </td>
        </tr>
    </table>
</div>

        <!-- Footer -->
        <div class="footer">
            <table class="footer-table">
                <tr>
                    <td>© 2025 Yayasan Tat Twam Asi</td>
                    <td class="footer-right">Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>