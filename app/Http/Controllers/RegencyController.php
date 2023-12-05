<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    //

    public function findAll()
    {
        $data = Regency::all();
        
    }

}
