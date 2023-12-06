<?php

namespace App\Exports;

use App\Exceptions\WebException;
use App\Models\Alumni;
use App\Services\QuisionerService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;


class QuisionerAkreditasiExport implements FromView
{


    private QuisionerService $quisionerService;
    private $tahun;

    private $kodeProdi;


    public function __construct($tahun, $kodeProdi = null)
    {
        $this->quisionerService = new QuisionerService();
        $this->tahun = $tahun;
        $this->kodeProdi = $kodeProdi;
    }



    public function view(): View
    {

        // dd($this->kodeProdi);
        $userQuisioner = $this->quisionerService->exrportToExcelAkreditasi($this->tahun, $this->kodeProdi);

        if (sizeof($userQuisioner) == 0) {
            $message = "Ops , quisioner dengan " . $this->tahun . " tidak ditemukan";
            throw new WebException($message);
        }

        return view('exports.quisioner-akreditasi', [
            'data' => $userQuisioner
        ]);
    }

    public function headings(): array
    {
        return ['NIM'];
    }
}
