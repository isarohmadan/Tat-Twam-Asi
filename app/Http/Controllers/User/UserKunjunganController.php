<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\PengajuanBaruNotification;
use Illuminate\Support\Facades\Mail;

class UserKunjunganController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.kunjungan.userkunjungan', compact('kunjungans'));
    }

    public function create()
    {
        // Ambil rentang tanggal yang sudah disetujui (status = "disetujui") untuk kunjungan
        $unavailableDates = Kunjungan::where('status', 'disetujui')
            ->get(['tanggal_kunjungan', 'tanggal_kunjungan']); // Menggunakan tanggal yang sama

        // Mengubah rentang tanggal menjadi array dengan format yang dapat digunakan untuk flatpickr
        $unavailableRanges = [];
        foreach ($unavailableDates as $kunjungan) {
            $start = $kunjungan->tanggal_kunjungan;
            $end = $kunjungan->tanggal_kunjungan; // Bisa disesuaikan jika ada rentang tanggal lebih dari 1 hari

            // Menambahkan rentang tanggal ke dalam array unavailableRanges
            $unavailableRanges[] = [
                'from' => $start,
                'to' => $end
            ];
        }

        return view('user.kunjungan.tambahpengajuankunjungan', compact('unavailableRanges'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'judul_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'instansi' => 'required|string|max:255',
        ]);

        // Cek apakah sudah ada kunjungan pada tanggal yang dipilih
        $existingKunjungan = Kunjungan::where('tanggal_kunjungan', $request->tanggal_kegiatan)->exists();

        if ($existingKunjungan) {
            return redirect()->back()->with('error', 'Sudah ada pengajuan kunjungan pada tanggal ini. Silakan pilih tanggal lain.');
        }

        $kunjungan = Kunjungan::create([
            'nama_pengaju' => $request->nama_pengaju,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'tujuan_kunjungan' => $request->judul_kegiatan,
            'tanggal_kunjungan' => $request->tanggal_kegiatan,
            'instansi' => $request->instansi,
            'status' => 'menunggu',
            'user_id' => Auth::id(),
            'tanggal_pengajuan' => now(),
        ]);

        $adminEmail = 'yayasantattwamasi@gmail.com';
        Mail::to($adminEmail)->send(new PengajuanBaruNotification($kunjungan, 'kunjungan'));

        return redirect()->route('user.userkunjungan')->with('success', 'Pengajuan kunjungan berhasil dikirim');
    }

    public function batalkan(Request $request, $id)
    {
        $request->validate([
            'alasan_pembatalan' => 'required|string|max:255'
        ]);

        $kunjungan = Kunjungan::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'disetujui')
            ->firstOrFail();

        $kunjungan->update([
            'status_pembatalan' => 'menunggu',
            'alasan_pembatalan' => $request->alasan_pembatalan
        ]);

        return back()->with('success', 'Permintaan pembatalan telah diajukan dan menunggu persetujuan.');
    }
}
