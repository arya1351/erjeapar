<?php

namespace App\Exports;

use App\Models\Apar;
use Maatwebsite\Excel\Concerns\FromCollection;

class AparsExport implements FromCollection
{
    public function collection()
    {
        return Apar::all();
    }
}