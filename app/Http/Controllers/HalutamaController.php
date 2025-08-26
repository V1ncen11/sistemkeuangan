<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalutamaController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function dashboard(){
        return view('hal_utama');
    }
}
