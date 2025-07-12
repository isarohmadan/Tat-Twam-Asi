<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Kunjungan Baru</title>
</head>

<body>
    <h1>Pengajuan Kunjungan Baru Diterima</h1>
    <p>Pengajuan kunjungan baru telah diterima dari pengguna:</p>
    <ul>
        <li><strong>Nama Pengaju:</strong> {{ $kunjungan->nama_pengaju }}</li>
        <li><strong>Tujuan Kunjungan:</strong> {{ $kunjungan->tujuan_kunjungan }}</li>
        <li><strong>Tanggal Pengajuan:</strong> {{ $kunjungan->tanggal_pengajuan }}</li>
        <li><strong>Tanggal Kunjungan:</strong> {{ $kunjungan->tanggal_kunjungan }}</li>
        <li><strong>Instansi:</strong> {{ $kunjungan->instansi }}</li>
    </ul>
</body>

</html>
