<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalutamaController extends Controller
{
    public function index(){
        return view('hal_utama');
    }
}
