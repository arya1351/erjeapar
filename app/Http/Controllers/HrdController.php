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
        $apars = Apar::with('gedungs')->paginate(perPage: 10);

        return view('hrd.dataapar', compact('apars'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $apars = Apar::with('gedungs')
            ->when($search, function ($query, $search) {
                $query
                    ->where('jenis', 'like', "%{$search}%")
                    ->orWhere('merek', 'like', "%{$search}%")
                    ->orWhere('no_apar', 'like', "%{$search}%")
                    ->orWhere('tanggal_exp', 'like', "%{$search}%")
                    ->orWhere('perawatan', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%")
                    ->orWhereHas('gedungs', function ($query) use ($search) {
                        $query->where('nama_ruangan', 'like', "%{$search}%");
                    });
            })
            ->paginate(10);

        return view('hrd.data-apar-partial', compact('apars'))->render();
    }

    public function laporanhrd(){
        return view('');
    }

    // function Mapping Start
    public function hrddatamapping()
    {
        $gambargedungs = Gambargedung::all();
        $gedungs = Gedung::with('gambargedung')->get()->toArray(); // Memastikan relasi 'gambargedung' ada di model Gedung
        $gedungsobjects = Gedung::with('gambargedung')->get();
        return view('hrd.datamapping', compact('gedungs', 'gambargedungs', 'gedungsobjects'));
    }

    public function hrdgetdataMapping($gambargedungId)
    {

        $gedungs = Gedung::where('gambargedung_id', $gambargedungId)->get();
        if ($gedungs->isEmpty()) {
            return response()->json(['message' => 'Gedung tidak ditemukan'], 404);
        }

        return response()->json($gedungs);
    }
}
