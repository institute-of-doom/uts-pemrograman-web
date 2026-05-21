<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    // Jika nama tabel di database kamu bukan 'mata_kuliahs', set nama tabelnya di sini:
    protected $table = "mata_kuliahs";

    protected $fillable = ["nama_matkul", "kode_matkul"];

    public function mahasiswa()
    {
        return $this->belongsToMany(
            Mahasiswa::class,
            "mahasiswa_matakuliah",
            "matakuliah_id",
            "mahasiswa_id",
        )->withPivot("nilai");
    }
}
