<?php

namespace App\Exports;

use App\Models\Apar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AparsExport implements FromCollection, WithHeadings
{
    protected $search;

    // Tambahkan constructor untuk menerima parameter pencarian
    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Apar::with('gedungs')
            ->when($this->search, function ($query) {
                $query->where('jenis', 'like', "%{$this->search}%")
                    ->orWhere('merek', 'like', "%{$this->search}%")
                    ->orWhere('no_apar', 'like', "%{$this->search}%")
                    ->orWhere('tanggal_exp', 'like', "%{$this->search}%")
                    ->orWhere('perawatan', 'like', "%{$this->search}%")
                    ->orWhere('keterangan', 'like', "%{$this->search}%")
                    ->orWhereHas('gedungs', function ($query) {
                        $query->where('nama_ruangan', 'like', "%{$this->search}%");
                    });
            })
            ->get()
            ->map(function ($apar) {
                return [
                    'id' => $apar->id,
                    'jenis' => $apar->jenis,
                    'merek' => $apar->merek,
                    'no_apar' => $apar->no_apar,
                    'tanggal_exp' => $apar->tanggal_exp,
                    'perawatan' => $apar->perawatan,
                    'keterangan' => $apar->keterangan,
                    'nama_ruangan' => $apar->gedungs->nama_ruangan ?? 'N/A',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Jenis Apar',
            'Merek',
            'Nomor Apar',
            'Tanggal Expired',
            'Perawatan',
            'Keterangan',
            'Nama Ruangan',
        ];
    }
}