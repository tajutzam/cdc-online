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

    public function index()
    {
        $data = $this->quisionerService->findAllQuisionerUser();

        return view('admin.quisioner.index', ['data' => $data]);
    }
}