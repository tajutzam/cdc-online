<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TokenMiddleware;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    private UserService $userService;

    public function __construct()
    {
        $this->middleware(TokenMiddleware::class);
        $this->userService = new UserService();
    }

    public function getOneUser(Request $request)
    {
        $token = $request->header('Authorization');
        $data = $this->userService->findUserByToken(Str::after($token, 'Bearer '));
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'fetch success',
            'data' => $data
        ], 200);
    }

    public function findAllUser()
    {
        $data = $this->userService->findAllUser();
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'fetch success',
            'data' => $data
        ], 200);
    }

}