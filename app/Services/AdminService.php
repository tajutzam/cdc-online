<?php

namespace App\Services;

use App\Exceptions\WebException;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function register($request)
    {
        DB::beginTransaction();
        try {
            $created = $this->admin->create([
                'email' => $request['email'],
                'name' => $request['name'],
                'alamat' => $request['alamat'],
                'npwp' => $request['npwp'],
                'role' => 'admin',
                'password' => Hash::make($request['password'])
            ]);
            if (isset($created)) {
                Db::commit();
                return true;
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }


    public function delete($id)
    {
        $admin = $this->admin->where('id', $id)->first();
        if (isset($admin)) {
            $admin->delete();
            return true;
        } else {
            return false;
        }
    }


    public function findAllAdminWithoutAdminLogin($id)
    {
        return $this->admin->where('id', '<>', $id)->get()->toArray();
    }

}