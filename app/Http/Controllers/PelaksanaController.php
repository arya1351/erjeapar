<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gambargedung;
use App\Models\Gedung;
use Illuminate\Http\Request;

class PelaksanaController extends Controller
{
    public function index(){
        return view('pelaksana.dashboard');
    }

    public function dataapar(){
        return view('pelaksana.dataapar');
    }
    
    public function createapar(){
        return view('pelaksana.tambahapar');
    }

    // public function storeapar(Request $request){
        
    // }

     // public function editapar(Request $request){
        
    // }

    public function datagedung(){
        $gedungs = Gedung::with('gambargedung')->get();
        return view('pelaksana.datagedung', compact('gedungs'));
    }
    public function creategedung()
    {
        $gambargedungs = Gambargedung::all();
        $existingGedung = Gedung::all()->toArray(); // pastikan ini dikonversi ke array
    
        return view('pelaksana.tambahmapping', compact('gambargedungs', 'existingGedung'));
    }

    // function gedung
}
