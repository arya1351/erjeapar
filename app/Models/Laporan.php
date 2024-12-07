<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans'; // Nama tabel di database
  
    protected $fillable = [
        'jenislaporan',
        'pembuat',
        'kepalabagian',
        'hrd',
        'tanggal_pengajuan',
    ];

    public function komponens()
    {
        return $this->hasMany(komponen::class);
    }
}
