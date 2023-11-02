<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\WhatshappsService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GrupWhatsappController extends Controller
{



    private WhatshappsService $whatshappsService;

    public function __construct()
    {
        $this->whatshappsService = new WhatshappsService();
    }

    //
    public function grupWhatsapp()
    {
        $data = $this->whatshappsService->findAll();
        return view('admin.grup-whatsapp', ['data' => $data]);
    }


    public function store(Request $request)
    {

        $rules = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|unique:whatsapps,name',
            'url' => 'required|url',
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $data = $this->validate($request, $rules, $customMessages);

        $this->whatshappsService->save($data, $request->file('image'));
        Alert::success("Sukses", "Berhasil Menambahkan Group Whatshapp");
        return back();
    }

    public function delete(Request $request)
    {
        $rules = [
            'id' => 'required',
        ];


        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $data = $this->validate($request, $rules, $customMessages);

        $this->whatshappsService->delete($data['id']);
        Alert::success("Sukses", "Berhasil Menghapus Group Whatshapp");
        return back();
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required',
            'image' => 'image',
            'name' => 'required',
            'url' => 'required|url',
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $data = $this->validate($request, $rules, $customMessages);
        $this->whatshappsService->update($data , $request->file('image'));
        Alert::success("Sukses", "Berhasil Memperbarui Group Whatshapp");
        return back();
       
    }

}
