<?php

namespace App\Http\Controllers\KetuaYayasan;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\BeritaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KetuaBeritaController extends Controller
{
    public function index()
    {
        // Ambil berita yang diurutkan berdasarkan ID atau waktu pembuatan (terbaru)
        $beritas = Berita::with(['images', 'featuredImage'])
            ->orderByDesc('id') // Urutkan berdasarkan ID atau created_at terbaru
            ->paginate(10);


        $featuredBerita = $beritas->first();

        // Kembalikan data ke view
        return view('ketua_yayasan.berita.berita', compact('beritas', 'featuredBerita'));
    }
}
