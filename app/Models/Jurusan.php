<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = ["kode_jurusan", "nama_jurusan"];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, "jurusan_id");
    }
}
