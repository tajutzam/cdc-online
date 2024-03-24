<?php

namespace App\Http\Controllers\web;

use App\Exceptions\WebException;
use App\Exports\QuisionerExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Services\QuisionerService;
use App\Http\Controllers\Controller;
use App\Imports\QuisionerImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

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
            return Excel::download(new QuisionerExport($request->input('tahun'), Auth::guard('prodi')->user()->prodi->id, $request->input('type')), "CDC-Tahun Lulus-" . $request->input('tahun') . "." . $data['format']);
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }


    public function exportPdf(Request $request)
    {
        $rules = [
            'tahun' => 'required',
        ];
        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];
        $data = $this->validate($request, $rules, $customMessages);

        try {
            //code...
            $userQuisioner = $this->quisionerService->exrportToExcel($request->input('tahun'), Auth::guard('prodi')->user()->prodi->id);
            if (sizeof($userQuisioner) === 0) {
                throw new WebException('Ops , Quisioner Dengan Tahun-Level ' . $request->input('tahun') . " tidak ditemukan");
            }
            $pdf = Pdf::loadview('exports.quisioner-pdf', ['data' => $userQuisioner])->setPaper('a3', 'landscape');
            return $pdf->download('rekap_quisioner.pdf');

        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }

    public function import(Request $request)
    {
        // dd(Auth::guard('prodi')->user()->prodi->id);
        Excel::import(new QuisionerImport(Auth::guard('prodi')->user()->prodi->id), $request->file('excel'));
        Alert::success('Sukses', "Sukses Mengupdate Data Quisioner");
        return redirect('/admin/quisioner');
    }

}
