<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    // AdminKunjunganController.php
    public function index(Request $request)
    {
        $katakunci = $request->get('katakunci');

        // Query untuk mengambil data berdasarkan kata kunci dengan pencarian di beberapa kolom
        $kunjungans = Kunjungan::with('user')
            ->when($katakunci, function ($query) use ($katakunci) {
                return $query->where('nama_pengaju', 'like', '%' . $katakunci . '%')
                    ->orWhere('tujuan_kunjungan', 'like', '%' . $katakunci . '%')
                    ->orWhere('instansi', 'like', '%' . $katakunci . '%')
                    ->orWhere('status', 'like', '%' . $katakunci . '%');
            })
            ->orderBy('created_at', 'desc')  // Urutkan berdasarkan tanggal terbaru
            ->paginate(25);

        $jumlahMenunggu = Kunjungan::where('status', 'menunggu')->count();

        return view('admin.kunjungan.kunjungan', compact('kunjungans', 'jumlahMenunggu'));
    }
}
