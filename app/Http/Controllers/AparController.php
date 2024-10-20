<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AparController extends Controller
{
    public function index(){
        return view('apar.tambah');
    }
}
