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

        \App\Models\Mahasiswa::create($validated);

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

        $query = Mahasiswa::with(["jurusan", "kartuMahasiswa", "mataKuliah"]);

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

        $allMataKuliah = \DB::table("mata_kuliahs")->get();

        return view(
            "pages.mahasiswa.detail",
            compact("mahasiswa", "allMataKuliah"),
        );
    }

    public function statistik(): \Illuminate\View\View
    {
        $jurusans = \App\Models\Jurusan::withCount("mahasiswas")->get();

        return view("pages.mahasiswa.statistik", compact("jurusans"));
    }

    public function generateKartu($id): \Illuminate\Http\RedirectResponse
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $tanggalTerbit = now();
        $tanggalBerlaku = now()->addYears(4);

        $mahasiswa->kartuMahasiswa()->create([
            "no_kartu" => "KTM-" . $mahasiswa->nim,
            "tanggal_terbit" => $tanggalTerbit,
            "tanggal_berlaku" => $tanggalBerlaku,
        ]);

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

        $request->validate(
            [
                "matakuliah_id" => [
                    "required",
                    "exists:mata_kuliahs,id",
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

        $mahasiswa->mataKuliah()->attach($request->matakuliah_id, [
            "nilai" => $request->nilai,
        ]);

        return redirect()
            ->route("mahasiswa.detail", $id)
            ->with("success", "Nilai mata kuliah berhasil ditambahkan!");
    }
}
