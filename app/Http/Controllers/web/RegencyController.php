<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Imports\RegencyImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RegencyController extends Controller
{
    //

    public function index()
    {

    }


    public function import(Request $request)
    {

        Excel::import(new RegencyImport(), $request->file('excel'));
    }

    public function update()
    {

    }
}
