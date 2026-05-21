<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jurusan; // Tambahkan import ini
use App\Models\Mahasiswa; // Pastikan ini ada
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seeder bawaan untuk User
        User::factory()->create([
            "name" => "Test User",
            "email" => "test@example.com",
        ]);

        // 2. Buat data master Jurusan TERLEBIH DAHULU agar ID 1, 2, dan 3 tersedia
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

        // 3. Buat data Mahasiswa dengan menghubungkannya ke jurusan_id (bukan kolom "jurusan")
        Mahasiswa::create([
            "nim" => "21010123",
            "nama" => "Alex Utama",
            "email" => "alex@mahasiswa.ac.id",
            "jurusan_id" => $ti->id, // Menggunakan ID dari variabel jurusan TI di atas
            "jenis_kelamin" => "L",
            "alamat" => "Jl. Puspa Bangsa No. 12, Jakarta",
        ]);

        Mahasiswa::create([
            "nim" => "21010124",
            "nama" => "Siti Aminah",
            "email" => "siti@mahasiswa.ac.id",
            "jurusan_id" => $si->id, // Menggunakan ID dari variabel jurusan SI di atas
            "jenis_kelamin" => "P",
            "alamat" => "Jl. Sudirman Kaveling 21, Jakarta",
        ]);
    }
}
