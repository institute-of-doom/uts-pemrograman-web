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
                // 1. Ubah "jurusan" menjadi "jurusan_id" agar sinkron dengan file Blade
                "jurusan_id" => "required|exists:jurusans,id",
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

        // 2. Menyimpan data yang sudah tervalidasi (sudah mengandung jurusan_id)
        \App\Models\Mahasiswa::create($validated);

        // 3. Poin 3.4: Redirect ke list mahasiswa dan tampilkan pesan sukses
        return redirect()
            ->route("mahasiswa.list")
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

        // 2.2 & 5.5: Eager loading menggunakan dengan with() ke semua relasi yang diminta soal
        $query = Mahasiswa::with(["jurusan", "kartuMahasiswa", "mataKuliah"]);

        // 2.4 & 5.5: Filter menggunakan kondisional whereHas() menembus ke tabel jurusans
        if ($filterJurusan) {
            $query->whereHas("jurusan", function ($q) use ($filterJurusan) {
                $q->where("kode_jurusan", $filterJurusan);
            });
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

    public function statistik(): \Illuminate\View\View
    {
        // Poin 2: Menggunakan withCount untuk menghitung jumlah mahasiswa per jurusan secara otomatis
        // Laravel akan otomatis menambahkan atribut 'mahasiswas_count' pada tiap objek jurusan
        $jurusans = \App\Models\Jurusan::withCount("mahasiswas")->get();

        return view("pages.mahasiswa.statistik", compact("jurusans"));
    }
}
