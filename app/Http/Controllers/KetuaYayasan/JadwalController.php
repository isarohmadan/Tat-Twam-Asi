<?php

namespace App\Http\Controllers\KetuaYayasan;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        // Mengambil data tanggal yang sudah terblokir (disetujui) untuk kegiatan dan kunjungan
        $approvedKegiatan = Kegiatan::where('status_pengajuan', 'disetujui')
            ->get(['tanggal_mulai', 'tanggal_selesai']);
        $approvedKunjungan = Kunjungan::where('status', 'disetujui')
            ->get(['tanggal_kunjungan']);

        // Gabungkan tanggal yang sudah terblokir
        $unavailableRanges = [];

        foreach ($approvedKegiatan as $kegiatan) {
            $unavailableRanges[] = [
                'from' => \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('Y-m-d'),
                'to' => \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('Y-m-d')
            ];
        }

        foreach ($approvedKunjungan as $kunjungan) {
            $unavailableRanges[] = [
                'from' => \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('Y-m-d'),
                'to' => \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('Y-m-d')
            ];
        }

        return view('ketua_yayasan.jadwal.index', compact('unavailableRanges'));
    }
}
