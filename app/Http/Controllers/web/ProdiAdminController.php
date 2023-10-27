<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdiAdminController extends Controller
{
    //


    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function index()
    {
        return view('prodi.index');
    }

    public function login()
    {
        return view('prodi.auth.login');
    }

    public function logout()
    {
        Auth::guard('prodi')->logout();
        return redirect('prodi/login');
    }


}
