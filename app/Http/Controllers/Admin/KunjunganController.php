<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $jumlahMenunggu = Kunjungan::where('status', 'menunggu')->count();

        return view('admin.kunjungan.kunjungan', compact('kunjungans', 'jumlahMenunggu'));
    }

}
