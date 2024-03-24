<?php

namespace App\Services;

use App\Exceptions\WebException;
use App\Models\ProdiAdministrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdiAdministratorService
{


    private ProdiAdministrator $prodiAdministrator;

    public function __construct()
    {
        $this->prodiAdministrator = new ProdiAdministrator();
    }

    public function findAllProdiAdministrator()
    {
        return $this->prodiAdministrator->with('prodi')->get()->toArray();
    }

    public function login($email, $password)
    {
        $isLogin = Auth::guard('prodi')->attempt(['email' => $email, 'password' => $password]);
        if ($isLogin) {
            return redirect('prodi/dashboard')->with('success', 'berhasil login');
        }
        throw new WebException('ops , harap check email atau password anda');
    }

    public function registerAdminProdi($request)
    {

        DB::beginTransaction();

        $created = $this->prodiAdministrator->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'nik' => $request['nik'],
            'address' => $request['address'],
            'password' => Hash::make($request['password']),
            'prodi_id' => $request['prodi_id']
        ]);
        if (isset($created)) {
            DB::commit();
            return true;
        }
        throw new WebException('Ops , Terjadi kesalahan saat membuat akun prodi administrator');
    }

    public function delete($id)
    {
        $prodiAdministrator = $this->prodiAdministrator->where('id', $id)->first();
        if (isset($prodiAdministrator)) {
            $prodiAdministrator->delete();
            return true;
        } else {
            return false;
        }
    }

}