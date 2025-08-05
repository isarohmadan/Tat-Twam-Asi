<?php

namespace App\Http\Controllers\KetuaYayasan;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Biodata;

class KetuaYayasanController extends Controller
{
    public function index()
    {

        $data = DB::table('biodata')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"), DB::raw('COUNT(*) as jumlah'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('bulan', 'asc')
            ->get();

        $totalBiodata = 0;
        $data->map(function ($item) use (&$totalBiodata) {
            $totalBiodata += $item->jumlah;  // Menambahkan jumlah biodata per bulan
            $item->total = $totalBiodata;    // Menyimpan total kumulatif
            return $item;
        });
        
        $jumlahMenunggu = \App\Models\Kunjungan::where('status', 'menunggu')->count();
        $kunjungans = \App\Models\Kunjungan::all(); // atau sesuai kebutuhanmu
        $jumlahMenungguKegiatan = \App\Models\Kegiatan::where('status_pengajuan', 'menunggu')->count();
        $kegiatans = \App\Models\Kegiatan::all(); // atau sesuai kebutuhanmu
        $jumlahAnak = \App\Models\Biodata::count(); // Misal model Anak
        return view('ketua_yayasan.dashboard', compact('data', 'jumlahMenunggu', 'kunjungans', 'kegiatans', 'jumlahAnak', 'jumlahMenungguKegiatan'));
    }
}
