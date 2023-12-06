<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\MitraService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MitraSubmissiosController extends Controller
{
    //

    private MitraService $service;

    public function __construct()
    {
        $this->service = new MitraService();
    }

    public function index()
    {
        $data = $this->service->findAll();
        return view('admin.aktivasi.company', ['data' => $data]);
    }

    public function mitra()
    {
        $data = $this->service->findAllMitra();
        return view('admin.company-data', ['data' => $data]);
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nib' => 'required',
            'business_license' => 'required|max:2048', // 'max' is in kilobytes, so 2048 KB is 2MB
            'logo' => 'required|max:1024', // 'max' is in kilobytes, so 1024 KB is 1MB
            'address' => 'required',
            'email' => 'required|email', // Assuming you want to validate email format
            'password' => 'required',
            'phone' => 'required'
        ], [
            'required' => ':attribute Tidak Boleh Kosong',
            'mimes' => 'Business License harus berupa file PDF',
            'max' => [
                'file' => 'Ukuran file :attribute tidak boleh lebih dari :max kilobytes.',
                'string' => 'Panjang karakter :attribute tidak boleh lebih dari :max.',
            ],
        ]);
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        $this->service->register($data, $request->file('business_license'), $request->file('logo'));
        Alert::success("Sukses", "Berhasil Registrasi Silahkan Menunggu kami memvalidasi data anda");
        return back();

    }


    public function accept(Request $request)
    {
        // dd($request->all());
        $data = json_decode($request->input('data'));

        $this->service->accept($data);

        Alert::success("Sukses", "Berhasil Menerima Mitra");
        return back();
    }

    public function reject(Request $request)
    {
        $data = json_decode($request->input('data'));

        $this->service->rejected($data);

        Alert::success("Sukses", "Berhasil Menolak Mitra");
        return back();
    }

    public function login(Request $request)
    {
        $isLogin = auth('mitra')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);

        return redirect();
    }

}
