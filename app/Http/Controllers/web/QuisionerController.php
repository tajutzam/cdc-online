<?php

namespace App\Http\Controllers\web;

use App\Exceptions\WebException;
use App\Exports\QuisionerExport;
use App\Http\Controllers\Controller;
use App\Imports\QuisionerImport;
use App\Services\QuisionerService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class QuisionerController extends Controller
{
    //

    private QuisionerService $quisionerService;


    public function __construct()
    {
        $this->quisionerService = new QuisionerService();
    }

    public function index(Request $request)
    {

        $data = $this->quisionerService->findAllQuisionerUser($request->get('tahun'), $request->get('bulan'));
        return view('admin.quisioner.index', ['data' => $data]);
    }


    public function export(Request $request)
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



    public function import(Request $request)
    {
        Excel::import(new QuisionerImport, $request->file('excel'));
        Alert::success('Sukses', "Sukses Mengupdate Data Quisioner");
        return redirect('/admin/quisioner');
    }



    public function detailQuisioner($level, $userId)
    {
        $data = $this->quisionerService->findQuisionerByUser($userId, $level);
        foreach ($data as $key => $value) {
            # code...
            if (sizeof($value['quisioner_level']) == 0) {
                throw new WebException('Ops , data quisioner tidak dimteukan');
            }
        }
        return view('admin.quisioner.detail', ['data' => $data[0]]);
    }
}