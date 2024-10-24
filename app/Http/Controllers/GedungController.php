<?php

namespace App\Http\Controllers;

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
        return view('layoutgedung.tambah', compact('gambargedungs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambargedung_id' => 'required|exists:gambargedungs,id',
            'nama_ruangan' => 'required|string|max:255',
            'area' => 'required|string|max:255',
        ]);

        Gedung::create($request->all());

        return redirect()->route('layoutgedung.tambah')->with('success', 'Ruangan berhasil ditambahkan.');
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
