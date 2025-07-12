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
            <h2>Pengajuan Anda Telah Disetujui!</h2>
        </div>

        <div class="email-content">
            <p>Halo <strong>{{ $user->name }}</strong>,</p>

            <p>Dengan ini kami informasikan bahwa pengajuan Anda telah <span class="highlight">disetujui</span>.</p>

            @if ($kegiatan)
                <p><strong>Kegiatan:</strong> {{ $kegiatan->judul_kegiatan }}</p>
            @elseif($kunjungan)
                <p><strong>Kunjungan:</strong> {{ $kunjungan->nama_kunjungan }}</p>
            @endif

            <p>Berikut adalah detail pengajuan Anda:</p>

            <table class="table">
                <tr>
                    <th>Judul</th>
                    <td>{{ $kegiatan ? $kegiatan->judul_kegiatan : $kunjungan->nama_kunjungan }}</td>
                </tr>
                <tr>
                    <th>Nama </th>
                    <td>{{ $kegiatan ? $kegiatan->nama_pengaju : $kunjungan->nama_kunjungan }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ $kegiatan ? $kegiatan->created_at->format('d-m-Y') : $kunjungan->created_at->format('d-m-Y') }}
                    </td>
                </tr>
                <tr>
                    <th>Status Pengajuan</th>
                    <td><span class="highlight">Disetujui</span></td>
                </tr>
            </table>

            @if ($catatan)
                <div class="note">
                    <strong>Catatan:</strong>
                    <p>{{ $catatan }}</p>
                </div>
            @endif

            <p>Pengajuan Anda telah kami periksa dan disetujui dengan pertimbangan yang matang. Harap simpan email ini
                sebagai bukti pengajuan yang telah disetujui.</p>

            <p>Terima kasih atas pengajuan Anda. Jika Anda membutuhkan informasi lebih lanjut, jangan ragu untuk
                menghubungi kami.</p>
        </div>

        <div class="email-footer">
            <p>Hormat kami,</p>
            <p><strong>Yayasan Tat Twam Asi</strong></p>
            <p>Alamat: Jalan Jaya Giri IX No.6 Denpasar-Bali</p>
            <p>Hp: 085 935 150 401</p>
        </div>
    </div>
</body>

</html>
