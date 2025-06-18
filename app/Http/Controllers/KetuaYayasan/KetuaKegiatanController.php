<?php

namespace App\Http\Controllers\KetuaYayasan;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KetuaKegiatanController extends Controller
{
    public function index()
    {

        $kegiatans = Kegiatan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        $jumlahMenungguKegiatan = Kegiatan::where('status_pengajuan', 'menunggu')->count();
        return view('ketua_yayasan.kegiatan.kegiatan', compact('kegiatans', 'jumlahMenungguKegiatan')); // Pastikan path view benar
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:255'
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update([
            'status_pengajuan' => 'disetujui',
            'catatan' => $request->catatan,
            'alasan_penolakan' => null // Reset alasan penolakan jika ada
        ]);

        return redirect()->back()->with('success', 'Pengajuan kegiatan telah disetujui');
    }


    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:255'
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update([
            'status_pengajuan' => 'ditolak',
            'alasan_penolakan' => $request->alasan_penolakan,
            'catatan' => null // Reset catatan jika ada
        ]);

        return redirect()->back()->with('success', 'Pengajuan kegiatan telah ditolak');
    }
}
