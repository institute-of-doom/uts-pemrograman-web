<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        "nim",
        "nama",
        "email",
        "jurusan_id",
        "jenis_kelamin",
        "alamat",
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, "jurusan_id");
    }

    public function kartuMahasiswa()
    {
        return $this->hasOne(KartuMahasiswa::class, "mahasiswa_id");
    }

    public function mataKuliah()
    {
        return $this->belongsToMany(
            MataKuliah::class,
            "nilais",
            "mahasiswa_id",
            "matakuliah_id",
        )
            ->withPivot("nilai")
            ->withTimestamps();
    }
}
