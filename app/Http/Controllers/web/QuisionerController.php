<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\QuisionerService;
use Illuminate\Http\Request;

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
        
        $data = $this->quisionerService->findAllQuisionerUser($request->get('tahun') , $request->get('bulan'));
        $quisionerFilled = 0;
        $quisionerBlank = 0;
        foreach ($data as $key => $value) {
            # code...
            if ($value['account_status']) {
                $quisionerFilled++;
            } else {
                $quisionerBlank++;
            }
        }

        return view('admin.quisioner.index', ['data' => $data, 'filled' => $quisionerFilled, 'blank' => $quisionerBlank]);
    }
}