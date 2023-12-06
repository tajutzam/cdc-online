<?php

namespace App\Services;

use App\Exceptions\WebException;

use App\Models\AlumniSubmissions;
use App\Models\Mitra;
use App\Models\MitraSubmission;
use Illuminate\Support\Facades\Hash;

class MitraService
{

    private EmailService $emailService;

    public function __construct()
    {
        $this->emailService = new EmailService();
    }

    public function register($request, $bussines_licence, $logo)
    {


        try {
            $folderBussincesLicence = "mitra/bussince_licence";
            $fileNameBussincesLicence = time() . '.' . $bussines_licence->extension();

            $urlResource = $bussines_licence->move($folderBussincesLicence, $fileNameBussincesLicence);

            $folderLogo = "mitra/logo";
            $fileNameLogo = time() . '.' . $logo->extension();
            $urlResource = $logo->move($folderLogo, $fileNameLogo);
            $request['password'] = Hash::make($request['password']);
            //code...
            $request['business_license'] = $fileNameBussincesLicence;
            $request['logo'] = $fileNameLogo;
            MitraSubmission::create($request);
            return;
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }


    public function accept($request)
    {
        try {
            //code...
            $data = (array) $request;

            $this->emailService->sendMailMitra($request->email, true);
            unset($data['id']);
            unset($data['created_at']);
            unset($data['updated_at']);

            Mitra::create($data);
            MitraSubmission::find($request->id)->delete();
            return;
        } catch (\Throwable $th) {
            throw new WebException($th->getMessage());
        }
    }

    public function rejected($request)
    {
        try {
            //code...
            $data = (array) $request;

            $this->emailService->sendMailMitra($request->email, false);
            MitraSubmission::find($request->id)->delete();
            return;
        } catch (\Throwable $th) {
            throw new WebException($th->getMessage());
        }
    }


    public function findAll()
    {
        return MitraSubmission::all();
    }


    public function findAllMitra()
    {
        return Mitra::all();
    }

}