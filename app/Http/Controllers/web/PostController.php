<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    private PostService $postService;


    public function __construct()
    {
        $this->postService = new PostService();
    }

    
    public function index()
    {
        $data = $this->postService->findAllPostFromAdmin();
        return view('admin.post.post', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $rules = [
            'description' => 'required',
            'position' => 'required|max:250',
            'company' => 'required|max:250',
            'link_apply' => 'required|url',
            'expired' => 'required',
            'image' => 'required|max:1024',
            'type_jobs' => 'required|in:Purnawaktu,Paruh Waktu,Wiraswasta,Pekerja Lepas,Kontrak,Musiman'
        ];


        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];



        $data = $this->validate($request, $rules, $customMessages);
        $isCanComment = false;
        if (isset($data['can_comment'])) {
            $isCanComment = true;
        }

        $adminId = $this->checkLogin();
        $data = $this->postService->addPostJobAdmin($request->file('image'), $adminId, $request->all(), $isCanComment);
        if ($data['status']) {
            return back()->with('success', $data['message']);
        }
        return back()->withErrors($data['message']);
    }


    private function checkLogin()
    {
        if (Auth::guard('admin')->check()) {
            return Auth::guard('admin')->user()->id;
        }
        return redirect('admin/login')->withErrors('ops sesi login kamu sudah habis');
    }

    private function getDataFromJson($data): array
    {
        return $data->getData(true)['data'];
    }
}