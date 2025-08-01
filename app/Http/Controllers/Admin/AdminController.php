<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Biodata;

class AdminController extends Controller
{
    public function index()
    {
        $data = DB::table('biodata')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"), DB::raw('COUNT(*) as jumlah'))
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        $jumlahMenunggu = \App\Models\Kunjungan::where('status', 'menunggu')->count();
        $kunjungans = \App\Models\Kunjungan::all();
        $jumlahMenungguKegiatan = \App\Models\Kegiatan::where('status_pengajuan', 'menunggu')->count();
        $kegiatans = \App\Models\Kegiatan::all();

        // Menambahkan data untuk menu baru
        $jumlahAnak = \App\Models\Biodata::count(); // Misal model Anak
        $jumlahBanner = \App\Models\Banner::count(); // Misal model Banner
        $jumlahBerita = \App\Models\Berita::count(); // Misal model Berita

        return view('admin.dashboard', compact('data', 'jumlahMenunggu', 'kunjungans', 'kegiatans', 'jumlahMenungguKegiatan', 'jumlahAnak', 'jumlahBanner', 'jumlahBerita'));
    }
}
