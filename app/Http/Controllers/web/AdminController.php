<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    private AuthService $authService;

    public function __construct()
    {

    }

    //
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function settingsAdmin()
    {
        return view('admin.settings-admin');
    }

    public function login()
    {
        return view('admin.auth.login');
    }
    public function manageAdmin()
    {
        return view('admin.manage-admin');
    }

    public function logout()
    {

    }

}
