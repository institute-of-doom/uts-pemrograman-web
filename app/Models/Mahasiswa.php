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

    // Relasi ke Kartu Mahasiswa (One to One)
    public function kartuMahasiswa()
    {
        // Sesuaikan 'App\Models\KartuMahasiswa' dengan nama class model kartu kamu
        return $this->hasOne(KartuMahasiswa::class, "mahasiswa_id");
    }

    // Relasi ke Mata Kuliah (Many to Many)
    // Di dalam file app/Models/Mahasiswa.php

    public function mataKuliah()
    {
        // Pastikan parameter kedua eksplisit menyebut tabel 'nilais'
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
