<?php

namespace App\Services;

use App\Exceptions\WebException;
use App\Models\Whatsapps;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;

class WhatshappsService
{


    private Whatsapps $whatsapps;


    public function __construct()
    {
        $this->whatsapps = new Whatsapps();
    }


    public function findAll()
    {
        $data['groups'] = $this->whatsapps->all()->collect()->map(function ($user) {
            return $this->castToResponse($user);
        })->toArray();

        $oneWeekAgo = now()->subWeek();

        $data['countLastWeek'] = $this->whatsapps
            ->whereDate('created_at', '>=', $oneWeekAgo)
            ->count();

        return $data;
    }


    public function save($request, $image)
    {

        $folder = "whatshapps";
        $fileName = time() . '.' . $image->extension();
        $urlResource = $image->move($folder, $fileName);
        Db::beginTransaction();

        $created = $this->whatsapps->create([
            'image' => $fileName,
            'url' => $request['url'],
            'name' => $request['name']
        ]);
        if (isset($created)) {
            DB::commit();
            return;
        }
        throw new WebException('Ops , Gagal Menambahkan Group Whatshapp');
    }

    public function delete($id)
    {
        $whatshaps = $this->whatsapps->where('id', $id)->first();
        if (isset($whatshaps)) {
            $whatshaps->delete();
            return;
        }
        throw new WebException('Ops , Gagal Menghapus Grup group tidak ditemukan');
    }


    public function update($data, $image = null)
    {
        $whatshapp = $this->whatsapps->where('id', $data['id'])->first();
        if (isset($whatshapp)) {
            if (isset($image)) {
                $folder = "whatshapps";
                $fileName = time() . '.' . $image->extension();
                $urlResource = $image->move($folder, $fileName);
                $whatshapp->update([
                    'url' => $data['url'],
                    'image' => $fileName,
                    'name' => $data['name']

                ]);
                return;
            } else {
                $whatshapp->update([
                    'url' => $data['url'],
                    'name' => $data['name']
                ]);
                return;
            }
        }
        throw new WebException('Ops , Group Whatshapp Tidak Ditemukan');
    }


    public function castToResponse($data)
    {
        if (isset($data->image)) {
            $url = url('/') . '/whatshapps/' . $data->image;
        } else {
            $url = null;
        }
        return [
            'id' => $data->id,
            'url' => $data->url,
            'image' => $url,
            'name' => $data->name
        ];
    }
}