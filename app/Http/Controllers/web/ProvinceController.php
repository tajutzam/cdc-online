<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Imports\ProvinceImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProvinceController extends Controller
{
    //


    public function index()
    {

    }


    public function import(Request $request)
    {

        Excel::import(new ProvinceImport(), $request->file('excel'));
    }

    public function update()
    {

    }


}
