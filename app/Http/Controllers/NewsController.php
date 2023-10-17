<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Middleware\TokenMiddleware;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //


    private NewsService $newsService;

    public function __construct()
    {

        $this->newsService = new NewsService();
        $this->middleware(TokenMiddleware::class);

    }


    public function findAllActive()
    {
        $data = $this->newsService->findAllActive();
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }

    public function findById($id)
    {
        $data = $this->newsService->findById($id);
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }

}