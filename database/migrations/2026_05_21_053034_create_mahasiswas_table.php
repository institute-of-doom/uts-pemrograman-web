<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Buat tabel jurusans dulu
        Schema::create("jurusans", function (Blueprint $table) {
            $table->id();
            $table->string("kode_jurusan")->unique(); // TI, SI, MI
            $table->string("nama_jurusan");
            $table->timestamps();
        });

        // Baru buat tabel mahasiswas yang nempel ke jurusans
        Schema::create("mahasiswas", function (Blueprint $table) {
            $table->id();
            $table->string("nim")->unique();
            $table->string("nama");
            $table->string("email")->unique();
            $table->enum("jenis_kelamin", ["L", "P"]);
            $table->text("alamat");
            $table
                ->foreignId("jurusan_id")
                ->constrained("jurusans")
                ->onDelete("cascade");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("mahasiswas");
        Schema::dropIfExists("jurusans");
    }
};
