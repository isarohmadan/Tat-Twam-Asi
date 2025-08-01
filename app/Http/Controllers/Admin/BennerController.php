<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BennerController extends Controller
{
    public function index()
    {
        return view("admin.benner.benner");
    }
    public function create()
    {
        return view("admin.benner.tambahbenner");
    }
}
