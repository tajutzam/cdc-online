<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use App\Services\PostService;
use App\Services\ProdiService;
use App\Services\QuestionsService;
use App\Services\UserService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    private NewsService $newsService;
    private QuestionsService $questionService;
    private ProdiService $prodiService;
    private PostService $postService;
    private UserService $userService;

    public function __construct()
    {
        $this->newsService = new NewsService();
        $this->questionService = new QuestionsService();
        $this->prodiService = new ProdiService();
        $this->postService = new PostService();
        $this->userService = new UserService();
    }

    public function index()
    {
        $news = $this->newsService->findLastInserted();
        $news = array_slice($news, 0, 3);
        $questions = $this->questionService->findAllAnsweredQuestions()->toArray();
        $prodi = sizeof($this->prodiService->findAllProdi());
        $post = sizeof($this->postService->findHistoryVacancy());
        $work = $this->userService->findAllUserHaveWork();
        $notWork = $this->userService->findAllUserHaveNotWork();
        // dd($first, $second);

        return view('landing-page.index', ['news' => $news, 'questions' => $questions, 'prodi' => $prodi, 'post' => $post, 'user' => $work, 'notWork' => $notWork]);
    }


    public function findById($id)
    {
        $data = $this->newsService->findById($id);
        $news = $this->newsService->findLastInserted();
        $news = array_slice($news, 0, 3);

        return view('landing-page.blog-single', ['blog' => $data, 'news' => $news,]);
    }
}
