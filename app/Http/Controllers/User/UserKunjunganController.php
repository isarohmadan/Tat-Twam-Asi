<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('user.kunjungan.tambahpengajuankunjungan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengaju' => 'required|string|max:255', // Diubah dari 'nama'
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'judul_kegiatan' => 'required|string|max:255', // Diubah dari 'tujuan_kunjungan'
            'tanggal_kegiatan' => 'required|date',
            'instansi' => 'required|string|max:255',
        ]);

        Kunjungan::create([
            'nama_pengaju' => $request->nama_pengaju, // Diubah dari $request->nama
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'tujuan_kunjungan' => $request->judul_kegiatan, // Diubah dari $request->judul_kegiatan
            'tanggal_kunjungan' => $request->tanggal_kegiatan,
            'instansi' => $request->instansi,
            'status' => 'menunggu',
            'user_id' => Auth::id(),
            'tanggal_pengajuan' => now(), // Tambahkan ini untuk mengisi tanggal pengajuan
        ]);

        return redirect()->route('user.userkunjungan')->with('success', 'Pengajuan kunjungan berhasil dikirim');
    }
}
