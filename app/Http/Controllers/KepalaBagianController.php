<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KepalaBagianController extends Controller
{
    public function dashboard()
    {
        return view('kepalabagian.dashboard');
    }
   
}
