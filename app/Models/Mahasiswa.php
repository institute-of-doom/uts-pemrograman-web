<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        "nim",
        "nama",
        "email",
        "jurusan",
        "jenis_kelamin",
        "alamat",
    ];

    // Relasi ke Kartu Mahasiswa (One to One)
    public function kartuMahasiswa()
    {
        // Sesuaikan 'App\Models\KartuMahasiswa' dengan nama class model kartu kamu
        return $this->hasOne(KartuMahasiswa::class, "mahasiswa_id");
    }

    // Relasi ke Mata Kuliah (Many to Many)
    public function mataKuliah()
    {
        // Sesuaikan 'App\Models\MataKuliah' dengan nama class model mata kuliah kamu
        return $this->belongsToMany(
            MataKuliah::class,
            "mahasiswa_matakuliah",
            "mahasiswa_id",
            "matakuliah_id",
        )->withPivot("nilai"); // Agar nilai di tabel pivot bisa ikut terpanggil
    }
}
