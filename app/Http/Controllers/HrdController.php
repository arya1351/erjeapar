<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HrdController extends Controller
{
    public function dashboard()
    {
        return view('hrd.dashboard');
    }
}
