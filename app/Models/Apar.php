<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apar extends Model
{
    use HasFactory;
    
    protected $table = 'apars';

    protected $fillable = ['jenis', 'merek', 'gedung_id','no_apar', 'tanggal_exp', 'perawatan', 'keterangan'];

    public function gedungs()
    {
        return $this->belongsTo(Gedung::class, 'gedung_id');
}
}
