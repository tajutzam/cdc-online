<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\AuthService;
use App\Services\EmailService;
use App\Services\PasswordResetService;
use App\Services\ProdiAdministratorService;
use App\Services\UserService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    //


    private AdminService $adminService;
    private ProdiAdministratorService $prodiAdministratorService;

    private PasswordResetService $passwordResetService;

    private UserService $userService;
    private EmailService $emailService;




    public function __construct()
    {
        $this->adminService = new AdminService();
        $this->prodiAdministratorService = new ProdiAdministratorService();
        $this->passwordResetService = new PasswordResetService();
        $this->userService = new UserService();
        $this->emailService = new EmailService();
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


    public function recovery($token)
    {
        $resetPassword = $this->passwordResetService->findByToken($token);
        return view('admin.auth.forgotpassword', ['email' => $resetPassword->email, 'token' => $resetPassword->token]);
    }

    public function updatePassword(Request $request, $token)
    {

        $rules = [
            'password' => 'required|max:250',
            'email' => 'required|email'
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $data = $this->validate($request, $rules, $customMessages);
        $updated = $this->userService->updatePassword($data['email'], $data['password']);
        if ($updated) {
            Alert::success("Sukses", "Berhasil Memperbarui Password Silahkan Login");
            $this->passwordResetService->delete($token);
            $user = $this->userService->findByEmail($data['email']);
            $this->emailService->sendEmailSuccessUpdatePassword($user);
        } else {
            Alert::error("Error", "Gagal memperbarui password terjadi kesalahan");
        }
        return redirect("/");
    }
}
