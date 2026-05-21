<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create("mahasiswas", function (Blueprint $table) {
            $table->id();
            $table->string("nim")->unique(); // Sesuai ketentuan: NIM unik
            $table->string("nama"); // Sesuai ketentuan: Nama wajib
            $table->string("email")->unique(); // Sesuai ketentuan: Email unik
            $table->string("jurusan"); // Sesuai ketentuan: Jurusan wajib
            $table->enum("jenis_kelamin", ["L", "P"]); // Sesuai ketentuan: L atau P
            $table->text("alamat"); // Sesuai ketentuan: Alamat
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("mahasiswas");
    }
};
