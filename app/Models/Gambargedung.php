<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambargedung extends Model
{
    use HasFactory;

    protected $fillable = ['image_gedung'];

    public function gedungs()
    {
        return $this->hasMany(Gedung::class);
    }
}
