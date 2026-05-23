<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = ["kode_matkul", "nama_matkul", "sks"];

    public function mahasiswas()
    {
        return $this->belongsToMany(
            Mahasiswa::class,
            "nilais",
            "matakuliah_id",
            "mahasiswa_id",
        )
            ->withPivot("nilai")
            ->withTimestamps();
    }
}
