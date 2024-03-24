<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    //

    public function findAll()
    {
        $data = Regency::all();
        return ResponseHelper::successResponse("success fetch data", $data, 200);
    }

}
