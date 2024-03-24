<?php

namespace App\Imports;

use App\Exceptions\WebException;
use App\Models\Regency;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RegencyImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
        try {
            // Clear existing data before importing new data
            foreach ($collection as $key => $value) {
                Regency::create([
                    'kode_kabupaten' => $value[1],
                    'nama_kabupaten' => $value[2]
                ]);
            }

        } catch (\Throwable $th) {
            throw new WebException($th->getMessage());
        }
    }
}
