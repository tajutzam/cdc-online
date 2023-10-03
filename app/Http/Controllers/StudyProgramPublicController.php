<?php

namespace App\Http\Controllers;

use App\Services\ProdiService;
use Illuminate\Http\Request;

class StudyProgramPublicController extends Controller
{
    //

    private ProdiService $prodiService;

    public function __construct() {
        $this->prodiService = new ProdiService();
    }

    public function findAll(){
        return $this->prodiService->findAllProdi();
    }   
}
