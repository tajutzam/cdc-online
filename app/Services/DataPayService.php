<?php

namespace App\Services;

use App\Exceptions\WebException;
use App\Models\Pay;

class DataPayService
{




    public function findAll()
    {
        return Pay::all();
    }

    public function store($request)
    {
        
        Pay::create($request);
    }

    public function update($id, $request)
    {
        $pay = $this->findById($id);
        $allNotId = Pay::where('id', '<>', $id)->get();
        foreach ($allNotId as $key => $value) {
            # code...
            if ($value->post_package == $request['post_package']) {
                throw new WebException("Nama Paket Sudah Ada");
            }
        }
        $pay->update($request);
    }

    public function findById($id)
    {
        $pay = Pay::find($id);
        if (!isset($pay)) {
            throw new WebException("Paket Tidak Ditemukan");
        }
        return $pay;
    }

    public function delete($id)
    {
        Pay::destroy($id);
    }
}
