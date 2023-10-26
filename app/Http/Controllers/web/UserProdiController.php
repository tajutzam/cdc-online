<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;

class UserProdiController extends Controller
{

    private UserService $userService;


    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index(Request $request)
    {
        $data = $this->userService->findAllByProdi($request->get('active'), \Illuminate\Support\Facades\Auth::guard('prodi')->user()->prodi_id);
        return view('prodi.alumni.alumni', ['data' => $data]);
    }
}
