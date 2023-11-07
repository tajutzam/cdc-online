<?php

namespace App\Http\Controllers\web;

use App\Exceptions\WebException;
use App\Exports\QuisionerExport;
use Illuminate\Http\Request;
use App\Services\QuisionerService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProdiQuesionerController extends Controller
{
    private QuisionerService $quisionerService;


    public function __construct()
    {
        $this->quisionerService = new QuisionerService();
    }

    public function index(Request $request)
    {
        $prodiId = Auth::guard('prodi')->user()->prodi_id;

        $data = $this->quisionerService->findAllQuisionerUserStudyProgram($prodiId, $request->get('tahun'), $request->get('bulan'));

        return view('prodi.quesioner.index', ['data' => $data]);
    } //


    public function exportExcel(Request $request)
    {
        $rules = [
            'format' => 'required|in:xlsx,csv',
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];
        $data = $this->validate($request, $rules, $customMessages);
        try {
            //code...
            return Excel::download(new QuisionerExport($request->input('tahun')), "rekap_kuisioner_" . $request->input('tahun') . "." . $data['format']);
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }


    public function exportPdf()
    {

    }

    public function import()
    {

    }

}
