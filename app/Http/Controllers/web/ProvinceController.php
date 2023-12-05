<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Imports\ProvinceImport;
use App\Models\Province;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ProvinceController extends Controller
{
    //


    public function index()
    {

        $data = Province::all();

        return view('admin.place.provinsi', ['data' => $data]);
    }


    public function import(Request $request)
    {

    Province::query()->delete();
        Excel::import(new ProvinceImport(), $request->file('excel'));
        Alert::success("Sukses", "Berhasil Mereplace Data Provinsi");
        return back();
    }

    public function update()
    {

    }


}
