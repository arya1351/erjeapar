<?php

namespace App\Http\Controllers\Pelaksana;

use App\Http\Controllers\Controller;

use App\Models\Gambargedung;
use Illuminate\Http\Request;

class GambargedungController extends Controller
{
    public function index()
    {
        $gambargedungs = Gambargedung::all();
        return view('pelaksana.datagedung', compact('gambargedungs'));
    }

    public function create()
    {
        return view('gedung.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_gedung' => 'required|image',
        ]);

        $imageName = time() . '.' . $request->image_gedung->extension();
        $request->image_gedung->move(public_path('images'), $imageName);

        Gambargedung::create(['image_gedung' => $imageName]);

        return redirect()->route('pelaksana.datagedung')->with('success', 'Gambar Gedung berhasil ditambahkan.');
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

    public function destroy(Gambargedung $gambargedung)
    {
        $gambargedung->delete();
        return redirect()->route('pelaksana.datagedung')->with('success', 'Gambar Gedung berhasil dihapus.');
    }
}
