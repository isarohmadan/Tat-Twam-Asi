<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserKegiatanController extends Controller{
    public function index(){
        return view("user.kegiatan.userkegiatan");
    }
    public function create(){
        return view("user.kegiatan.tambahsuratkegiatan");
    }
}