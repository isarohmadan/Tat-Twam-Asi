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
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();
        $jumlahMenunggu = \App\Models\Kunjungan::where('status', 'menunggu')->count();
        $kunjungans = \App\Models\Kunjungan::all(); // atau sesuai kebutuhanmu
        $jumlahMenungguKegiatan = \App\Models\Kegiatan::where('status_pengajuan', 'menunggu')->count();
        $kegiatans = \App\Models\Kegiatan::all(); // atau sesuai kebutuhanmu
        return view('ketua_yayasan.dashboard', compact('data', 'jumlahMenunggu', 'kunjungans', 'kegiatans', 'jumlahMenungguKegiatan'));
    }
}
