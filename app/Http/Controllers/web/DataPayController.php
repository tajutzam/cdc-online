<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\DataPayService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataPayController extends Controller
{

    private DataPayService $payService;

    public function __construct()
    {
        $this->payService = new DataPayService();
    }

    public function adminDataPay()
    {
        $data = $this->payService->findAll();
        return view('admin.nominalpay', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'post_package' => 'required|unique:pays,post_package',
            'pay_nominal' => 'required',

        ], [
            'post_package.required' => 'Paket Tidak Boleh Kosong',
            'pay_nominal' => 'Nominal tidak boleh kosong'
        ]);

        $this->payService->store($request->all());
        Alert::success("Sukses", "Berhasil Menambahkan Paket Postingan");
        return back();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'post_package' => 'required',
            'pay_nominal' => 'required',

        ], [
            'post_package.required' => 'Paket tidak boleh kosong',
            'pay_nominal.required' => 'Nominal tidak Boleh Kosong tidak boleh kosong',
        ]);

        $data = $request->all();
        unset($data['id']);
        $this->payService->update($request->input('id'), $data);
        Alert::success("Sukses", "Berhasil Memperbarui Paket Postingan");
        return back();
    }
    //
}
