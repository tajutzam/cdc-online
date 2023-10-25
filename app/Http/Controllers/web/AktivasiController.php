<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\AlumniSubmissionsService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AktivasiController extends Controller
{

    private AlumniSubmissionsService $alumniSubmissionsService;



    public function __construct()
    {
        $this->alumniSubmissionsService = new AlumniSubmissionsService();
    }

    public function index()
    {
        $data = $this->alumniSubmissionsService->showSubmissions();
        return view('admin.aktivasi.form-aktivasi-alumni', ['data' => $data]);
    }

    public function accOrReject(Request $request, $id)
    {
        $case = $request->input('case');
        $response = $this->alumniSubmissionsService->accOrReject($case, $id);
        Alert::success('Success', $response['message']);
        return back();
    }
}
