<!DOCTYPE html>
<html>

<head>
    <title>Data Anak</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 20px;
    }

    h2 {
        text-align: left;
        color: #333;
        margin-bottom: 20px;
    }

    /* Styling untuk Logo dan Nama Yayasan */
    .logo-container {
        display: flex;
        justify-content: flex-start;
        /* Menjaga mereka sejajar di kiri */
        align-items: flex-start;
        /* Menyelaraskan teks sedikit lebih tinggi */
        margin-bottom: 20px;
    }

    .logo {
        width: 280px;
        /* Ukuran logo kecil */
        margin-right: 10px;
    }


    /* Foto Anak */
    .foto {
        text-align: left;
        margin-bottom: 20px;
        width: 150px;
        /* Ukuran foto */
        float: left;
        margin-right: 20px;
    }

    .foto img {
        width: 150px;
        height: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 155px;
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
        vertical-align: top;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
    }

    td {
        background-color: #fafafa;
    }

    .footer {
        margin-top: 20px;
        text-align: center;
        font-size: 14px;
        color: #888;
    }
    </style>
</head>

<body>

    <!-- Logo dan Nama Yayasan -->
    <div class="logo-container">
        <img src="{{ public_path('images/logo.jpg') }}" alt="Logo Yayasan" class="logo">
    </div>

    <!-- Foto Anak -->
    <div class="foto">
        @if ($anak->foto)
        <img src="{{ public_path('storage/' . $anak->foto) }}" alt="Foto Anak">
        @else
        <img src="{{ public_path('images/default-pic.jpg') }}" alt="Foto Default">
        @endif
    </div>

    <h2>Detail Data Anak</h2>

    <table>
        <tr>
            <th>NIK</th>
            <td>{{ $anak->nik }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $anak->nama }}</td>
        </tr>
        <tr>
            <th>Orangtua</th>
            <td>{{ $anak->nama_orangtua }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Asal</th>
            <td>{{ $anak->asal }}</td>
        </tr>
        <tr>
            <th>Sekolah</th>
            <td>{{ $anak->sekolah }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $anak->jenis_kelamin }}</td>
        </tr>
        <tr>
            <th>Tanggal Masuk Panti</th>
            <td>{{ \Carbon\Carbon::parse($anak->tanggal_masuk_panti)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $anak->keterangan }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Printed by Yayasan Yayasan Tat Twam Asi - All Rights Reserved</p>
    </div>

</body>

</html>