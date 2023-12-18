<?php

namespace App\Http\Controllers;

use App\Services\InformationSubmissionService;
use Illuminate\Http\Request;

class InformationSubmissionController extends Controller
{
    //
    private InformationSubmissionService $service;
    public function __construct()
    {
        $this->service = new InformationSubmissionService();
    }

    public function index()
    {
        $data = $this->service->findAll();

        return view('admin.verify-information', compact('data'));
    }

}
