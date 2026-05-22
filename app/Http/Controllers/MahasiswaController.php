<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Mahasiswa;
use App\Models\KartuMahasiswa;

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
        $mahasiswa = Mahasiswa::with([
            "jurusan",
            "kartuMahasiswa",
            "mataKuliah",
        ])->findOrFail($id);

        // Ambil langsung dari nama tabel database Anda (mata_kuliahs) untuk menjamin data keluar
        $allMataKuliah = \DB::table("mata_kuliahs")->get();

        return view(
            "pages.mahasiswa.detail",
            compact("mahasiswa", "allMataKuliah"),
        );
    }

    public function statistik(): \Illuminate\View\View
    {
        // Poin 2: Menggunakan withCount untuk menghitung jumlah mahasiswa per jurusan secara otomatis
        // Laravel akan otomatis menambahkan atribut 'mahasiswas_count' pada tiap objek jurusan
        $jurusans = \App\Models\Jurusan::withCount("mahasiswas")->get();

        return view("pages.mahasiswa.statistik", compact("jurusans"));
    }

    public function generateKartu($id): \Illuminate\Http\RedirectResponse
    {
        // Cari data mahasiswa, pastikan datanya ada
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Ambil tanggal hari ini menggunakan penanggalan Carbon bawaan Laravel
        $tanggalTerbit = now(); // Format otomatis YYYY-MM-DD
        $tanggalBerlaku = now()->addYears(4); // Poin 9: Otomatis 4 tahun ke depan

        // Poin 7 & 8: Buat record baru melalui relasi hasOne Eloquent
        $mahasiswa->kartuMahasiswa()->create([
            "no_kartu" => "KTM-" . $mahasiswa->nim, // Poin 8: Format KTM-{NIM}
            "tanggal_terbit" => $tanggalTerbit,
            "tanggal_berlaku" => $tanggalBerlaku,
        ]);

        // Poin 10: Kembali ke halaman detail dengan membawa pesan sukses
        return redirect()
            ->route("mahasiswa.detail", $id)
            ->with(
                "success",
                "Kartu Tanda Mahasiswa (KTM) berhasil digenerate!",
            );
    }

    public function addNilai(
        Request $request,
        $id,
    ): \Illuminate\Http\RedirectResponse {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Poin 12 & 14: Validasi input dan CEGAH DUPLIKASI mata kuliah yang sama untuk mahasiswa yang sama
        $request->validate(
            [
                "matakuliah_id" => [
                    "required",
                    "exists:mata_kuliahs,id",
                    // Aturan kustom untuk mencegah mahasiswa mengambil matkul yang sama dua kali di tabel nilais
                    \Illuminate\Validation\Rule::unique(
                        "nilais",
                        "matakuliah_id",
                    )->where(function ($query) use ($mahasiswa) {
                        return $query->where("mahasiswa_id", $mahasiswa->id);
                    }),
                ],
                "nilai" => "required|string|max:5",
            ],
            [
                "matakuliah_id.unique" =>
                    "Mata kuliah ini sudah diambil oleh mahasiswa yang bersangkutan.",
            ],
        );

        // Poin 13: Simpan data ke tabel nilais menggunakan method attach() milik belongsToMany
        $mahasiswa->mataKuliah()->attach($request->matakuliah_id, [
            "nilai" => $request->nilai,
        ]);

        // Poin 15: Redirect kembali ke halaman detail dengan flash message sukses
        return redirect()
            ->route("mahasiswa.detail", $id)
            ->with("success", "Nilai mata kuliah berhasil ditambahkan!");
    }
}
