<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $table = 'gedungs'; // Nama tabel di database
  
    protected $fillable = [
        'nama_ruangan',
        'x',
        'y',
        'gambargedung_id',
        'width',
        'height',
    ];



    public function gambargedung()
    {
        return $this->belongsTo(Gambargedung::class);
    }
    public function apars()
    {
        return $this->hasMany(Apar::class);
    }
}