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


    public function store($request, $image)
    {
        $buktiPath = 'bukti/';
        try {
            //code...
            $filename = rand(1000000, 99999999) . $image->getClientOriginalExtension();
            $image->move($buktiPath, $filename);
            $this->model->create([
                'poster' => $filename,
                'title' => $request['title'],
                'mitra_id' => auth('mitra')->user()->id,
                'bank_id' => $request['bank'],
                'pay_id' => $request['pay']
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            throw new \App\Exceptions\BadRequestException($th->getMessage());
        }
    }

}