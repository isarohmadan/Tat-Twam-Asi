<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserKegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::where('user_id', Auth::id())->get();
        return view("user.kegiatan.userkegiatan", compact('kegiatans'));
    }

    public function create()
    {
        return view("user.kegiatan.tambahpengajuankegiatan");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'judul_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'nama_instansi' => 'required|string|max:255',
            'surat_pengajuan' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Upload file
        $filePath = $request->file('surat_pengajuan')->store('pengajuan_kegiatan', 'public');

        Kegiatan::create([
            'nama_pengaju' => $validated['nama_pengaju'],
            'alamat' => $validated['alamat'],
            'no_telepon' => $validated['no_telepon'],
            'judul_kegiatan' => $validated['judul_kegiatan'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'nama_instansi' => $validated['nama_instansi'],
            'surat_pengajuan' => $filePath,
            'status_pengajuan' => 'menunggu', // Default status
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('user.userkegiatan')
            ->with('success', 'Pengajuan kegiatan berhasil dikirim!');
    }
}
