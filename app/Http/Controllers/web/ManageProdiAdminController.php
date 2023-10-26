<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageProdiAdminController extends Controller
{
    public function manageAdminProdi()
    {
        return view('admin.manage-admin-prodi');
    } //
}