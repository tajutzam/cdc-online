<?php

namespace App\Services;

use App\Models\InformationSubmission;

class InformationSubmissionService
{

    private InformationSubmission $model;

    public function __construct()
    {
        $this->model = new InformationSubmission();
    }


    public function store($request)
    {

        try {
            $this->model->create([
                'bukti' => $request['bukti'],
                'poster' => $request['poster'],
                'title' => $request['title'],
                'mitra_id' => auth('mitra')->user()->id,
                'description' => $request['description'],
                'bank_id' => $request['bank_id'],
                'pay_id' => $request['pay_id']
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            throw new \App\Exceptions\BadRequestException($th->getMessage());
        }
    }


    public function findAll()
    {
        return $this->model->with('pay', 'bank','mitra')->get()->collect()->map(function ($data) {
            $data['bukti'] = url('/') . '/mitra/bukti/' . $data['bukti'];
            $data['poster'] = url('/') . '/mitra/information/' . $data['poster'];
            return $data;
        })->toArray();
    }


}