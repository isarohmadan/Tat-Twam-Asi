<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\PengajuanBaruNotification;
use Illuminate\Support\Facades\Mail;

class UserKegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::where('user_id', Auth::id())->get();
        return view("user.kegiatan.userkegiatan", compact('kegiatans'));
    }

    public function create()
    {
        // Ambil rentang tanggal yang sudah disetujui (status = "disetujui") untuk kegiatan
        $unavailableDates = Kegiatan::where('status_pengajuan', 'disetujui')
            ->get(['tanggal_mulai', 'tanggal_selesai']);

        // Mengubah rentang tanggal menjadi array dengan format yang dapat digunakan untuk flatpickr
        $unavailableRanges = [];
        foreach ($unavailableDates as $kegiatan) {
            $start = $kegiatan->tanggal_mulai;
            $end = $kegiatan->tanggal_selesai;

            // Menambahkan rentang tanggal ke dalam array unavailableRanges
            $unavailableRanges[] = [
                'from' => $start,
                'to' => $end
            ];
        }

        return view('user.kegiatan.tambahpengajuankegiatan', compact('unavailableRanges'));
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

        // Cek apakah sudah ada kegiatan pada tanggal yang dipilih
        $existingKegiatan = Kegiatan::where('tanggal_mulai', $request->tanggal_mulai)
            ->orWhere('tanggal_selesai', $request->tanggal_selesai)
            ->exists();

        if ($existingKegiatan) {
            return redirect()->back()->with('error', 'Sudah ada pengajuan pada tanggal ini. Silakan pilih tanggal lain.');
        }

        // Upload file
        $filePath = $request->file('surat_pengajuan')->store('pengajuan_kegiatan', 'public');

        $kegiatan = Kegiatan::create([
            'nama_pengaju' => $validated['nama_pengaju'],
            'alamat' => $validated['alamat'],
            'no_telepon' => $validated['no_telepon'],
            'judul_kegiatan' => $validated['judul_kegiatan'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'nama_instansi' => $validated['nama_instansi'],
            'surat_pengajuan' => $filePath,
            'status_pengajuan' => 'menunggu',
            'user_id' => Auth::id(),
        ]);

        $adminEmail = 'tegarprawira350@gmail.com';
        Mail::to($adminEmail)->send(new PengajuanBaruNotification($kegiatan, 'kegiatan'));

        return redirect()->route('user.userkegiatan')
            ->with('success', 'Pengajuan kegiatan berhasil dikirim!');
    }
}
