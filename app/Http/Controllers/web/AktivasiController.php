<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\AlumniService;
use App\Services\AlumniSubmissionsService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AktivasiController extends Controller
{

    private AlumniSubmissionsService $alumniSubmissionsService;
    private AlumniService $alumniService;



    public function __construct()
    {
        $this->alumniSubmissionsService = new AlumniSubmissionsService();
        $this->alumniService = new AlumniService();
    }

    public function index()
    {
        $data = $this->alumniSubmissionsService->showSubmissions();
        $countPerDay = array_values($this->alumniSubmissionsService->countPerDayOneWeek());
        return view('admin.aktivasi.form-aktivasi-alumni', ['data' => $data , 'countPerDay' => $countPerDay]);
    }

    public function accOrReject(Request $request, $id)
    {
        $case = $request->input('case');
        $response = $this->alumniSubmissionsService->accOrReject($case, $id);
        Alert::success('Success', $response['message']);
        return back();
    }


    public function updateDataReference()
    {
        $response = $this->alumniService->updateDataAlumni();
        if ($response) {
            Alert::success('Success', 'Berhasil memperbarui data alumni referensi');
            return back();
        }
    }
}
