<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\KegiatanPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\PengajuanBaruNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
        $unavailableDates = Kegiatan::whereIn('status_pengajuan', ['disetujui', 'terlaksana'])
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

        // Cek jika status kegiatan adalah "terlaksana", maka jangan izinkan pemilihan tanggal
        $statusKegiatan = Kegiatan::where('user_id', Auth::id())->first();
        $isKegiatanTerlaksana = $statusKegiatan && $statusKegiatan->status_pengajuan == 'terlaksana';

        return view('user.kegiatan.tambahpengajuankegiatan', compact('unavailableRanges', 'isKegiatanTerlaksana'));
    }

    public function store(Request $request)
    {
        // Cek apakah status kegiatan sudah terlaksana
        $statusKegiatan = Kegiatan::where('user_id', Auth::id())->first();
        if ($statusKegiatan && $statusKegiatan->status_pengajuan == 'terlaksana') {
            return back()->with('error', 'Tidak bisa membuat kegiatan baru karena status kegiatan sebelumnya sudah terlaksana.');
        }

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
        $existingKegiatan = Kegiatan::where(function ($query) use ($request) {
                $query->where('tanggal_mulai', $request->tanggal_mulai)
                      ->orWhere('tanggal_selesai', $request->tanggal_selesai);
            })
            ->where('status_pengajuan', 'Disetujui') // Cek status 'Disetujui'
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

        $adminEmail = 'yayasantattwamasibali@gmail.com';

        Mail::to($adminEmail)->send(new PengajuanBaruNotification($kegiatan, 'kegiatan'));

        return redirect()->route('user.userkegiatan')
            ->with('success', 'Pengajuan kegiatan berhasil dikirim!');
    }


    public function batalkan(Request $request, $id)
    {
        $request->validate([
            'alasan_pembatalan' => 'required|string|max:255'
        ]);

        $kegiatan = Kegiatan::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status_pengajuan', 'disetujui')
            ->firstOrFail();

        $kegiatan->update([
            'status_pembatalan' => 'menunggu',
            'alasan_pembatalan' => $request->alasan_pembatalan
        ]);

        // (Opsional) Email ke ketua yayasan
        // Mail::to('tegarprawira350@gmail.com')->send(new PermintaanPembatalanKegiatan($kegiatan));

        return back()->with('success', 'Permintaan pembatalan telah diajukan dan menunggu persetujuan.');
    }

    public function submitPhoto(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Pastikan status kegiatan adalah 'terlaksana'
        if ($kegiatan->status_pengajuan !== 'terlaksana') {
            return back()->with('error', 'Foto hanya bisa dikirim jika status kegiatan telah terlaksana.');
        }

        // Validasi input foto
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Maksimal 2MB per foto
        ]);

        // Ambil foto yang diupload oleh user
        $photos = $request->file('photos');
        $photoPaths = [];

        foreach ($photos as $photo) {
            // Simpan foto dan ambil path-nya
            $photoPath = $photo->store('photos', 'public'); // Penyimpanan ke folder 'photos' di storage/app/public

            // Menyimpan data foto ke dalam tabel kegiatan_photos
            KegiatanPhoto::create([
                'kegiatan_id' => $kegiatan->id, // Menyimpan ID kegiatan
                'judul' => $request->judul, // Menyimpan judul foto
                'deskripsi' => $request->deskripsi, // Menyimpan deskripsi foto
                'photo_path' => $photoPath, // Menyimpan path foto
            ]);

            // Logging foto berhasil disimpan
            Log::debug('Foto berhasil disimpan untuk kegiatan ID: ' . $kegiatan->id, [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'photo_path' => $photoPath
            ]);
        }

        return back()->with('success', 'Foto kegiatan telah berhasil dikirim.');
    }



    public function showPhotos($kegiatanId)
    {
        // Mendapatkan kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($kegiatanId);

        // Pastikan kegiatan memiliki status 'terlaksana' sebelum mengizinkan melihat foto
        if ($kegiatan->status_pengajuan !== 'terlaksana') {
            return back()->with('error', 'Foto hanya bisa dilihat jika status kegiatan telah terlaksana.');
        }

        // Ambil semua foto yang terkait dengan kegiatan ini
        $photos = KegiatanPhoto::where('kegiatan_id', $kegiatanId)->get();

        return view('user.kegiatan.showPhotos', compact('kegiatan', 'photos'));
    }
}
