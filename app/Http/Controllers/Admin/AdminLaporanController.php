<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    public function index()
    {
        // Ambil data dari tabel kegiatan dan kunjungan
        $kegiatan = Kegiatan::all();
        $kunjungan = Kunjungan::all();

        return view('admin.laporan.index', compact('kegiatan', 'kunjungan'));
    }
}
