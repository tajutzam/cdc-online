<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AdminService;
use App\Services\AuthService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    private AuthService $authService;
    private AdminService $adminService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->adminService = new AdminService();
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validate($request->rules(), $request->messages());

        return $this->authService->login($request->input('emailOrNik'), $request->input('password'));
    }

    

    public function registerUser(RegisterRequest $request)
    {
        $request->validate($request->rules(), $request->messages());

        $requestData = $request->all();
        $isRegister = $this->authService->registerUser($requestData);
        if ($isRegister) {
            return response()->json(
                [
                    'status' => true,
                    'code' => 201,
                    'message' => 'Berhasil Registrasi silahkan login',
                    'data' => $isRegister
                ],
                201,
                ['Content-type' => 'application/json']
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'code' => 400,
                    'message' => 'Gagal registrasi terjadi kesalahan',
                    'data' => $isRegister
                ],
                400,
                ['Content-type' => 'application/json']
            );
        }
    }


    public function generateTokenApiPolije()
    {
        return $this->authService->generateToken();
    }

    public function updateEmailVerified(Request $request)
    {
        $id = $request->get('id');
        return $this->authService->updateVeriviedEmail($id);
    }


    public function verifikasi(Request $request)
    {

        // $validator = Validator::make(, [
        //     'nim' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     throw new BadRequestException($validator->errors()->first());
        // }

        return $this->authService->verifikasiNim($request->get('nim'));
    }

}