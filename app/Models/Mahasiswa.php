<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(["nim", "nama", "email", "jurusan", "jenis_kelamin", "alamat"])]
class Mahasiswa extends Model
{
    use HasFactory;
}
