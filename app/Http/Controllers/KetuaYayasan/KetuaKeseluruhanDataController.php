<?php

namespace App\Http\Controllers\KetuaYayasan;

use App\Http\Controllers\Controller;

class KetuaKeseluruhanDataController extends Controller
{
    public function index()
    {
        return view('ketua_yayasan.keseluruhandata');
    }
}
