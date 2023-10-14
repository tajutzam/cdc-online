<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class UserController extends Controller
{


    public function index()
    {
        return view('admin.alumni.alumni');
    }
}