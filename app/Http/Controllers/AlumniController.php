<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Helper\ResponseHelper;
use App\Services\AlumniService;
use App\Services\AlumniSubmissionsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    //

    private AlumniService $alumniService;
    private AlumniSubmissionsService $alumniSubmissionsService;

    public function __construct()
    {
        $this->alumniService = new AlumniService();
        $this->alumniSubmissionsService = new AlumniSubmissionsService();
    }

    public function findAllReferenceAlumni()
    {

        $data = $this->alumniService->findAllAlumni();

        $countPerDay = $this->alumniService->getCountPerDay();

        $values = array_values($countPerDay);

        $totalAddition = $this->alumniService->getTotalAdditionOneWeek();
        return view('admin.alumni.reference-alumni', ['data' => $data, 'added_one_week' => $totalAddition, 'count_per_day' => $values]);
    }

    public function verifikasiAlumni(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required'
        ]);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }
        $response = $this->alumniService->verifikasiNimOrEmail($request->all());
        return ResponseHelper::successResponse($response['message'], $response['data'], $response['code']);
    }



    public function submissions(Request $request)
    {
        $validator = Validator::make($request->all(), $rules = [
            'alamat_domisili' => 'required|string',
            'angkatan' => 'required|numeric',
            'email' => 'required|email|unique:alumni_submissions,email',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'jurusan' => 'required|string',
            'nama_lengkap' => 'required|string',
            'nim' => 'required|string|unique:alumni_submissions,nim',
            'no_telp' => 'required|string',
            'program_studi' => 'required|string',
            'tahun_lulus' => 'required|numeric',
            'tanggal_lahir' => 'required|date|date_format:Y-m-d',
            'tempat_lahir' => 'required|string',
            // Aturan khusus untuk file Ijazah (contoh: max:10240 untuk file berukuran maksimal 10MB)
            'ijazah' => 'required|file|mimes:pdf|max:1024',
        ]);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }


        $response = $this->alumniSubmissionsService->submit($request->all(), $request->file('ijazah'));
        return ResponseHelper::successResponse($response['message'], $response['data'], $response['code']);
    }


    public function findAllSubmissions()
    {
        $data = $this->alumniSubmissionsService->showSubmissions();
        return view('');
    }

    public function accOrReject(Request $request)
    {
        return $this->alumniSubmissionsService->accOrReject($request->input('case'), $request->all());
    }

}
