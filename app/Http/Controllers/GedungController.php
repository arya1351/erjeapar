<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Gedung;
use App\Models\Gambargedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::with('gambargedung')->get();
        return view('pelaksana.datagedung', compact('gedungs'));
    }

    public function create()
    {
        $gambargedungs = Gambargedung::all();
        $existingGedung = Gedung::all()->toArray(); // pastikan ini dikonversi ke array
    
        return view('layoutgedung.tambah', compact('gambargedungs', 'existingGedung'));
    }
    
    public function store(Request $request)
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

    // public function edit(Gedung $gedung)
    // {
    //     $gambargedungs = Gambargedung::all();
    //     return view('gedungs.edit', compact('gedung', 'gambargedungs'));
    // }

    // public function update(Request $request, Gedung $gedung)
    // {
    //     $request->validate([
    //         'gambargedung_id' => 'required|exists:gambargedungs,id',
    //         'nama_ruangan' => 'required|string|max:255',
    //         'area' => 'required|string|max:255',
    //     ]);

    //     $gedung->update($request->all());

    //     return redirect()->route('gedungs.index')->with('success', 'Ruangan berhasil diperbarui.');
    // }

    public function destroy(Gedung $gedung)
    {
        $gedung->delete();
        return redirect()->route('gedungs.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
