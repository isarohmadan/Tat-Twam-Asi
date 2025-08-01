<?php

namespace App\Http\Controllers\KetuaYayasan;

use App\Models\Kegiatan;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index()
    {
        // Ambil data kegiatan dan kunjungan yang sudah disetujui
        $kegiatans = Kegiatan::where('status_pengajuan', 'disetujui')->get();
        $kunjungans = Kunjungan::where('status', 'disetujui')->get();

        // Format data agar sesuai dengan FullCalendar
        $events = [];

        // Menambahkan data kegiatan ke events
        foreach ($kegiatans as $kegiatan) {
            // Pastikan event ditampilkan jika kegiatan lebih dari satu hari
            $events[] = [
                'title' => $kegiatan->judul_kegiatan,
                'start' => $kegiatan->tanggal_mulai = Carbon::parse($kegiatan->tanggal_mulai),
                'end' => $kegiatan->tanggal_selesai = Carbon::parse($kegiatan->tanggal_selesai),
                'backgroundColor' => '#28a745', // Warna untuk kegiatan
                'textColor' => '#fff',

            ];
        }

        // Menambahkan data kunjungan ke events
        foreach ($kunjungans as $kunjungan) {
            // Pastikan event ditampilkan jika kunjungan lebih dari satu hari
            $events[] = [
                'title' => $kunjungan->tujuan_kunjungan,
                'start' => $kunjungan->tanggal_kunjungan,
                'backgroundColor' => '#007bff', // Warna untuk kunjungan
                'textColor' => '#fff',
                'allDay' => true, // Menandakan event adalah sepanjang hari
            ];
        }

        // Kirim data ke view
        return view('ketua_yayasan.jadwal.index', compact('events'));
    }
}
