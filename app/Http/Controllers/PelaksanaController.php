<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelaksanaController extends Controller
{
    public function index(){
        return view('pelaksana.dashboard');
    }

    public function dataapar(){
        return view('pelaksana.dataapar');
    }
}
