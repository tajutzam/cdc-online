<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\NewsService;

class NewsController extends Controller
{

    private NewsService $newsService;


    public function __construct()
    {
        $this->newsService = new NewsService();
    }


    public function index()
    {
        $data = $this->newsService->findAll();
        return view('admin.berita.berita', ['data' => $data]);
    }



}