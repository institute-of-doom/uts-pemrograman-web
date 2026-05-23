<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuMahasiswa extends Model
{
    protected $fillable = ["no_kartu", "mahasiswa_id"];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, "mahasiswa_id");
    }
}
