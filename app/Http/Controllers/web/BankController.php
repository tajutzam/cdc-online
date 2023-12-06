<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\BankService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BankController extends Controller
{

    private BankService $bankService;

    public function __construct()
    {
        $this->bankService = new BankService();
    }

    public function adminBank()
    {
        $data = $this->bankService->findAll();
        return view('admin.rekening', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'va_number' => 'required|unique:banks,va_number',
            'bank' => 'required',
            'nominal' => 'required'
        ], [
            'va_number.required' => 'nomor rekening tidak boleh kosong',
            'bank.required' => 'Tipe bank tidak boleh kosong',
            'nominal' => 'Nominal tidak boleh kosong'
        ]);

        $this->bankService->store($request->all());
        Alert::success("Sukses", "Berhasil Menambahkan Nomor Rekening Pembayaran");
        return back();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'va_number' => 'required',
            'bank' => 'required',
            'nominal' => 'required'
        ], [
            'va_number.required' => 'nomor rekening tidak boleh kosong',
            'bank.required' => 'Tipe bank tidak boleh kosong',
            'nominal' => 'Nominal tidak boleh kosong'
        ]);

        $data = $request->all();
        unset($data['id']);
        $this->bankService->update($request->input('id'), $data);
        Alert::success("Sukses", "Berhasil Memperbarui Nomor Rekening Pembayaran");
        return back();
    }
    //
}
