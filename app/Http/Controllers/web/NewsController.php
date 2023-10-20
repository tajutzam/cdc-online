<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\NewsService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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


        $tempActive = 0;
        $tempNonActive = 0;


        foreach ($data['data'] as $value) {
            # code...
            if ($value['active'] == true) {
                $tempActive += 1;
            } else {
                $tempNonActive += 1;
            }
        }

        $total = [
            'active' => $tempActive,
            'nonactive' => $tempNonActive
        ];
        return view('admin.berita.berita', [
            'data' => $data,
            'total' => [
                'active' => $total['active'],
                'nonactive' => $total['nonactive'],
                'total' => sizeof($data['data']),
            ]
        ]);
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
            'dimensions' => ':attribute Harus berukuran 16:9'
        ];

        $data = $this->validate($request, $rules, $customMessages);

        $response = $this->newsService->addNews($data, $data['image']);

        Alert::success('Success', $response['message']);
        return back();
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
                'description' => 'required|max:10000',
                'image-update' => 'required|max:1024|mimes:jpeg,png,jpg',
                'id' => 'required'
            ];
        } else {
            $rules = [
                'title' => 'required|max:100',
                'description' => 'required|max:10000',
                'id' => 'required'

            ];
        }
        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];
        $data = $this->validate($request, $rules, $customMessages);
        $data['active'] = $checked;
        $response = $this->newsService->update($data, $image, $data['id']);
        Alert::success('Success', $response['message']);
        return back();
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
