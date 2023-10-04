<?php

namespace Database\Seeders;

use App\Models\Regency;
use Illuminate\Database\Seeder;

class RegencySeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $jsonData = file_get_contents(storage_path('app/json/regency.json'));
        // $regency = json_decode($jsonData);
        // foreach ($regency as $key => $value) {
        //     # code...
        //     dd($value);
        //     Regency::create([
        //         'id' => $value['kode_kab_kota'],
        //         'regency_name' => $value['kabupaten_kota']
        //     ]);
        // }
    }
}