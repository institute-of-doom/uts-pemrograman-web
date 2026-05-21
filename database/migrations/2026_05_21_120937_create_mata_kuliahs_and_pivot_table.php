<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Tabel Utama Mata Kuliah
        Schema::create("mata_kuliahs", function (Blueprint $table) {
            $table->id();
            $table->string("kode_matkul")->unique();
            $table->string("nama_matkul");
            $table->timestamps();
        });

        // 2. Tabel Pivot Perantara untuk menghubungkan Mahasiswa, Mata Kuliah, dan Nilai
        Schema::create("mahasiswa_matakuliah", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("mahasiswa_id")
                ->constrained("mahasiswas")
                ->onDelete("cascade");
            $table
                ->foreignId("matakuliah_id")
                ->constrained("mata_kuliahs")
                ->onDelete("cascade");
            $table->string("nilai", 5)->nullable(); // Menyimpan nilai badge (A, B, C, atau angka)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("mahasiswa_matakuliah");
        Schema::dropIfExists("mata_kuliahs");
    }
};
