<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        $pageTitle = "Dashboard Akademik";

        $courseInfo = [
            "instructor" => "Amirudin",
            "subject" => "Pemrograman Web Lanjut",
            "campus" => "STMIK Antar Bangsa",
            "summary" =>
                "Eksplorasi arsitektur MVC dan fitur modern Framework Laravel.",
        ];

        $curriculum = collect([
            "Environment Setup & Composer",
            "Advanced Routing & Middleware",
            "Controller Logic & Dependency Injection",
            "Blade Components & Directives",
            "Eloquent ORM & Migrations",
        ]);

        return view(
            "pages.home",
            compact("pageTitle", "courseInfo", "curriculum"),
        );
    }

    public function about(): View
    {
        return view("pages.about", [
            "meta" => (object) [
                "title" => "Tentang Aplikasi",
                "name" => "UTS Pemrograman Web",
                "version" => "1.0.0",
                "author" => "Web Development Class",
            ],
        ]);
    }
}
