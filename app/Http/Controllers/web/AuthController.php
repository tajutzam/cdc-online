<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\AuthService;
use App\Services\ProdiAdministratorService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //


    private AdminService $adminService;
    private ProdiAdministratorService $prodiAdministratorService;




    public function __construct()
    {
        $this->adminService = new AdminService();
        $this->prodiAdministratorService = new ProdiAdministratorService();
    }

    public function loginAdmin(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required|max:250',
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];


        $data = $this->validate($request, $rules, $customMessages);
        $isLogin = $this->adminService->login($data['email'], $data['password']);
        if ($isLogin) {
            return redirect('/admin/dashboard');
        }
        return redirect()->back()->withErrors('Gagal Masuk, Periksa kembali email dan password anda');
    }


    public function loginProdi(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|max:250',
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];


        $data = $this->validate($request, $rules, $customMessages);
        return $this->prodiAdministratorService->login($data['email'], $data['password']);
    }
}
