<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Berita;

class UserController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->get();
        $featuredBerita = Berita::latest('tanggal_publikasi')->first();
        $beritas = Berita::orderBy('tanggal_publikasi', 'desc')->take(4)->get();
        
        return view('user.home', compact('banners', 'featuredBerita', 'beritas'));
    }
    
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return response()->json($berita);
    }
}
