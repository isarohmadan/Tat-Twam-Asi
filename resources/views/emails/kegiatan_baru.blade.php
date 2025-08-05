

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Disetujui</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            width: 100%;
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .email-header {
            text-align: center;
            background-color: #4CAF50;
            padding: 20px;
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .email-content {
            padding: 20px;
        }

        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .highlight {
            color: #4CAF50;
            font-weight: bold;
        }

        .note {
            background-color: #f9f9f9;
            padding: 10px;
            border-left: 5px solid #4CAF50;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h2>Pengajuan Kegiatan baru diterima!</h2>
        </div>

        <div class="email-content">
            <p>Nama <strong>{{ $kegiatan->nama_pengaju }}</strong>,</p>

            <p>Dengan ini {{ $kegiatan->nama_pengaju }} ingin mengajukan kunjunagan {{ $kegiatan->judul_kegiatan }}</p>

            <p>Detail Pengajuan : </p>

            <table class="table">
                <tr>
                    <th>Nama </th>
                    <td>{{ $kegiatan->nama_pengaju }}</td>
                </tr>
                <tr>
                    <th>Alamat </th>
                    <td>{{ $kegiatan->alamat }}</td>
                </tr>
                <tr>
                    <th>No Telepon </th>
                    <td>{{ $kegiatan->no_telepon}}</td>
                </tr>
                <tr>
                    <th>Tanggal Mulai</th>
                    <td>{{ $kegiatan->tanggal_mulai }}
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Selesai</th>
                    <td>{{ $kegiatan->tanggal_selesai }}
                    </td>
                </tr>
                <tr>
                    <th>Instansi</th>
                    <td><span class="highlight">{{ $kegiatan->nama_instansi }}</span></td>
                </tr>
            </table>

            <p>Terima kasih atas perhatian Anda. Jika harap berikan di website tat twam asi</p>
        </div>
    </div>
</body>

</html>
