<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function setting()
    {
        return view('setting');
    }

    public function profil()
    {
        return view('profil');
    }
}
