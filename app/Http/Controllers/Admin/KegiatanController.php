<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {

        $kegiatans = Kegiatan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        $jumlahMenungguKegiatan = Kegiatan::where('status_pengajuan', 'menunggu')->count();
        return view('admin.kegiatan.kegiatan', compact('kegiatans', 'jumlahMenungguKegiatan')); // Pastikan path view benar
    }

}
