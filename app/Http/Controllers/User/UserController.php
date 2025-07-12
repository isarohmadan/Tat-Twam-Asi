<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->get();
        $beritas = Berita::with(['featuredImage', 'images'])
            ->latest() // Mengurutkan berdasarkan created_at terbaru
            ->get();

        // Mengubah tanggal_publikasi menjadi objek Carbon jika belum
        foreach ($beritas as $berita) {
            $berita->tanggal_publikasi = \Carbon\Carbon::parse($berita->tanggal_publikasi);
        }

        // Ambil berita pertama sebagai featured post
        $featuredBerita = $beritas->first();

        return view('user.home', compact('banners', 'featuredBerita', 'beritas'));
    }

    public function show($id)
    {
        $berita = Berita::with('images')->find($id);

        if (!$berita) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak ditemukan.'
            ], 404);
        }

        $images = $berita->images->map(function ($image) {
            return asset(Storage::url($image->path));
        });

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $berita->id,
                'judul' => $berita->judul,
                'images' => $images,
                'featured_image' => $berita->featuredImage ? asset(Storage::url($berita->featuredImage->path)) : null,
                'ringkasan' => $berita->ringkasan,
                'isi' => $berita->isi,
                'tanggal_publikasi' => $berita->tanggal_publikasi
            ]
        ]);
    }
}
