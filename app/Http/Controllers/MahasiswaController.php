<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
}
