<?php

namespace App\Services;

use App\Exceptions\WebException;

use App\Models\AlumniSubmissions;
use App\Models\Mitra;
use App\Models\MitraSubmission;
use Illuminate\Support\Facades\Hash;

class MitraService {

    private EmailService $emailService;

    public function __construct() {
        $this->emailService = new EmailService();
    }

    public function register($request, $bussines_licence, $logo) {


        try {
            $folderBussincesLicence = "mitra/bussince_licence";
            $fileNameBussincesLicence = time().'.'.$bussines_licence->extension();

            $urlResource = $bussines_licence->move($folderBussincesLicence, $fileNameBussincesLicence);

            $folderLogo = "mitra/logo";
            $fileNameLogo = time().'.'.$logo->extension();
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


    public function accept($request) {
        try {
            //code...
            $data = (array)$request;

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

    public function rejected($request) {
        try {
            //code...
            $data = (array)$request;

            $this->emailService->sendMailMitra($request->email, false);
            MitraSubmission::find($request->id)->delete();
            return;
        } catch (\Throwable $th) {
            throw new WebException($th->getMessage());
        }
    }


    public function findAll() {
        return MitraSubmission::all();
    }


    public function findAllMitra() {
        return Mitra::all();
    }

    public function updateAccount($request, $logo, $bussines_licence, $id) {

        $mitra = Mitra::find($id);
        if(!isset($mitra)) {
            throw new WebException("Ops, id tidak ditemukan silahkan login ");
        }
        $this->validate($request, $id);
        try {
            //code...
            if(isset($logo)) {
                $folderLogo = "mitra/logo";
                $fileNameLogo = time().'.'.$logo->extension();

                $oldFileName = $mitra->logo;

                // Delete the old logo file if it exists
                if(!empty($oldFileName)) {
                    $oldFilePath = public_path($folderLogo.'/'.$oldFileName);
                    if(file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $urlResource = $logo->move($folderLogo, $fileNameLogo);
                $mitra->logo = $fileNameLogo;
            }

            if(isset($bussines_licence)) {

                $folderBussincesLicence = "mitra/bussince_licence";
                $fileNameBussincesLicence = time().'.'.$bussines_licence->extension();

                // Get the current business license filename
                $oldFileName = $mitra->business_license;

                // Delete the old business license file if it exists
                if(!empty($oldFileName)) {
                    $oldFilePath = public_path($folderBussincesLicence.'/'.$oldFileName);
                    if(file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
                $urlResource = $bussines_licence->move($folderBussincesLicence, $fileNameBussincesLicence);
                $mitra->business_license = $fileNameBussincesLicence;
            }
            $mitra->name = $request['name'];
            $mitra->email = $request['email'];
            $mitra->address = $request['address'];
            $mitra->nib = $request['nib'];
            $mitra->phone = $request['phone'];
            $mitra->save();
            return;
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException($th->getMessage());
        }
    }

    private function validate($request, $id) {
        $data = Mitra::where('id', '<>', $id)->get();
        foreach($data as $key => $value) {
            # code...
            if($value->email == $request['email']) {
                throw new WebException("email sudah digunakan");
            }

            if($value->nib == $request['nib']) {
                throw new WebException("NIB sudah digunakan");
            }
        }
    }

    public function updatePassword($id, $password) {
        try {
            //code...
            $mitra = Mitra::find($id);
            $mitra->password = Hash::make($password);
            $mitra->save();
        } catch (\Throwable $th) {
            //throw $th;
            throw new WebException();
        }
    }
}