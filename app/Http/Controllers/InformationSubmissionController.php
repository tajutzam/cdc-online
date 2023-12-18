<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Mitra;
use App\Services\EmailService;
use App\Services\InformationSubmissionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InformationSubmissionController extends Controller
{
    //
    private InformationSubmissionService $service;
    private EmailService $emailService;
    public function __construct()
    {
        $this->service = new InformationSubmissionService();
        $this->emailService = new EmailService();
    }


    public function index() // information verify
    {
        $data = $this->service->findAllWaiting();
        return view('admin.verify-information', compact('data'));
    }


    public function accept(Request $request)
    {
        $data = $request->all();
        $expired = Carbon::now()->addDays($data['pay_day']);
        $data['expired'] = $expired;
        $this->service->updateStatus($data);
        $mitra = Mitra::find($data['mitra_id']);
        $this->emailService->sendMailMitraInformationAccpet($mitra);
        Alert::success("Sukses", "Berhasil Menyetujui Permohonan");
        return back();
    }

    public function reject(Request $request)
    {
        $data = $request->all();
        $expired = null;
        $data['expired'] = $expired;
        $this->service->updateStatus($data);
        $mitra = Mitra::find($data['mitra_id']);
        $this->emailService->sendMailMitraInformationReject($mitra, $data['alasan']);
        Alert::success("Sukses", "Berhasil Menolak Permohonan");
        return back();
    }

    public function findAllAPI()
    {
        $data = $this->service->findAllAPI();
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }


}
