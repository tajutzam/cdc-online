<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Services\QuisionerService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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


    public function exportExcel()
    {

    }


    public function exportPdf()
    {

    }

    public function import()
    {

    }

}
