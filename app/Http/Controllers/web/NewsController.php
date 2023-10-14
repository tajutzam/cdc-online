<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{


    public function index()
    {
        return view('admin.berita.berita');
    }

}