<?php

namespace App\Imports;

use App\Models\Apar;
use App\Models\Gedung;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AparsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Apar|null
     */
    public function model(array $row)
    {
        $gedung = Gedung::where('nama_ruangan', $row['gedung'])->first();

        return new Apar([
           'jenis'     => $row['jenis'],
           'merek'    => $row['merek'],
           'gedung_id' => $gedung['id'],
           'no_apar' => $row['no_apar'],
           'tanggal_exp' => Carbon::parse($row['tanggal_exp'])->format('Y-m-d'),
           'perawatan' => $row['perawatan'],
           'keterangan' => $row['keterangan'],
        ]);
    }
}