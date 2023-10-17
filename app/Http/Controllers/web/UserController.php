<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{


    private UserService $userService;


    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index(Request $request)
    {


        $data = $this->userService->findAll($request->get('active'));
        return view('admin.alumni.alumni', ['data' => $data]);
    }
}
