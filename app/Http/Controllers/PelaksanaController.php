<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Apar;
use App\Models\Gambargedung;
use App\Models\Gedung;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PelaksanaController extends Controller
{
    public function index(){
        return view('pelaksana.dashboard');
    }

    // Function Apar Start
    public function dataapar(){
        $apars = Apar::with('gedungs')->get();

        return view('pelaksana.dataapar', compact('apars'));
    
    }
    
    public function createapar(){
        $gedungs = Gedung::all();
        return view('pelaksana.tambahapar', compact('gedungs'));
    }

    public function storeapar(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'jenis' => 'required|string|max:255',
            'merek' => 'nullable|string|max:255',
            'gedung_id' => 'required|exists:gedungs,id',
            'no_apar' => 'required|string|max:255',
            'tanggal_exp' => 'required|date',
            'perawatan' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Apar::create($request->all());

        return redirect()->route('pelaksana.dataapar')->with('success', 'Data Apar berhasil disimpan.');
    }
     // public function editapar(Request $request){
        
    // }

    public function destroyapar(Apar $apar)
    {
        $apar->delete();
        return redirect()->route('pelaksana.dataapar')->with('success', 'Ruangan berhasil dihapus.');
    }

    // Function Apar Stop
    // function gedung Start
    public function creategedung()
    {
        return view('pelaksana.tambahlayoutgedung');
    }

    public function storegedung(Request $request)
    {
        $request->validate([
            'image_gedung' => 'required|image',
        ]);

        $imageName = time() . '.' . $request->image_gedung->extension();
        $request->image_gedung->move(public_path('images'), $imageName);

        Gambargedung::create(['image_gedung' => $imageName]);

        return redirect()->route('pelaksana.datagedung')->with('success', 'Gambar Gedung berhasil ditambahkan.');
    }

    public function destroygedung(Gambargedung $gambargedung)
    {
        $gambargedung->delete();
        return redirect()->route('pelaksana.datagedung')->with('success', 'Gambar Gedung berhasil dihapus.');
    }
    // function gedung Stop
    // function Mapping Start
    public function datagedung(){
        $gedungs = Gedung::with('gambargedung')->get();
        return view('pelaksana.datagedung', compact('gedungs'));
    }
    public function createmapping()
    {
        $gambargedungs = Gambargedung::all();
        $existingGedung = Gedung::all()->toArray(); // pastikan ini dikonversi ke array
    
        return view('pelaksana.tambahmapping', compact('gambargedungs', 'existingGedung'));
    }

    public function storemapping(Request $request)
    {
        $request->validate([
            'gambargedung_id' => 'required|exists:gambargedungs,id',
            'nama_ruangan' => 'required|string|max:255',
            'area' => 'required' // Pastikan area diterima
        ]);

        Gedung::create([
            'gambargedung_id' => $request->gambargedung_id,
            'nama_ruangan' => $request->nama_ruangan,
            'area' => $request->area // Simpan data area dari canvas
        ]);

        return redirect()->route('layoutgedung.tambah')->with('success', 'Data ruangan berhasil disimpan.');
    }

    // function Mapping Stop

        // function Laporan Start
    




        // function Laporan Stop
}
