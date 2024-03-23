<?php

namespace App\Exports;

use App\Exceptions\WebException;
use App\Models\Alumni;
use App\Services\QuisionerService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;


class QuisionerExport implements FromCollection
{



    private QuisionerService $quisionerService;
    private $tahun;
    private $kodeProdi;
    private $type;


    public function __construct($tahun, $kodeProdi = 0,$type)
    {
        $this->quisionerService = new QuisionerService();
        $this->tahun = $tahun;
        $this->kodeProdi = $kodeProdi;
        $this->type = $type;
    }

    public function collection()
    {
        $userQuisioner = $this->quisionerService->exrportToExcel($this->tahun, $this->kodeProdi, $this->type);

        if (sizeof($userQuisioner) == 0) {
            $message = "Ops , quisioner dengan " . $this->tahun . " tidak ditemukan";
            throw new WebException($message);
        }
        return collect($userQuisioner);
    }



    // public function view(): View
    // {

    //     // dd($this->kodeProdi);
    //     $userQuisioner = $this->quisionerService->exrportToExcel($this->tahun, $this->type);

    //     if (sizeof($userQuisioner) == 0) {
    //         $message = "Ops , quisioner dengan " . $this->tahun . " tidak ditemukan";
    //         throw new WebException($message);
    //     }
        
    //     return view('exports.quisioner', [
    //         'data' => $userQuisioner
    //     ]);
    // }

    // public function headings(): array
    // {
    //     return ['NIM'];
    // }
}
