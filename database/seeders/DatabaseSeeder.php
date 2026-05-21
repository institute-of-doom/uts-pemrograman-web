<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa; // Tambahkan ini
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
        // Seeder bawaan untuk User
        User::factory()->create([
            "name" => "Test User",
            "email" => "test@example.com",
        ]);

        Mahasiswa::create([
            "nim" => "21010123",
            "nama" => "Alex Utama",
            "email" => "alex@mahasiswa.ac.id",
            "jurusan" => "Teknik Informatika",
            "jenis_kelamin" => "L",
            "alamat" => "Jl. Puspa Bangsa No. 12, Jakarta",
        ]);

        Mahasiswa::create([
            "nim" => "21010124",
            "nama" => "Siti Aminah",
            "email" => "siti@mahasiswa.ac.id",
            "jurusan" => "Sistem Informasi",
            "jenis_kelamin" => "P",
            "alamat" => "Jl. Sudirman Kaveling 21, Jakarta",
        ]);
    }
}
