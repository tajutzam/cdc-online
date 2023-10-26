<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdiAdminController extends Controller
{
    //

    public function index(){
        return view('prodi.index');
    }

    public function login()
    {
        return view('prodi.auth.login');
    }


}
