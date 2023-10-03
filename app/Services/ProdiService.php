<?php



namespace App\Services;

use App\Models\QuisionerProdi;

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
        return response()->json([
            'status' => true,
            'data' => $data,
            'code' => 200,
            'message' => 'Success fetch data'
        ], 200);
    }

}