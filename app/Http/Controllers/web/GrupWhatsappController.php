<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GrupWhatsappController extends Controller
{
    //
    public function grupWhatsapp()
    {

        return view('admin.grup-whatsapp');
    }
    //
}
