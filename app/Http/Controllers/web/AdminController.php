<?php

namespace App\Http\Controllers\web;

use App\Exceptions\WebException;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{

    private AuthService $authService;
    private AdminService $adminService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->adminService = new AdminService();
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

        $adminId = Auth::guard('admin')->user()->id;
        $data = $this->adminService->findAllAdminWithoutAdminLogin($adminId);
        return view('admin.manage-admin', ['data' => $data]);
    }



    public function deleteAdmin(Request $request)
    {

        $response = $this->adminService->delete($request->input('id'));
        if ($response) {
            Alert::success('Sukses', 'Berhasil Menghapus Admin');
            return back();
        } else {
            throw new WebException('Ops , gagal menghapus admin , admin tidak ditemukan');
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|max:500',
            'email' => 'required|email|unique:admin,email',
            'npwp' => 'digits:16|required',
            'alamat' => 'required',
            'password' => 'required'
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $data = $this->validate($request, $rules, $customMessages);
        $response = $this->adminService->register($data);
        if ($response) {
            Alert::success('Sukses', 'Berhasil Mendaftarkan Admin Baru');
            return back();
        }
        return back()->withErrors('gagal menambahkan admin');
    }

    public function logout()
    {
        return $this->authService->logoutAdmin();
    }


}
