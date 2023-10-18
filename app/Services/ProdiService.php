<?php



namespace App\Services;

use App\Exceptions\WebException;
use App\Helper\ResponseHelper;
use App\Models\QuisionerProdi;
use Illuminate\Support\Facades\DB;

class ProdiService
{


    private QuisionerProdi $prodi;

    public function __construct()
    {
        $this->prodi = new QuisionerProdi();
    }


    public function findAllProdi()
    {
        $data = $this->prodi->all(['nama_prodi', 'id'])->toArray();
        return $data;
    }

    public function addProdi($request)
    {

        DB::beginTransaction();
        $created = $this->prodi->create([
            'id' => $request['id'],
            'nama_prodi' => $request['nama_prodi']
        ]);
        if ($created) {
            DB::commit();
            return [
                'status' => true,
                'data' => $created,
                'message' => 'success membuat prodi'
            ];
        } else {
            DB::rollBack();
            throw new WebException('ops gagal membuat prodi');
        }
    }

    public function updateProdi($request)
    {



        $checked = $this->prodi->where('id', '!=', $request['id_update'])->pluck('nama_prodi');
        foreach ($checked as $key => $value) {
            # code...
            if ($value == $request['nama_prodi_update']) {
                throw new WebException('ops nama prodi sudah digunakan');
            }
        }
        $prodi = $this->prodi->where('id', $request['id_update'])->first();
        if (isset($prodi)) {

            $prodi->update([
                'nama_prodi' => $request['nama_prodi_update']
            ]);
            return [
                'status' => true,
                'message' => 'success memperbarui data',
                'code' => 200
            ];
        }
        throw new WebException('ops , kode prodi kamu tidak ditemukan');
    }




    public function deleteProdi($id)
    {
        try {
            $this->prodi->where('id', $id)->delete();
            return [
                'status' => 200,
                'message' => 'berhasil menghapus prodi',
                'data' => 1
            ];
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }


}