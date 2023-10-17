<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Services\ProdiService;
use Illuminate\Http\Request;

class StudyProgramPublicController extends Controller
{
    //

    private ProdiService $prodiService;

    public function __construct()
    {
        $this->prodiService = new ProdiService();
    }

    public function findAll()
    {
        $data = $this->prodiService->findAllProdi();
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }
}