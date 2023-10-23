<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProdiController extends Controller
{
    //
    public function dashboard()
    {
        return view('prodi.dashboard');
    }

    public function settingsAdmin()
    {
        return view('prodi.settings-admin');
    }
}
