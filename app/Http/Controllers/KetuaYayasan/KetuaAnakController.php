<?php

namespace App\Http\Controllers\KetuaYayasan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Biodata;
use App\Exports\AnakExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class KetuaAnakController extends Controller
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


        return view('ketua_yayasan.anak.dataanak', compact('data'));
    }

    public function export()
    {
        return Excel::download(new AnakExport, 'data-anak.xlsx');
    }

    public function exportPdf($id)
    {
        $anak = Biodata::findOrFail($id);
        $pdf = Pdf::loadView('ketua_yayasan.anak.pdf', compact('anak'));

        return $pdf->download('data-anak.pdf');
    }
}
