<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminService
{

    private Admin $admin;

    public function __construct()
    {
        $this->admin = new Admin();
    }

    public function login($email, $password)
    {
        $isLogin = Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]);
        return $isLogin;
    }

}