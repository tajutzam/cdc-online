<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    private NewsService $newsService;

    public function __construct()
    {
        $this->newsService = new NewsService();
    }

    public function index()
    {
        $news = $this->newsService->findLastInserted();
        $news = array_slice($news, 0, 3);
        return view('landing-page.index', ['news' => $news]);
    }


    public function findById($id)
    {
        $data = $this->newsService->findById($id);
        $news = $this->newsService->findLastInserted();
        $news = array_slice($news, 0, 3);
        return view('landing-page.blog-single', ['blog' => $data , 'news' => $news]);
    }
}
