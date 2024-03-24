<?php



namespace App\Services;

use App\Exceptions\WebException;
use App\Models\Questions;
use Symfony\Component\Console\Question\Question;

class QuestionsService
{



    private Questions $questions;


    public function __construct()
    {
        $this->questions = new Questions();
    }


    public function store($request)
    {
        try {
            //code...
            $this->questions->create($request);

        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }



    public function findAllQuestions()
    {
        $data = $this->questions->orderByRaw("CASE WHEN answer IS NULL THEN 0 ELSE 1 END, answer DESC")->get();
        // dd($data);
        return $data;
    }

    public function answer($request, $id)
    {
        try {
            //code...
            $this->questions->where('id', $id)->update($request);

        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }


    public function delete($id){
        $questions= $this->questions->where('id' , $id)->first(); 
        if(!isset($questions)){
            throw new WebException("Ops , Pertanyaan Tidak ditemukan");
        }
        try {
            //code...
            $questions->delete();
            return;
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }

    public function findAllAnsweredQuestions()
    {
        return $this->questions->whereNotNull('answer')->get();
    }

}