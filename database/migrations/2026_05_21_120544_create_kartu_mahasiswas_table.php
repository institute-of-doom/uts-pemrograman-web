<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Menggunakan return new class membuat Laravel tidak perlu mencari nama class spesifik
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("kartu_mahasiswas", function (Blueprint $table) {
            $table->id();
            $table->string("no_kartu");
            $table
                ->foreignId("mahasiswa_id")
                ->constrained("mahasiswas")
                ->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("kartu_mahasiswas");
    }
};
