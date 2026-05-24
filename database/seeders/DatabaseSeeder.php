<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jurusan; // Tambahkan import ini
use App\Models\Mahasiswa; // Pastikan ini ada
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ["email" => "test@example.com"],
            [
                "name" => "Test User",
                "password" => bcrypt("password"),
            ],
        );

        // 2. Data master Jurusan
        $ti = Jurusan::firstOrCreate(
            ["kode_jurusan" => "TI"],
            ["nama_jurusan" => "Teknik Informatika"],
        );

        $si = Jurusan::firstOrCreate(
            ["kode_jurusan" => "SI"],
            ["nama_jurusan" => "Sistem Informasi"],
        );

        $mi = Jurusan::firstOrCreate(
            ["kode_jurusan" => "MI"],
            ["nama_jurusan" => "Manajemen Informatika"],
        );

        DB::table("mata_kuliahs")->updateOrInsert(
            ["kode_matkul" => "MK001"],
            ["nama_matkul" => "Pemrograman Web Bergengsi", "sks" => 3],
        );

        DB::table("mata_kuliahs")->updateOrInsert(
            ["kode_matkul" => "MK002"],
            ["nama_matkul" => "Basis Data Lanjutan", "sks" => 4],
        );

        DB::table("mata_kuliahs")->updateOrInsert(
            ["kode_matkul" => "MK003"],
            ["nama_matkul" => "Rekayasa Perangkat Lunak", "sks" => 3],
        );

        DB::table("mata_kuliahs")->updateOrInsert(
            ["kode_matkul" => "MK004"],
            ["nama_matkul" => "Kecerdasan Buatan (AI)", "sks" => 3],
        );

        DB::table("mahasiswas")->updateOrInsert(
            ["nim" => "21010123"],
            [
                "nama" => "Alex Utama",
                "email" => "alex@mahasiswa.ac.id",
                "jurusan_id" => $ti->id,
                "jenis_kelamin" => "L",
                "alamat" => "Jl. Puspa Bangsa No. 12, Jakarta",
            ],
        );

        DB::table("mahasiswas")->updateOrInsert(
            ["nim" => "21010124"],
            [
                "nama" => "Siti Aminah",
                "email" => "siti@mahasiswa.ac.id",
                "jurusan_id" => $si->id,
                "jenis_kelamin" => "P",
                "alamat" => "Jl. Sudirman Kaveling 21, Jakarta",
            ],
        );

        DB::table("mahasiswas")->updateOrInsert(
            ["nim" => "21010125"],
            [
                "nama" => "John Lennon",
                "email" => "john@mahasiswa.ac.id",
                "jurusan_id" => $si->id,
                "jenis_kelamin" => "L",
                "alamat" => "Jl. Abbey, Liverpool",
            ],
        );
    }
}
