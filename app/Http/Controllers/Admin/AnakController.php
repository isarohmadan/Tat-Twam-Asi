<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biodata; // untuk menggunakan model Biodata

use Barryvdh\DomPDF\Facade\Pdf; //library dom PDF

//import untuk export excel
use App\Exports\AnakExport; //template excel
use Maatwebsite\Excel\Facades\Excel; //library excel

class AnakController extends Controller
{
    public function index(Request $request)
{
    $katakunci = $request->get('katakunci');
    $data = Biodata::when($katakunci, function ($query) use ($katakunci) {
        return $query->where('nama', 'like', '%' . $katakunci . '%')
            ->orWhere('nama_orangtua', 'like', '%' . $katakunci . '%')
            ->orWhere('asal', 'like', '%' . $katakunci . '%')
            ->orWhere('sekolah', 'like', '%' . $katakunci . '%');
    })->paginate(25);

        foreach ($data as $anak) {
            $anak->tanggal_lahir = \Carbon\Carbon::parse($anak->tanggal_lahir);
        }

    if ($request->ajax()) {
        return view('admin.anak.table', compact('data'));
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
            'nik' => 'required|string|unique:biodata',
            'nama' => 'required|string',
            'nama_orangtua' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'asal' => 'nullable|string',
            'sekolah' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',  // Check for Laki-laki or Perempuan
        'tanggal_masuk_panti' => 'nullable|date', // Optional date field
        'keterangan' => 'nullable|in:Yatim,Tidak Mampu,Piatu,Yatim Piatu', // Check for valid keterangan
        ]);

        // Simpan file foto (jika ada)
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto-anak', 'public'); // simpan di storage/app/public/foto-anak
        }


        // Simpan data ke database
        Biodata::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'nama_orangtua' => $request->nama_orangtua,
            'tanggal_lahir' => $request->tanggal_lahir,
            'asal' => $request->asal,
            'sekolah' => $request->sekolah,
            'foto' => $fotoPath, // ⬅️ path file foto yang sudah disimpan
            'jenis_kelamin' => $request->jenis_kelamin, // Jenis kelamin
            'tanggal_masuk_panti' => $request->tanggal_masuk_panti, // Tanggal masuk panti
            'keterangan' => $request->keterangan, // Keterangan
        ]);

        // Redirect ke halaman index (dataanak) dengan pesan sukses
        return redirect()->route('admin.anak.dataanak')->with('success', 'Data anak berhasil disimpan.');
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'nama_orangtua' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'asal' => 'required|string',
            'sekolah' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan', // Validate jenis_kelamin
            'tanggal_masuk_panti' => 'nullable|date', // Optional date field
            'keterangan' => 'nullable|in:Yatim,Tidak Mampu,Piatu,Yatim Piatu', // Correct validation for keterangan
        ]);

        // Temukan data anak berdasarkan ID
        $biodata = Biodata::findOrFail($id);

        // Cek apakah ada file foto baru yang diunggah
        if ($request->hasFile('foto')) {
            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('foto-anak', 'public');
        } else {
            // Gunakan foto lama jika tidak ada upload baru
            $fotoPath = $request->foto_lama;
        }

        // Update data
        $biodata->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'nama_orangtua' => $request->nama_orangtua,
            'tanggal_lahir' => $request->tanggal_lahir,
            'asal' => $request->asal,
            'sekolah' => $request->sekolah,
            'foto' => $fotoPath,
            'jenis_kelamin' => $request->jenis_kelamin, // Jenis kelamin
            'tanggal_masuk_panti' => $request->tanggal_masuk_panti, // Tanggal masuk panti
            'keterangan' => $request->keterangan, // Keterangan
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

    public function export()
    {
        return Excel::download(new AnakExport, 'data-anak.xlsx');
    }

    public function exportPdf($id)
    {
        $anak = Biodata::findOrFail($id);
        $pdf = Pdf::loadView('admin.anak.pdf', compact('anak'));

        return $pdf->download('data-anak.pdf');
    }
}
