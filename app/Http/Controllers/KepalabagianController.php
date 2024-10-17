<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KepalabagianController extends Controller
{
    public function dashboard()
    {
        return view('kepalabagian.dashboard');
    }

    public function operatortable(){
        return view('kepalabagian.operatortable');
    }
}
