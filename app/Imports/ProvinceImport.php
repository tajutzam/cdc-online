<?php

namespace App\Imports;

use App\Exceptions\WebException;
use App\Models\Province;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProvinceImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

      
        try {
            // Clear existing data before importing new data
            foreach ($collection as $key => $value) {
                Province::create([
                    'kode_provinsi' => $value[1],
                    'nama_provinsi' => $value[2]
                ]);
            }

        } catch (\Throwable $th) {
          
            throw new WebException($th->getMessage());
        }
    }
    
}
