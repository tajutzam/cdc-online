<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TokenMiddleware;
use App\Services\QuisionerService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class QuisionerController extends Controller
{
    //

    private QuisionerService $quisionerService;

    private UserService $userService;


    public function __construct()
    {
        $this->quisionerService = new QuisionerService();
        $this->userService = new UserService();
        $this->middleware([TokenMiddleware::class]);
    }


    public function addQuisionerIdentity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kode_prodi" => 'required',
            "nim" => "required",
            "nama_lengkap" => "required",
            "no_telp" => "required",
            "email" => "required|email",
            "tahun_lulus" => 'required',
            "nik" => "required|digits:16|numeric",
            "npwp" => "required|numeric"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'code' => 400,
                'data' => null
            ], 400);
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerIdentity($request->all(), $userId);
    }

    public function addQuisionerMain(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Bekerja (full time/part time),Belum memungkinkan bekerja,Wiraswasta,Melanjutkan Pendidikan,Tidak kerja tetapi sedang mencari kerja',
            'is_less_6_months' => 'required|boolean',
            'pre_grad_employment_months' => 'required|integer',
            'monthly_income' => 'required|numeric',
            'post_grad_months' => 'required|integer',
            'code_province' => 'required|string',
            'code_regency' => 'required|string',
            'agency_type' => 'required|string',
            'company_name' => 'required|string',
            'job_title' => 'required|string|in:Founder,Co-Founder,Staff,Freelance/Kerja Lepas',
            'work_level' => 'required|in:Lokal/wilayah/wiraswasta tidak berbadan hukum',
            'Nasional/wiraswasta berbadan hukum',
            'Multinasional/Internasional',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'code' => 400,
                'data' => null
            ], 400);
        }

        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerMain($request->all(), $userId);
    }

    public function addQuisionerFurtheStudy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'study_funding_source' => 'nullable|in:Biaya Sendiri,Bea Siswa',
            'univercity_name' => 'nullable|string',
            'study_program' => 'nullable|string',
            // Ganti sesuai dengan aturan validasi yang sesuai
            'study_start_date' => 'nullable|date',
            'education_funding_source' => 'required|string',
            'financial_source' => 'nullable|string',
            'study_job_relationship' => 'required|in:Sangat Erat,Erat,Cukup Erat,Kurang Erat,Tidak sama sekali',
            'job_education_level' => 'nullable|in:Setingkat lebih tinggi,Tingkat yang sama,Setingkat lebih rendah,Tidak perlu pendidikan tinggi',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'code' => 400,
                'data' => null
            ], 400);
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerFurtheStudy($request->all(), $userId);
    }



    public function showUpdateQuisionerLevel(Request $request)
    {
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->showUpdateQuisioner($userId);
    }
}