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
    public function index()
    {
        $apars = Apar::count();
        $mappings = Gedung::count();
        $laporans = Laporan::count();
        $gambargedungs = Gambargedung::all();
        if ($gambargedungs->isEmpty()) {
            return view('kepalabagian.dashboard', [
                'apars' => $apars,
                'mappings' => $mappings,
                'laporans' => $laporans,
                'gambargedungs' => [], // Kirim data kosong
            ]);
        }

        $gedungs = Gedung::with('gambargedung')->get()->toArray();

        return view('kepalabagian.dashboard', compact('gedungs', 'gambargedungs', 'apars', 'mappings', 'laporans'));
    }

    public function dashboardgetMapping($gambargedungId)
    {
        $gedungs = Gedung::where('gambargedung_id', $gambargedungId)->get();
        if ($gedungs->isEmpty()) {
            return response()->json(['message' => 'Gedung tidak ditemukan'], 404);
        }

        return response()->json($gedungs);
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

    public function exportapar(Request $request)
    {
        $search = $request->input('search');
        return Excel::download(new AparsExport($search), 'apar-' . now()->format('YmdHis') . '.xlsx');
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

    // function Mapping Start
    public function datamapping()
    {
        $gambargedungs = Gambargedung::all();
        $gedungs = Gedung::with('gambargedung')->get()->toArray(); // Memastikan relasi 'gambargedung' ada di model Gedung
        $gedungsobjects = Gedung::with('gambargedung')->get();
        return view('kepalabagian.datamapping', compact('gedungs', 'gambargedungs', 'gedungsobjects'));
    }

    public function getMapping($gambargedungId)
    {
        $gedungs = Gedung::where('gambargedung_id', $gambargedungId)->get();
        if ($gedungs->isEmpty()) {
            return response()->json(['message' => 'Gedung tidak ditemukan'], 404);
        }

        return response()->json($gedungs);
    }

    // function Mapping Stop

    // function Laporan Start
    public function datalaporan()
    {
        $laporans = Laporan::with('komponens')->paginate(5);
        return view('kepalabagian.datalaporan', compact('laporans'));
    }

    public function printlaporan($id)
    {
        $laporans = Laporan::with('komponens')->findOrFail($id);

        return view('pelaksana.cetaklaporan', compact('laporans'));
    }

    // function Laporan Stop

    // kirim laporan start

    public function datakirimlaporan()
    {
        $filelaporans = Filelaporan::paginate(5);

        return view('kepalabagian.datakirimlaporan', compact('filelaporans'));
    }

    public function kirimlaporan()
    {
        return view(view: 'kepalabagian.kirimlaporan');
    }

    public function showpdf(Filelaporan $filelaporan, $id)
    {
        $filelaporan = Filelaporan::findOrFail($id);
        return response()->file(storage_path('app/public/' . $filelaporan->file_laporan));
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

        $file = $request->file('file_laporan');
        $filelaporan = $file->store('filelaporans', 'public'); // Simpan file ke storage/public/pdfs

        Filelaporan::create([
            'file_laporan' => $filelaporan,
        ]);

        return redirect()->route('kepalabagian.datakirimlaporan')->with('success', 'PDF berhasil diupload.');
    }

    public function destroyfilelaporan($id)
    {
        $filelaporans = Filelaporan::findOrFail($id);
        // Path file gambar
        $filePath = public_path('filelaporans/' . $filelaporans->image_gedung);

        // Hapus file jika ada
        if (file_exists($filePath)) {
            unlink($filePath); // Menghapus file gambar dari folder
        }

        $filelaporans->delete();

        return redirect()->route('kepalabagian.datakirimlaporan')->with('success', 'File Laporan berhasil dihapus.');
    }

    // function Laporan Stop
}
