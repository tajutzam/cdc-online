<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function __construct()
    {

    }

    //
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login()
    {
        return view('admin.auth.login');
    }


}