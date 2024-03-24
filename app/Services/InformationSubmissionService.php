<?php

namespace App\Services;

use App\Exceptions\WebException;
use App\Models\InformationSubmission;
use Carbon\Carbon;

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


    public function findAllWaiting()
    {
        return $this->model->with('pay', 'bank', 'mitra')->where('status', 'waiting')->get()->collect()->map(function ($data) {
            $data['bukti'] = url('/') . '/mitra/bukti/' . $data['bukti'];
            $data['poster'] = url('/') . '/mitra/information/' . $data['poster'];
            return $data;
        })->toArray();
    }

    public function findAllVerifiedNotExpired()
    {
        return $this->model
            ->with('pay', 'bank', 'mitra')
            ->where('status', 'verified')
            ->whereDate('expired', '>', now())
            ->get()
            ->collect()
            ->map(function ($data) {
                $data['bukti'] = url('/') . '/mitra/bukti/' . $data['bukti'];
                $data['poster'] = url('/') . '/mitra/information/' . $data['poster'];
                return $data;
            })
            ->toArray();

    }

    public function findAll($idMitra)
    {
        return $this->model->with('pay', 'bank', 'mitra')->where('mitra_id' , $idMitra)->get()->collect()->map(function ($data) {
            $data['bukti'] = url('/') . '/mitra/bukti/' . $data['bukti'];
            $data['poster'] = url('/') . '/mitra/information/' . $data['poster'];
            return $data;
        })->toArray();
    }

    public function updateStatus($request)
    {
        $model = $this->model->where('id', $request['id'])->first();
        if (!isset($model)) {
            throw new WebException('ops information tidak ditemukan');
        }
        try {
            //code..
            $model->update([
                'status' => $request['status'],
                'expired' => $request['expired']
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }

    public function findAllAPI()
    {
        return $this->model->with('mitra')->where('expired', '>', Carbon::now())->where('status', 'verified')->get()->collect()->map(function ($data) {
            $data['poster'] = url('/') . '/mitra/information/' . $data['poster'];
            $data['mitra']['logo'] = url('/') . "/mitra/logo/" . $data['mitra']['logo'];
            return $data;
        })->toArray();
    }
}