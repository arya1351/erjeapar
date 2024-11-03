<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PelaksanaController extends Controller
{
    public function index(){
        return view('pelaksana.dashboard');
    }
}
