<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Services\QuisionerService;
use App\Http\Controllers\Controller;

class ProdiQuesionerController extends Controller
{
    private QuisionerService $quisionerService;


    public function __construct()
    {
        $this->quisionerService = new QuisionerService();
    }

    public function index()
    {
        $data = $this->quisionerService->findAllQuisionerUser();

        return view('prodi.quesioner.index', ['data' => $data]);
    }   //
}
