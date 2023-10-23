<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class AktivasiController extends Controller
{

    public function index()
    {
        return view('admin.aktivasi.form-aktivasi-alumni');
    }
}
