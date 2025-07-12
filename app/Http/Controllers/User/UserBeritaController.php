<?php

namespace App\Http\Controllers\User;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserBeritaController extends Controller
{
    public function index()
    {
        $featured = Berita::latest('tanggal_publikasi')->first();
        $beritas = Berita::orderBy('tanggal_publikasi', 'desc')->paginate(4);

        return view('home', compact('featured', 'beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('berita.show', compact('berita'));
    }
}
