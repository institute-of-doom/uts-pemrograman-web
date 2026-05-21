<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabel Utama Mata Kuliah
        Schema::create("mata_kuliahs", function (Blueprint $table) {
            $table->id();
            $table->string("kode_matkul")->unique();
            $table->string("nama_matkul");
            $table->integer("sks")->default(3);
            $table->timestamps();
        });

        // Poin 5.3 & 5.4: Tabel Pivot bernama 'nilais'
        Schema::create("nilais", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("mahasiswa_id")
                ->constrained("mahasiswas")
                ->onDelete("cascade");
            $table
                ->foreignId("matakuliah_id")
                ->constrained("mata_kuliahs")
                ->onDelete("cascade");
            $table->string("nilai", 5)->nullable(); // Kolom pivot nilai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("nilais");
        Schema::dropIfExists("mata_kuliahs");
    }
};
