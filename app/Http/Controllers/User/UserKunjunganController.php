<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserKunjunganController extends Controller{
    public function index(){
        return view("user.kunjungan.userkunjungan");
    }
    public function create(){
        return view("user.kunjungan.tambahsuratkunjungan");
    }
}