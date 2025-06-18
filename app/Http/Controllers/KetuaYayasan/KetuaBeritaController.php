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

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'ringkasan' => 'required',
            'isi' => 'required',
            'gambar' => 'required|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tanggal_publikasi' => 'required|date',
            'featured_image' => 'required|integer',
        ]);

        $slug = Str::slug($request->judul);
        
        // Cek duplikasi slug
        $originalSlug = $slug;
        $counter = 1;
        while (Berita::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        // Buat berita
        $berita = Berita::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'ringkasan' => $request->ringkasan,
            'isi' => $request->isi,
            'tanggal_publikasi' => Carbon::parse($request->tanggal_publikasi),
        ]);

        // Simpan gambar-gambar
        foreach ($request->file('gambar') as $index => $gambar) {
            $gambarPath = $gambar->store('berita', 'public');
            
            BeritaImage::create([
                'berita_id' => $berita->id,
                'path' => $gambarPath,
                'is_featured' => $index == $request->featured_image,
            ]);
        }

        return back()->with('success', 'Berita berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'slug' => 'required|unique:beritas,slug,' . $id,
            'ringkasan' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tanggal_publikasi' => 'required|date',
            'featured_image' => 'required|integer',
            'existing_images' => 'nullable|array',
        ]);

        $berita = Berita::findOrFail($id);

        // Update data berita
        $berita->update([
            'judul' => $request->judul,
            'slug' => $request->slug,
            'ringkasan' => $request->ringkasan,
            'isi' => $request->isi,
            'tanggal_publikasi' => Carbon::parse($request->tanggal_publikasi)
        ]);

        // Update gambar yang ada
        if ($request->has('existing_images')) {
            foreach ($berita->images as $image) {
                $image->update([
                    'is_featured' => in_array($image->id, $request->existing_images) && 
                                    $image->id == $request->featured_image
                ]);
            }
        }

        // Tambahkan gambar baru
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $index => $gambar) {
                $gambarPath = $gambar->store('berita', 'public');
                
                BeritaImage::create([
                    'berita_id' => $berita->id,
                    'path' => $gambarPath,
                    'is_featured' => $berita->images->count() == 0 && $index == 0,
                ]);
            }
        }

        // Update featured image jika perlu
        if ($request->has('featured_image')) {
            $berita->images()->update(['is_featured' => false]);
            $berita->images()->where('id', $request->featured_image)->update(['is_featured' => true]);
        }

        return back()->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Hapus semua gambar dari storage
        foreach ($berita->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus!');
    }

    public function destroyImage($id)
    {
        $image = BeritaImage::findOrFail($id);
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus!');
    }
}
