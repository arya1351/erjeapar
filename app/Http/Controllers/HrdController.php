<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\Gambargedung;
use App\Models\Gedung;
use Illuminate\Http\Request;

class HrdController extends Controller
{
    public function dashboard()
    {
        return view('hrd.dashboard');
    }

    public function dataapar(){
        $apars = Apar::with('gedungs')->get();

        return view('hrd.dataapar', compact('apars'));
    }

    public function datamapping(){
        $gambargedungs = Gambargedung::all();
        $existingGedung = Gedung::all()->toArray();

        return view('hrd.datamapping', compact('gambargedungs', 'existingGedung'));
    }

    public function laporanhrd(){
        return view('');
    }
}
