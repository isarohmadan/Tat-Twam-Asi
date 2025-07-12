<!DOCTYPE html>
<html>

<head>
    <title>Data Anak</title>
    <style>
        body {
            font-family: sans-serif;
        }

        h2 {
            text-align: center;
        }

        .foto {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            vertical-align: top;
        }
    </style>
</head>

<body>

    <h2>Detail Data Anak</h2>

    {{-- Foto Anak --}}
    <div class="foto">
        @if ($anak->foto)
            <img src="{{ public_path('storage/' . $anak->foto) }}" alt="Foto Anak" width="150">
        @else
            <img src="{{ public_path('images/default-pic.jpg') }}" alt="Foto Default" width="150">
        @endif
    </div>

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
            <th>Nama Orangtua</th>
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
    </table>

</body>

</html>
