<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        $pageTitle = 'Dashboard Akademik';
        
        $courseInfo = [
            'instructor' => 'Amirudin',
            'subject'    => 'Pemrograman Web Lanjut',
            'campus'     => 'STMIK Antar Bangsa',
            'summary'    => 'Eksplorasi arsitektur MVC dan fitur modern Framework Laravel.',
        ];

        $curriculum = collect([
            'Environment Setup & Composer',
            'Advanced Routing & Middleware',
            'Controller Logic & Dependency Injection',
            'Blade Components & Directives',
            'Eloquent ORM & Migrations'
        ]);

        return view('pages.home', compact('pageTitle', 'courseInfo', 'curriculum'));
    }

    public function about(): View
    {
        return view('pages.about', [
            'meta' => (object) [
                'title'   => 'Tentang Aplikasi',
                'name'    => 'LaraLearn Academic',
                'version' => '1.0.0',
                'author'  => 'Web Development Class'
            ]
        ]);
    }

    public function profile(): View
    {
        $user = [
            'name' => 'Haiqal Aly',
            'id_number' => '2410050',
            'email' => '2410050@antarbangsa.ac.id',
            'github' => 'github.com/HalveExample',
            'major' => 'Teknik Informatika',
            'semester' => 4,
            'status' => 'Aktif',
            'avatar_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiWVPFrCTsmAXmispNJpm9PCmkiJhdz_aR6ixbi9pcpLVXuPL_3LaK0To4EMhdPQScgik52ysU6fmkmw5y-zBCfRWGGfmyvvBFyYreF_sfKiVCLw2vJmJBgo1vZ-uvDOM&s=10&ec=121630504'
        ];

        return view('pages.profile', compact('user'));
    }
}
