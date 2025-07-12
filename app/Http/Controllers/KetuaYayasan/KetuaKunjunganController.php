<?php

namespace App\Http\Controllers\KetuaYayasan;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Mail\PengajuanDisetujui;
use Illuminate\Support\Facades\Mail;

class KetuaKunjunganController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $jumlahMenunggu = Kunjungan::where('status', 'menunggu')->count();

        return view('ketua_yayasan.kunjungan.kunjungan', compact('kunjungans', 'jumlahMenunggu'));
    }


    public function approve(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:255'
        ]);

        $kunjungan = Kunjungan::findOrFail($id);
        $user = $kunjungan->user; // Mendapatkan pengguna yang mengajukan kunjungan

        $kunjungan->update([
            'status' => 'disetujui',
            'catatan' => $request->catatan,
            'alasan_penolakan' => null
        ]);

        // Kirim email pemberitahuan kepada pengguna
        Mail::to($user->email)->send(new PengajuanDisetujui($user, null, $kunjungan, $request->catatan));

        return redirect()->back()->with('success', 'Pengajuan kunjungan telah disetujui');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:255'
        ]);

        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $request->alasan_penolakan,
            'catatan' => null
        ]);

        return redirect()->back()->with('success', 'Pengajuan kunjungan telah ditolak');
    }
}
