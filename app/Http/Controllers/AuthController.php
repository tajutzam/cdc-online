<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validate([
            'emailOrNik' => 'required|string',
            'password' => 'required|string',
        ], [
            'emailOrNik.required' => 'Email atau NIK harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        return $this->authService->login($request->input('emailOrNik'), $request->input('password'));
    }

    public function register(RegisterRequest $registerRequest)
    {
        
    }

}