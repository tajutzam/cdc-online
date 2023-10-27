<?php

namespace App\Exports;

use App\Models\Alumni;
use App\Services\QuisionerService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;


class QuisionerExport implements FromView
{



    private QuisionerService $quisionerService;


    public function __construct()
    {
        $this->quisionerService = new QuisionerService();
    }



    public function view() :View
    {

        $userQuisioner = $this->quisionerService->findAllQuisionerUser();

     

        return view('exports.quisioner', [
            'data' => $userQuisioner
        ]);
    }

    public function headings(): array
    {
        return ['NIM'];
    }
}
