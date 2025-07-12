<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Kegiatan Baru</title>
</head>

<body>
    <h1>Pengajuan Kegiatan Baru Diterima</h1>
    <p>Pengajuan kegiatan baru telah diterima dari pengguna:</p>
    <ul>
        <li><strong>Nama Pengaju:</strong> {{ $kegiatan->nama_pengaju }}</li>
        <li><strong>Judul Kegiatan:</strong> {{ $kegiatan->judul_kegiatan }}</li>
        <li><strong>Tanggal Pengajuan:</strong> {{ $kegiatan->created_at }}</li>
    </ul>
</body>

</html>
