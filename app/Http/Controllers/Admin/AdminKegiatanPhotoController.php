<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KegiatanPhoto;
use Illuminate\Http\Request;

class AdminKegiatanPhotoController extends Controller
{
    // Menampilkan daftar foto kegiatan
    public function index()
    {
        // Mengambil foto dengan relasi ke kegiatan dan melakukan pagination
        $kegiatanPhotos = KegiatanPhoto::with('kegiatan')->paginate(10); // Paginasi langsung

        // Kelompokkan foto berdasarkan id_kegiatan
        $kegiatanGrouped = $kegiatanPhotos->groupBy('kegiatan_id');

        return view('admin.kegiatan.kegiatan_photos', compact('kegiatanGrouped', 'kegiatanPhotos'));
    }


    // Menghapus foto
    public function delete($id)
    {
        $kegiatanPhoto = KegiatanPhoto::findOrFail($id);

        // Menghapus file foto dari storage
        \Storage::delete('public/' . $kegiatanPhoto->photo_path);

        // Menghapus data foto dari database
        $kegiatanPhoto->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    // Fungsi untuk menampilkan detail foto kegiatan


    // Fungsi untuk mendownload semua foto terkait kegiatan
    public function downloadAllPhotos($id)
    {
        $kegiatanPhotos = KegiatanPhoto::where('kegiatan_id', $id)->get();

        // Mendapatkan path dari semua foto
        $files = $kegiatanPhotos->map(function ($photo) {
            return storage_path('app/public/' . $photo->photo_path);
        })->toArray();

        // Menggunakan ZipArchive untuk membuat file zip
        $zip = new \ZipArchive;
        $zipFileName = 'kegiatan_photos_' . $id . '.zip';
        $zipPath = storage_path('app/public/' . $zipFileName);

        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
