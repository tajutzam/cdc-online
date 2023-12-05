<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Imports\RegencyImport;
use App\Models\Regency;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class RegencyController extends Controller
{
    //

    public function index()
    {
        $data = Regency::all();
        return view('admin.place.kabupaten' , ['data' => $data]);
    }


    public function import(Request $request)
    {

        Regency::query()->delete();
        Excel::import(new RegencyImport(), $request->file('excel'));
        Alert::success("Sukses", "Berhasil Mereplace Data Kabupaten");
        return back();
    }

    public function update()
    {

    }
}
