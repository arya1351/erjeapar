<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\Gedung;
use Illuminate\Http\Request;

class AparController extends Controller
{
    public function create(){
        $gedungs = Gedung::all();

        return view('apar.tambah', compact('gedungs'));
    }
    public function store(Request $request){
        $request->validate([
            'jenis' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'gedung_id' => 'required',
            'no_apar' => 'required|integer|max:255',
            'date' => 'required',
            'keterangan' => 'required|integer|max:255',
        ]);

        Apar::create([
            'jenis' => $request->jenis,
            'merek' => $request->merek,
            'gedung_id' => $request->gedung_id,
            'no_apar' => $request->no_apar,
            'date' => $request->date,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pelaksana.datagedung')->with('success', 'Data Apar berhasil disimpan.');
    }   

    public function destroy(Apar $apar)
    {
        $apar->delete();
        return redirect()->route('pelaksana.datagedung')->with('success', 'Ruangan berhasil dihapus.');
    }
}
