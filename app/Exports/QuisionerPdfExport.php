<?php

namespace App\Exports;

use App\Exceptions\WebException;
use App\Services\QuisionerService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class QuisionerPdfExport implements FromView
{

    private QuisionerService $quisionerService;
    private $tahun;


    public function __construct($tahun)
    {
        $this->quisionerService = new QuisionerService();
        $this->tahun = $tahun;
    }

    public function landscape()
    {
        return true; // Set PDF orientation to landscape
    }


    public function view(): View
    {

        $userQuisioner = $this->quisionerService->exrportToExcel($this->tahun);


        if (sizeof($userQuisioner) == 0) {
            $message = "Ops , quisioner dengan " . $this->tahun . " tidak ditemukan";
            throw new WebException($message);
        }

        return view('exports.quisioner-pdf', [
            'data' => $userQuisioner
        ]);
    }

    public function headings(): array
    {
        return ['NIM'];
    }
}
