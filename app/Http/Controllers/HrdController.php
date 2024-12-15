<?php

namespace App\Http\Controllers;

use App\Models\Apar;
use App\Models\Filelaporan;
use App\Models\Gambargedung;
use App\Models\Gedung;
use App\Models\Laporan;
use Illuminate\Http\Request;

class HrdController extends Controller
{
    public function dashboard()
    {
        $apars = Apar::count();
        $mappings = Gedung::count();
        $filelaporans = Filelaporan::count();
        $gambargedungs = Gambargedung::all();
        $gedungs = Gedung::with('gambargedung')->get()->toArray();
        return view('hrd.dashboard',compact('gedungs', 'gambargedungs', 'apars', 'mappings', 'filelaporans'));
    }
    public function dashboardgetMapping($gambargedungId)
    {

        $gedungs = Gedung::where('gambargedung_id', $gambargedungId)->get();
        if ($gedungs->isEmpty()) {
            return response()->json(['message' => 'Gedung tidak ditemukan'], 404);
        }

        return response()->json($gedungs);
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

    public function pengajuanlaporan(){
        $filelaporans = Filelaporan::paginate(5);

        return view ('hrd.datapengajuan', compact('filelaporans'));
    }
    
    public function showpdf(Filelaporan $filelaporan, $id)
    {
        $filelaporan = Filelaporan::findOrFail($id);
        return response()->file(storage_path('app/public/' . $filelaporan->file_laporan));
    }
}
