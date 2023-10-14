<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class LegalisirController extends Controller
{

    public function index()
    {
        return view('admin.legalisir.legalisir');
    }

}