<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\ProdiService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProdiController extends Controller
{


    private ProdiService $prodiService;


    public function __construct()
    {
        $this->prodiService = new ProdiService();
    }

    public function index()
    {


        $data = $this->prodiService->findAllProdi();

        return view('admin.prodi.prodi', [
            'data' => $data
        ]);
    }

    public function addProdi(Request $request)
    {
        $rules = [
            'id' => 'required|numeric|digits:5|numeric|unique:quis_identitas_prodi,id',
            'nama_prodi' => 'required|unique:quis_identitas_prodi,nama_prodi',
        ];


        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $data = $this->validate($request, $rules, $customMessages);

        $response = $this->prodiService->addProdi($data);
        Alert::success('Success', $response['message']);
        return back();

    }

    public function updateProdi(Request $request)
    {
        $rules = [
            'id_update' => 'required',
            'nama_prodi_update' => 'required',
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $data = $this->validate($request, $rules, $customMessages);
        $response = $this->prodiService->updateProdi($data);
        Alert::success('Success', $response['message']);
        return back();


    }

    public function deleteProdi(Request $request)
    {

        $rules = [
            'id_delete' => 'required',
        ];


        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];
        // $data = $this->validate($request, $rules, $customMessages);
     
        $response = $this->prodiService->deleteProdi($request->only('id_delete'));
        Alert::success('Success', $response['message']);
        return back();
    }

}