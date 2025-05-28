<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
{
    $beritas = Berita::orderBy('tanggal_publikasi', 'desc')->paginate(10);
    return view('admin.berita.berita', compact('beritas'));
}

    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|max:255',
        'ringkasan' => 'required',
        'isi' => 'required',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'tanggal_publikasi' => 'required|date',
    ]);

    $slug = Str::slug($request->judul);
    
    // Cek duplikasi slug
    $originalSlug = $slug;
    $counter = 1;
    while (Berita::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter++;
    }

    // Simpan gambar ke folder 'berita' di storage
    $gambarPath = $request->file('gambar')->store('berita', 'public');

    Berita::create([
        'judul' => $request->judul,
        'slug' => $slug,
        'ringkasan' => $request->ringkasan,
        'isi' => $request->isi,
        'gambar' => $gambarPath,
        'tanggal_publikasi' => $request->tanggal_publikasi,
    ]);

    return back()->with('success', 'Berita berhasil ditambahkan!');
}

public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|max:255',
        'slug' => 'required|unique:berita,slug,' . $id,
        'ringkasan' => 'required',
        'isi' => 'required',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'tanggal_publikasi' => 'required|date',
    ]);

    $berita = Berita::findOrFail($id);

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama
        Storage::disk('public')->delete($berita->gambar);
        // Simpan gambar baru
        $gambarPath = $request->file('gambar')->store('berita', 'public');
        $berita->gambar = $gambarPath;
    }

    $berita->judul = $request->judul;
    $berita->slug = $request->slug;
    $berita->ringkasan = $request->ringkasan;
    $berita->isi = $request->isi;
    $berita->tanggal_publikasi = $request->tanggal_publikasi;
    $berita->save();

    return back()->with('success', 'Berita berhasil diperbarui!');
}

public function destroy($id)
{
    $berita = Berita::findOrFail($id);
    // Hapus gambar dari storage
    Storage::disk('public')->delete($berita->gambar);
    $berita->delete();

    return back()->with('success', 'Berita berhasil dihapus!');
}
}
