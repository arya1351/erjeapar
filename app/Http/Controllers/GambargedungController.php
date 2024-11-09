<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Gambargedung;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GambargedungController extends Controller
{
    public function pelaksana()
    {
        $gambargedungs = Gambargedung::all();
        return view('pelaksana.datagedung', compact('gambargedungs'));
    }

    public function kepalabagian()
    {
        $gambargedungs = Gambargedung::all();
        return view('kepalabagian.datagedung', compact('gambargedungs'));
    }

    public function hrd()
    {
        $gambargedungs = Gambargedung::all();
        return view('hrd.datagedung', compact('gambargedungs'));
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
        // $request->authenticate();

        // $request->session()->regenerate();

        $gambargedung->delete();
        return redirect()->route('pelaksana.datagedung')->with('success', 'Gambar Gedung berhasil dihapus.');
        // $url = "pelaksana/datagedung";

        // if ($request->user()->role == "hrd") {
        //     $url = "hrd/datagedung";
        // } else if($request->user()->role == "kepalabagian"){
        //     $url = "kepalabagian/datagedung";
        // }

        // return redirect()->intended($url);
    }
}
