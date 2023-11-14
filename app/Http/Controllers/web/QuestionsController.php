<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\QuestionsService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionsController extends Controller
{
    //

    private QuestionsService $questionsService;



    public function __construct()
    {
        $this->questionsService = new QuestionsService();
    }


    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'questions' => 'required',
            'email' => 'required',
            'subjek' => 'required',
            'name' => 'required'
        ];
        $data = $this->validate($request, $rules);
        // dd($data);
        $this->questionsService->store($data);
        Alert::success("Sukses", "Berhasil Mengirimkan Pertanyaan");
        return back();
    }

    public function index()
    {
        $data = $this->questionsService->findAllQuestions();
        return view('admin.feedback', ['data' => $data]);
    }

    public function answer(Request $request, $id)
    {
        $rules = [
            'answer' => 'required'
        ];
        $data = $this->validate($request, $rules);
        $this->questionsService->answer($data, $id);
        Alert::success("Sukses", "Berhasil Menjawab Pertanyaan");
        return back();
    }
}
