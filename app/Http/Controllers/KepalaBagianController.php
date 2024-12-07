<?php

namespace App\Http\Controllers;

use App\Exports\AparsExport;
use App\Http\Controllers\Controller;
use App\Imports\AparsImport;
use App\Models\Apar;
use App\Models\Filelaporan;
use App\Models\Gambargedung;
use App\Models\Gedung;
use App\Models\komponen;
use App\Models\Laporan;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KepalaBagianController extends Controller
{
    public function index(){
        return view('kepalabagian.dashboard');
    }

    // Function Apar Start
    public function dataapar(Request $request)
    {
        $apars = Apar::with('gedungs')->paginate(perPage: 10);

        return view('kepalabagian.dataapar', compact('apars'));
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

        return view('kepalabagian.data-apar-partial', compact('apars'))->render();
    }

    public function createapar(){
        $gedungs = Gedung::all();
        return view('kepalabagian.tambahapar', compact('gedungs'));
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

        return redirect()->route('kepalabagian.dataapar')->with('success', 'Data Apar berhasil disimpan.');
    }
     // public function editapar(Request $request){
        
    // }

    public function destroyapar(Apar $apar, $id)
    {
        $apar = Apar::findOrFail($id);
        $apar->delete();
        return redirect()->route('kepalabagian.dataapar')->with('success', 'Ruangan berhasil dihapus.');
    }

    
    public function kepalabagianexportapar()
    {
        return Excel::download(new AparsExport(), 'apar-' . Carbon::now()->timestamp . '.xlsx');
    }

    public function viewimportapar()
    {
        return view('kepalabagian.imporapar');
    }

    public function importapar()
    {
        Excel::import(new AparsImport(), request()->file('file'));
        return redirect()->route('kepalabagian.dataapar');
    }

    // Function Apar Stop
    // function gedung Start
    public function creategedung()
    {
        return view('kepalabagian.tambahlayoutgedung');
    }

    public function storegedung(Request $request)
    {
        $request->validate([
            'image_gedung' => 'required|image',
        ]);

        $imageName = time() . '.' . $request->image_gedung->extension();
        $request->image_gedung->move(public_path('images'), $imageName);

        Gambargedung::create(['image_gedung' => $imageName]);

        return redirect()->route('kepalabagian.datamapping')->with('success', 'Gambar Gedung berhasil ditambahkan.');
    }

    public function destroygedung(Gambargedung $gambargedung)
    {
        $gambargedung->delete();
        return redirect()->route('kepalabagian.datamapping')->with('success', 'Gambar Gedung berhasil dihapus.');
    }
    // function gedung Stop
    
    // function Mapping Start
    public function datamapping()
    {
        $gambargedungs = Gambargedung::all();
        $gedungs = Gedung::with('gambargedung')->get()->toArray(); // Memastikan relasi 'gambargedung' ada di model Gedung
        $gedungsobjects = Gedung::with('gambargedung')->get();
        return view('kepalabagian.datamapping', compact('gedungs', 'gambargedungs', 'gedungsobjects'));
    }
    
    public function getdataMapping($gambargedungId)
    {

        $gedungs = Gedung::where('gambargedung_id', $gambargedungId)->get();
        if ($gedungs->isEmpty()) {
            return response()->json(['message' => 'Gedung tidak ditemukan'], 404);
        }

        return response()->json($gedungs);
    }

    public function createmapping($gambargedung_id)
    {
        $gambargedungs = GambarGedung::find($gambargedung_id);
        $existingGedung = Gedung::where('gambargedung_id', $gambargedung_id)->get()->toArray();

        return view('kepalabagian.tambahmapping', compact('gambargedungs', 'existingGedung'));
    }

    public function getMapping($gambargedungId)
    {

        $gedungs = Gedung::where('gambargedung_id', $gambargedungId)->get();
        if ($gedungs->isEmpty()) {
            return response()->json(['message' => 'Gedung tidak ditemukan'], 404);
        }

        return response()->json($gedungs);
    }

    public function storemapping(Request $request)
    {
        try {
            // Validasi data yang dikirim
            $request->validate([
                'nama_ruangan' => 'required|string|max:255',
                'x' => 'required|numeric',
                'y' => 'required|numeric',
                'width' => 'required|numeric',
                'height' => 'required|numeric',
                'gambargedung_id' => 'required|numeric', // Pastikan gambargedung_id valid
            ]);

            // Menambah gedung baru
            $gedung = new Gedung();
            $gedung->nama_ruangan = $request->nama_ruangan;
            $gedung->x = $request->x;
            $gedung->y = $request->y;
            $gedung->width = $request->width;
            $gedung->height = $request->height;
            $gedung->gambargedung_id = $request->gambargedung_id; // Menambahkan gambargedung_id
            $gedung->save();

            return response()->json($gedung, 201); // Mengembalikan response JSON
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menambah gedung'], 500);
        }
    }

    public function updatemapping(Request $request, $id)
    {

        // Validasi data
        $validated = $request->validate([
            'width' => 'required|numeric|min:10',
            'height' => 'required|numeric|min:10',
            'x' => 'required|numeric',
            'y' => 'required|numeric',
            'nama_ruangan' => 'required|string|max:255',
        ]);

        // Temukan gedung berdasarkan ID
        $gedung = Gedung::find($id);
        $gedung->update($validated);

        return response()->json(['message' => 'Gedung berhasil diupdate', 'gedung' => $gedung], 200);
    }

    public function destroymapping($id)
    {
        $gedung = Gedung::findOrFail($id);
        $gedung->delete();

        return response()->json(['message' => 'Gedung berhasil dihapus.']);
    }

    // function Mapping Stop

        // function Laporan Start
        public function datalaporan()
        {
            $laporans = Laporan::with('komponens')->paginate(5);
            return view('kepalabagian.datalaporan', compact('laporans'));
        }
    
        public function createlaporan()
        {
            return view('kepalabagian.tambahlaporan');
        }
    
        public function storelaporan(Request $request)
        {
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'jenislaporan' => 'required|string|min:1|max:255',
                'pembuat' => 'max:255',
                'kepalabagian' => 'required|string|min:1|max:255',
                'hrd' => 'required|string|min:1',
                'tanggal_pengajuan' => 'required',
            ]);
    
            Laporan::create($validatedData);
    
            return redirect()->route('kepalabagian.datalaporan')->with('success', 'Laporan berhasil ditambah.');
        }
    
        public function destroylaporan($id)
        {
            $laporan = Laporan::findOrFail($id);
            $laporan->delete();
    
            return redirect()->route('kepalabagian.datalaporan')->with('success', 'Laporan berhasil dihapus.');
        }
    
        // function komponen start
        public function createkomponen($id)
        {
            // Ambil laporan_id dari parameter ID
            $laporan_id = $id;
    
            // Pastikan ID laporan ada, misalnya melalui pengecekan
            $laporan = Laporan::find($laporan_id);
            if (!$laporan) {
                return redirect()->route('kepalabagian.datalaporan')->with('error', 'Laporan tidak ditemukan.');
            }
    
            return view('kepalabagian.tambahkomponen', compact('laporan_id'));
        }
    
        public function storekomponen(Request $request)
        { 
            // Validasi data input
            $validatedData = $request->validate([
                'komponen' => 'required|string|max:255',
                'jumlah' => 'required|integer|min:1|max:10',
                'keterangan' => 'required|string|min:1|max:255',
                'satuan' => 'required|string|min:1',
                'laporan_id' => 'required|exists:laporans,id', // Memastikan laporan_id valid
            ]);
    
            // Menyimpan data komponen dengan laporan_id
            komponen::create($validatedData);
    
            // Redirect setelah berhasil
            return redirect()->route('kepalabagian.datalaporan')->with('success', 'Komponen berhasil ditambah.');
        }
    
        // function print out
        public function printlaporan($id)
        {
            $laporans = Laporan::with('komponens')->findOrFail($id);
    
            return view('kepalabagian.cetaklaporan', compact('laporans'));
        }
        // function komponen stop
    
        // function Laporan Stop
    
        // kirim laporan start 
    
        public function datakirimlaporan(){
            return view ('kepalabagian.datakirimlaporan');
        }
    
        public function createkirimlaporan(){
            return view('kepalabagian.tambahkirimlaporan');
        }
    
        public function download(Filelaporan $filelaporan)
        {
            return response()->download(storage_path('app/public/' . $filelaporan->file_laporan));
        }
    
        public function storekirimlaporan(Request $request)
        {
            $request->validate([
                'file_laporan' => 'required|mimes:pdf|max:2048', // Validasi file
            ]);
    
            $file = $request->file('file');
            $filelaporan = $file->store('filelaporans', 'public'); // Simpan file ke storage/public/pdfs
    
            Filelaporan::create([
                'file_laporan' => $filelaporan,
            ]);
    
            return redirect()->route('kepalabagian.datakirimlaporan')->with('success', 'PDF berhasil diupload.');
        }




        // function Laporan Stop
}
