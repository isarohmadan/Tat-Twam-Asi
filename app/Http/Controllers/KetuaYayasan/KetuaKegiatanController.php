<?php

namespace App\Http\Controllers\KetuaYayasan;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\PengajuanDisetujui;
use Illuminate\Support\Facades\Mail;

class KetuaKegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $jumlahMenungguKegiatan = Kegiatan::where('status_pengajuan', 'menunggu')->count();
        $jumlahMenungguPembatalan = Kegiatan::where('status_pembatalan', 'menunggu')->count();  // Menampilkan jumlah permintaan pembatalan yang menunggu

        return view('ketua_yayasan.kegiatan.kegiatan', compact('kegiatans', 'jumlahMenungguKegiatan', 'jumlahMenungguPembatalan'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:255'
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $user = $kegiatan->user; // Mendapatkan pengguna yang mengajukan kegiatan

        $kegiatan->update([
            'status_pengajuan' => 'disetujui',
            'catatan' => $request->catatan,
            'alasan_penolakan' => null // Reset alasan penolakan jika ada
        ]);

        // Kirim email pemberitahuan kepada pengguna
        try {
            Mail::to($user->email)->send(new PengajuanDisetujui($user, $kegiatan, null, $request->catatan));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }

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

    public function setujuiPembatalan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->status_pembatalan !== 'menunggu') {
            return back()->with('error', 'Permintaan pembatalan sudah diproses sebelumnya.');
        }

        $kegiatan->update([
            'status_pembatalan' => 'disetujui',
            'status_pengajuan' => 'dibatalkan', // langsung update status utama jadi dibatalkan
            'catatan' => null
        ]);

        return back()->with('success', 'Permintaan pembatalan telah disetujui dan status kegiatan diubah menjadi dibatalkan.');
    }



    public function tolakPembatalan(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:255'
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->status_pembatalan !== 'menunggu') {
            return back()->with('error', 'Permintaan pembatalan sudah diproses.');
        }

        $kegiatan->update([
            'status_pembatalan' => 'ditolak',
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Permintaan pembatalan telah ditolak.');
    }

    public function markAsCompleted(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Pastikan status pengajuan sudah 'disetujui' sebelum bisa diubah ke 'terlaksana'
        if ($kegiatan->status_pengajuan !== 'disetujui') {
            return back()->with('error', 'Kegiatan harus disetujui sebelum dapat ditandai sebagai terlaksana.');
        }

        // Update status menjadi 'terlaksana'
        $kegiatan->update([
            'status_pengajuan' => 'terlaksana',
        ]);

        return back()->with('success', 'Kegiatan telah ditandai sebagai terlaksana.');
    }
}
