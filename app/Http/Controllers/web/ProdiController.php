<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class ProdiController extends Controller
{
    public function index()
    {
        return view('admin.prodi.prodi');
    }
}