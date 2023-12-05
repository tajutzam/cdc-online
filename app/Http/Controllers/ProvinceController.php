<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    //


    public function findAll()
    {
        $data = Province::all();
        return ResponseHelper::successResponse("success fetch data", $data,200 );
    }

}
