<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class KeseluruhanDataController extends Controller
{
    public function index()
    {
        return view('admin.keseluruhandata');
    }
}
