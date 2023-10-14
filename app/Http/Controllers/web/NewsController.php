<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    private NewsService $newsService;


    public function __construct()
    {
        $this->newsService = new NewsService();
    }


    public function index(Request $request)
    {
        $data = $this->newsService->findAll($request->get('page'));
        return view('admin.berita.berita', ['data' => $data]);
    }

    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|max:100',
            'description' => 'required|max:500',
            'image' => 'required|max:1024|mimes:jpeg,png,jpg',
        ];


        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $data = $this->validate($request, $rules, $customMessages);

        return $this->newsService->addNews($data, $data['image']);


    }

    public function update(Request $request)
    {

        $image = $request->file('image-update');
        $checked = false;
        $isChecked = $request->input('active');
        if (isset($isChecked)) {
            $checked = true;
        }
        $rules = [];
        if (isset($image)) {
            $rules = [
                'title' => 'required|max:100',
                'description' => 'required|max:500',
                'image-update' => 'required|max:1024|mimes:jpeg,png,jpg',
                'id' => 'required'
            ];
        } else {
            $rules = [
                'title' => 'required|max:100',
                'description' => 'required|max:500',
                'id' => 'required'

            ];
        }
        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];
        $data = $this->validate($request, $rules, $customMessages);
        $data['active'] = $checked;
        return $this->newsService->update($data, $image, $data['id']);
    }

    public function delete(Request $request)
    {
        $rules = [
            'id' => 'required'
        ];
        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];
        $data = $this->validate($request, $rules, $customMessages);
        return $this->newsService->delete($data['id']);
    }


}