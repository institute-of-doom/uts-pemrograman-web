<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuMahasiswa extends Model
{
    // Jika nama tabelmu di database bukan 'kartu_mahasiswas', set manual di sini:
    // protected $table = 'nama_tabel_kartu_kamu';

    protected $fillable = ["no_kartu", "mahasiswa_id"];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, "mahasiswa_id");
    }
}
