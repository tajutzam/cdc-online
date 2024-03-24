<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\ProdiAdministratorService;
use App\Services\ProdiService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ManageProdiAdminController extends Controller
{


    private ProdiAdministratorService $prodiAdministratorService;
    private ProdiService $prodiService;


    public function __construct()
    {
        $this->prodiAdministratorService = new ProdiAdministratorService();

        $this->prodiService = new ProdiService();
    }

    public function manageAdminProdi()
    {
        $data = $this->prodiAdministratorService->findAllProdiAdministrator();
        $prodis = $this->prodiService->findAllProdi();
        return view('admin.manage-admin-prodi', ['data' => $data, 'prodis' => $prodis]);
    } //

    public function addNewAdminProdi(Request $request)
    {
        $rules = [
            'prodi_id' => 'required',
            'name' => 'required|max:500',
            'email' => 'required|email|unique:prodi_administrator,email',
            'nik' => 'digits:16|required',
            'address' => 'required',
            'password' => 'required'
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $data = $this->validate($request, $rules, $customMessages);
        $response = $this->prodiAdministratorService->registerAdminProdi($data);
        if ($response) {
            Alert::success("Sukses", "Berhasil Mendaftarkan Admin Prodi");
            return back();
        }
        return back();

    }

    public function delete(Request $request)
    {
        $response = $this->prodiAdministratorService->delete($request->input('id'));
        if ($response) {
            Alert::success("Sukses", "Berhasil Menghapus Admin Prodi");
            return back();
        }
        return back();
    }

}