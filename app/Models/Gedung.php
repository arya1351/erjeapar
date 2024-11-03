<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $table = 'gedungs';

    protected $fillable = ['gambargedung_id', 'nama_ruangan', 'area'];

    public function gambargedung()
    {
        return $this->belongsTo(Gambargedung::class);
    }
    public function apars()
    {
        return $this->hasMany(Apar::class);
    }
}