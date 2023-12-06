<?php

namespace App\Services;

use App\Exceptions\WebException;
use App\Models\Bank;

class BankService
{




    public function findAll()
    {
        return Bank::all();
    }

    public function store($request)
    {
        Bank::create($request);
    }

    public function update($id, $request)
    {
        $bank = $this->findById($id);
        $allNotId = Bank::where('id', '<>', $id)->get();
        foreach ($allNotId as $key => $value) {
            # code...
            if ($value->va_number == $request['va_number']) {
                throw new WebException("Nomor rekening sudah digunakan");
            }
        }
        $bank->update($request);
    }

    public function findById($id)
    {
        $bank = Bank::find($id);
        if (!isset($bank)) {
            throw new WebException("Bank Tidak Ditemukan");
        }
        return $bank;
    }

    public function delete($id)
    {
        $bank = $this->findById($id);
        $bank->delete();
    }

}