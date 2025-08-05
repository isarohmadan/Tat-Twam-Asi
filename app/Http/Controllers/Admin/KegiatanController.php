<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    // AdminKegiatanController.php
    public function index(Request $request)
    {
        // Mengambil data kegiatan berdasarkan kata kunci (jika ada)
        $katakunci = $request->get('katakunci');

        // Query untuk mengambil data berdasarkan kata kunci dengan pencarian di beberapa kolom
        $kegiatans = Kegiatan::with('user')
            ->when($katakunci, function ($query) use ($katakunci) {
                return $query->where('judul_kegiatan', 'like', '%' . $katakunci . '%')
                    ->orWhere('nama_instansi', 'like', '%' . $katakunci . '%')
                    ->orWhere('status_pengajuan', 'like', '%' . $katakunci . '%');
            })
            ->orderBy('created_at', 'desc')  // Urutkan berdasarkan tanggal terbaru
            ->paginate(10);  // Pagination 25 data per halaman

        $jumlahMenungguKegiatan = Kegiatan::where('status_pengajuan', 'menunggu')->count();

        return view('admin.kegiatan.kegiatan', compact('kegiatans', 'jumlahMenungguKegiatan'));
    }
}
