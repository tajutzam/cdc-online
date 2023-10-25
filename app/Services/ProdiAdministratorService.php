<?php

namespace App\Services;

use App\Exceptions\WebException;
use App\Models\ProdiAdministrator;
use Illuminate\Support\Facades\Auth;

class ProdiAdministratorService
{


    private ProdiAdministrator $prodiAdministrator;

    public function __construct()
    {
        $this->prodiAdministrator = new ProdiAdministrator();
    }

    public function login($email, $password)
    {
        $isLogin = Auth::guard('prodi')->attempt(['email' => $email, 'password' => $password]);
        if ($isLogin) {
            return redirect('prodi/dashboard')->with('success', 'berhasil login');
        }
        throw new WebException('ops , harap check email atau password anda');
    }

}