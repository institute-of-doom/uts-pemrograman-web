<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;

Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/about", [HomeController::class, "about"])->name("about");
Route::get("/profile", [HomeController::class, "profile"])->name("profile");
Route::get("/mahasiswa/form", [MahasiswaController::class, "form"])->name(
    "mahasiswa.form",
);
Route::post("/mahasiswa/proses", [MahasiswaController::class, "proses"])->name(
    "mahasiswa.proses",
);
Route::get("/mahasiswa/list", [MahasiswaController::class, "list"])->name(
    "mahasiswa.list",
);
Route::get("/mahasiswa/{id}", [MahasiswaController::class, "detail"])->name(
    "mahasiswa.detail",
);
Route::get("/statistik-jurusan", [
    MahasiswaController::class,
    "statistik",
])->name("mahasiswa.statistik");
Route::post("/mahasiswa/detail/{id}/generate-kartu", [
    App\Http\Controllers\MahasiswaController::class,
    "generateKartu",
])->name("mahasiswa.generate_kartu");
Route::post("/mahasiswa/detail/{id}/add-nilai", [
    App\Http\Controllers\MahasiswaController::class,
    "addNilai",
])->name("mahasiswa.add_nilai");
