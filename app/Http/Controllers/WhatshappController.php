<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Middleware\TokenMiddleware;
use App\Services\WhatshappsService;
use Illuminate\Http\Request;

class WhatshappController extends Controller
{
    //

    private WhatshappsService $whatshappsService;

    public function __construct()
    {
        $this->whatshappsService = new WhatshappsService();
        $this->middleware([TokenMiddleware::class]);
    }


    public function findAll()
    {
        $data = $this->whatshappsService->findAll();
        return ResponseHelper::successResponse("Success fetch data", $data['groups'], 200);
    }

}
