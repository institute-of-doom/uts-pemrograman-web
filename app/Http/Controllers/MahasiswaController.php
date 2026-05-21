<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function form(): View
    {
        return view("pages.mahasiswa.form");
    }

    public function proses(Request $request)
    {
        $validated = $request->validate(
            [
                "jurusan" => "required",
                "nim" => "required|numeric|unique:mahasiswas,nim",
                "nama" => "required|string|max:255",
                "email" => "required|email|unique:mahasiswas,email",
                "jenis_kelamin" => "required|in:L,P",
                "alamat" => "required",
            ],
            [
                "nim.unique" => "NIM sudah terdaftar dalam sistem.",
                "email.unique" => "Email sudah digunakan oleh mahasiswa lain.",
            ],
        );

        \App\Models\Mahasiswa::create($validated);

        return redirect()
            ->route("home")
            ->with(
                "success",
                "Data mahasiswa " .
                    $validated["nama"] .
                    " berhasil disimpan ke SQLite!",
            );
    }

    public function list(Request $request)
    {
        $filterJurusan = $request->query("jurusan");

        // Eager loading relasi yang ada
        $query = Mahasiswa::with(["kartuMahasiswa", "mataKuliah"]);

        // Logika filter jurusan
        if ($filterJurusan) {
            if ($filterJurusan == "TI") {
                $query->where("jurusan", "LIKE", "%Teknik Informatika%");
            } elseif ($filterJurusan == "SI") {
                $query->where("jurusan", "LIKE", "%Sistem Informasi%");
            } elseif ($filterJurusan == "MI") {
                $query->where("jurusan", "LIKE", "%Manajemen Informatika%");
            }
        }

        $mahasiswas = $query->get();

        return view("pages.mahasiswa.list", compact("mahasiswas"));
    }

    public function detail($id)
    {
        // Mengambil data mahasiswa beserta kartu dan mata kuliahnya berdasarkan ID
        $mahasiswa = Mahasiswa::with([
            "kartuMahasiswa",
            "mataKuliah",
        ])->findOrFail($id);

        // Mengembalikan ke halaman view detail (kita akan buat view-nya setelah ini)
        return view("pages.mahasiswa.detail", compact("mahasiswa"));
    }
}
