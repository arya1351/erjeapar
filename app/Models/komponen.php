<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komponen extends Model
{
    use HasFactory;

    protected $table = 'komponens'; // Nama tabel di database
  
    protected $fillable = [
        'komponen',
        'jumlah',
        'satuan',
        'keterangan',
        'laporan_id',
    ];

    public function laporans()
    {
        return $this->belongsTo(Laporan::class);
    }
}
