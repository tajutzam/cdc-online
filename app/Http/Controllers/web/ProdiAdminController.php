<?php

namespace App\Http\Controllers\web;

use App\Exceptions\WebException;
use App\Http\Controllers\Controller;
use App\Models\ProdiAdministrator;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function update(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required | email',
            'npwp' => 'required',
            'address' => 'required'
        ]);
        $id = auth('prodi')->user()->id;

        $prodiAdmin = ProdiAdministrator::find($id);
        $prodiAdmins = ProdiAdministrator::where('email', '<>', $prodiAdmin->email)->get()->toArray();
        foreach ($prodiAdmins as $key => $value) {
            # code...
            if ($request->input('email') == $value['email']) {
                throw new WebException("Email Sudah Digunakan");
            }
        }
        $passwordUpdate = false;
        if ($request->input('password') != null) {
            $passwordUpdate = true;
        }
        if (!$passwordUpdate) {

            ProdiAdministrator::where('id', $id)->update(
                [
                    'name' => $request->input('name'),
                    'nik' => $request->input('npwp'),
                    'address' => $request->input('address'),
                    'email' => $request->input('email')
                ]
            );
            Alert::success("Sukses", "Berhasil Memperbarui Prodi Admin");
            return back();
        } else {
            $id = auth('prodi')->user()->id;
            ProdiAdministrator::where('id', $id)->update(
                [
                    'name' => $request->input('name'),
                    'nik' => $request->input('npwp'),
                    'address' => $request->input('address'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password'))
                ]
            );
            Alert::success("Sukses", "Berhasil Memperbarui Prodi Admin Silahkan Login Ulang");
            auth('prodi')->logout();
            return redirect('prodi/login');
        }
    }


}
