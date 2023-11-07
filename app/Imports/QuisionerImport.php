<?php

namespace App\Imports;

use App\Exceptions\WebException;
use App\Models\User;
use App\Services\QuisionerService;
use App\Services\UserService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use RealRashid\SweetAlert\Facades\Alert;

class QuisionerImport implements ToCollection
{

    private QuisionerService $quisionerService;


    private $kodeProdi;


    public function __construct($kodeProdi = null)
    {
        $this->quisionerService = new QuisionerService();
        $this->kodeProdi = $kodeProdi;
    }

    /**
     * @param Collection $collection
     */


    public function collection(Collection $collection)
    {

        $rules = [
            "No",
            "ID USER",
            "Kode PT",
            "Kode Prodi",
            "NIM",
            "Nama",
            "HP",
            "Tahun Lulus",
            "NPWP",
            "F8",
            "F502",
            "F504",
            "F1101",
            "F5b",
            "F5c",
            "F5d",
            "F18a",
            "F18b",
            "F18c",
            "F18d",
            "F1201",
            "F1202",
            "F14",
            "F15",
            "F301",
            "F302",
            "F303",
            "F401",
            "F402",
            "F403",
            "F404",
            "F405",
            "F406",
            "F407",
            "F408",
            "F409",
            "F410",
            "F411",
            "F412",
            "F413",
            "F414",
            "F415",
            "F6",
            "F7",
            "F7a",
            "F1001",
            "F1002",
            "F1601",
            "F1602",
            "F1603",
            "F1604",
            "F1605",
            "F1606",
            "F1607",
            "F1608",
            "F1609",
            "F1610",
            "F1611",
            "F1612",
            "F1613",
            "F505",
            "F5a1",
            "F5a2",
            "F1761",
            "F1762",
            "F1763",
            "F1764",
            "F1765",
            "F1766",
            "F1767",
            "F1768",
            "F1769",
            "F1770",
            "F1771",
            "F1772",
            "F1773",
            "F1774",
            "F21",
            "F22",
            "F23",
            "F24",
            "F25",
            "F26",
            "F27",
            "Level",
        ];
        //
        $header = $collection->toArray()[0];

        foreach ($rules as $key => $value) {
            # code...
            if ($header[$key] != $value) {
                throw new WebException("Error parsing Code , Check Code on your excel");
            }
        }

        $lowerCaseKey = array_map('strtolower', $rules);


        $data = $collection->toArray();
        array_shift($data);
        $data = array_values($data);
        $newRequest = [];
        foreach ($data as $key => $value) {
            $filteredArray = array_filter($value, function ($key) {
                return $key <= 84;
            }, ARRAY_FILTER_USE_KEY);
            # code...
            if (sizeof($filteredArray) != 85) {
                throw new WebException("Ops , Jumlah Kolom pada baris ke " . ($key + 1) . " Tidak sesuai");
            }
            $tempData = array_combine($lowerCaseKey, $filteredArray);
            array_push($newRequest, $tempData);
        }
        $updated = $this->quisionerService->updateFromExcel($lowerCaseKey, $newRequest, $this->kodeProdi);
    }
}
