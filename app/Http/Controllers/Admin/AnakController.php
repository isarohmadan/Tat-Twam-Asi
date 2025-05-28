<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biodata; // ✅ WAJIB: untuk menggunakan model Biodata

class AnakController extends Controller
{
    public function index(Request $request)
    {

        // Mengambil data anak berdasarkan kata kunci (jika ada)
        $katakunci = $request->get('katakunci');

        // Query untuk mengambil data berdasarkan kata kunci
        $data = Biodata::when($katakunci, function ($query) use ($katakunci) {
            return $query->where('nama', 'like', '%' . $katakunci . '%');
        })->get();
        foreach ($data as $anak) {
            $anak->tanggal_lahir = \Carbon\Carbon::parse($anak->tanggal_lahir);
        }
        return view('admin.anak.dataanak', compact('data'));
    }


    public function create()
    {
        // Form tambah anak
        return view('admin.anak.tambahanak');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|numeric|unique:biodata',
            'nama' => 'required|string',
            'nama_orangtua' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'asal' => 'nullable|string',
            'sekolah' => 'nullable|string',
        ]);



        // Simpan data ke database
        Biodata::create($request->all());

        // Redirect ke halaman index (dataanak) dengan pesan sukses
        return redirect()->route('admin.anak.dataanak')->with('success', 'Data anak berhasil disimpan.');
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|numeric',
            'nama' => 'required|string',
            'nama_orangtua' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'asal' => 'required|string',
            'sekolah' => 'required|string',
        ]);

        // Temukan data anak berdasarkan ID
        $biodata = Biodata::findOrFail($id);

        // Update data
        $biodata->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'nama_orangtua' => $request->nama_orangtua,
            'tanggal_lahir' => $request->tanggal_lahir,
            'asal' => $request->asal,
            'sekolah' => $request->sekolah,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.anak.dataanak')->with('success', 'Data anak berhasil diupdate.');
    }


    public function destroy($id)
    {
        $biodata = Biodata::findOrFail($id);
        $biodata->delete();

        return redirect()->route('admin.anak.dataanak')->with('success', 'Data anak berhasil dihapus.');
    }
}
