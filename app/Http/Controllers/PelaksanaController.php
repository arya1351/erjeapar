<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelaksanaController extends Controller
{
    public function dashboard(){
        return view('pelaksana.dashboard');
    }
}
