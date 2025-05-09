<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Banner;

class UserController extends Controller{
    public function index()
    {
        $banners = Banner::orderBy('order')->get(); // Ambil semua banner
        return view('user.home', compact('banners'));
    }
}