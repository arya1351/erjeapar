<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;
use App\Models\Apar;
use App\Models\Gedung;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AparController extends Controller
{
    
    public function index(){
        $apars = Apar::with('gedungs')->get();

        return view('pelaksana.dataapar', compact('apars'));
    }
    
    public function create()
    {
        $gedungs = Gedung::all();

        return view('apar.tambah', compact('gedungs'));
    }
    public function store(Request $request): RedirectResponse
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

    
    // public function edit(Gambargedung $gambargedung)
    // {
    //     return view('gambargedungs.edit', compact('gambargedung'));
    // }

    // public function update(Request $request, Gambargedung $gambargedung)
    // {
    //     $request->validate([
    //         'image_gedung' => 'image',
    //     ]);

    //     if ($request->hasFile('image_gedung')) {
    //         $imageName = time() . '.' . $request->image_gedung->extension();
    //         $request->image_gedung->move(public_path('images'), $imageName);
    //         $gambargedung->update(['image_gedung' => $imageName]);
    //     }

    //     return redirect()->route('gambargedungs.index')->with('success', 'Gambar Gedung berhasil diperbarui.');
    // }

    public function destroy(Apar $apar)
    {
        $apar->delete();
        return redirect()->route('pelaksana.dataapar')->with('success', 'Ruangan berhasil dihapus.');
    }
}
