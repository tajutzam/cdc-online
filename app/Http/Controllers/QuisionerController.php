<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Http\Middleware\TokenMiddleware;
use App\Services\QuisionerService;
use App\Services\UserService;
use Illuminate\Contracts\Validation\Rule;
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
        $this->validateData($request->all(), [
            "kode_prodi" => 'required',
            "nim" => "required",
            "nama_lengkap" => "required",
            "no_telp" => "required",
            "email" => "required|email",
            "tahun_lulus" => 'required',
            "nik" => "required|digits:16|numeric",
            "npwp" => "required|numeric"
        ]);
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerIdentity($request->all(), $userId);
    }

    public function addQuisionerMain(Request $request)
    {
        $this->validateData($request->all(), [
            'status' => 'required|string',
            'is_less_6_months' => 'required|boolean',
            'pre_grad_employment_months' => 'required|integer',
            'monthly_income' => 'required|numeric',
            'post_grad_months' => 'required|integer',
            'code_province' => 'required|string',
            'code_regency' => 'required|string',
            'agency_type' => 'required|string',
            'company_name' => 'required|string',
            'job_title' => 'required|string|string',
            'work_level' => 'required|string',
        ]);
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerMain($request->all(), $userId);
    }

    public function addQuisionerFurtheStudy(Request $request)
    {
        $this->validateData($request->all(), [
            'study_funding_source' => 'nullable|string',
            'univercity_name' => 'nullable|string',
            'study_program' => 'nullable|string',
            // Ganti sesuai dengan aturan validasi yang sesuai
            'study_start_date' => 'nullable|date',
            'education_funding_source' => 'required|string',
            'financial_source' => 'nullable|string',
            'study_job_relationship' => 'required|string',
            'job_education_level' => 'nullable|string',
        ]);
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerFurtheStudy($request->all(), $userId);
    }

    public function addQuisionerCompetence(Request $request)
    {
        $rule = [
            'Sangat Rendah',
            'Rendah',
            'Netral',
            'Tinggi',
            'Sangat Tinggi'
        ];
        $inRule = implode(',', $rule);

        $this->validateData($request->all(), [
            'etik_lulus' => 'required|in:' . $inRule,
            'etika_saatini' => 'required|in:' . $inRule,
            'keahlian_lulus' => 'required|in:' . $inRule,
            'keahlian_saatini' => 'required|in:' . $inRule,
            'english_lulus' => 'required|in:' . $inRule,
            'english_saatini' => 'required|in:' . $inRule,
            'teknologi_informasi_lulus' => 'required|in:' . $inRule,
            'teknologi_informasi_saatini' => 'required|in:' . $inRule,
            'komunikasi_lulus' => 'required|in:' . $inRule,
            'komunikasi_saatini' => 'required|in:' . $inRule,
            'kerjasama_lulus' => 'required|in:' . $inRule,
            'kerjasama_saatini' => 'required|in:' . $inRule,
            'pengembangan_diri_lulus' => 'required|in:' . $inRule,
            'pengembangan_diri_saatini' => 'required|in:' . $inRule,
        ]);
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerCompetence($request->all(), $userId);
    }

    public function addQuisionerStudyMethod(Request $request)
    {

        $this->validateData($request->all(), [
            'academicStudy' => 'required|string',
            'demonstrasi' => 'required|string',
            'research_participation' => 'required|string',
            'intern' => 'required|string',
            'practice' => 'required|string',
            'field_work' => 'required|string',
            'discucion' => 'required|string',
        ]);

        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerStudyMethod($request->all(), $userId);
    }

    public function addQuisionerJobStreet(Request $request)
    {
        $this->validateData($request->all(), [
            'job_search_start' => 'required|string',
            'before_graduation' => 'required|numeric',
            'after_graduation' => 'required|numeric'
        ]);
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerJobsStreet($request->all(), $userId);
    }


    public function addQuisionerHowFindJobs(Request $request)
    {
        $this->validateData($request->all(), [
            'news_paper' => 'boolean|required',
            'unknown_vacancies' => 'boolean|required',
            'exchange' => 'boolean|required',
            'contacted_company' => 'boolean|required',
            'Kemenakertrans' => 'boolean|required',
            'commercial_swasta' => 'boolean|required',
            'cdc' => 'boolean|required',
            'alumni' => 'boolean|required',
            'network_college' => 'boolean|required',
            'other' => 'boolean|required',
            'relation' => 'boolean|required',
            'self_employed' => 'boolean|required',
            'intern' => 'boolean|required',
            'workplace_during_college' => 'boolean|required',
            'internet' => 'boolean|required',
            'other_job_source' => 'string',
            // Field ini tidak harus boolean, tidak perlu required.
        ]);

        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerHowFindJob($request->all(), $userId);
    }

    public function addQuisionerCompanyApplied(Request $request)
    {
        $this->validateData($request->all(), [
            'job_applications_before_first_job' => 'required|integer',
            'job_applications_responses' => 'required|integer',
            'interview_invitations' => 'required|integer',
            'job_search_recently_active' => 'required|string',
            'job_search_recently_active_other' => 'required|string',
        ]);
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerCompanyApplied($request->all(), $userId);
    }


    public function addQuisionerJobSuitability(Request $request)
    {


        $validations = [
            'job_suitability_not_related' => ['required', 'string'],
            'job_suitability_not_related_2' => ['required', 'string'],
            'job_suitability_reason' => ['required', 'string'],
            'job_suitability_reason_2' => ['required', 'string'],
            'other_reason' => ['required', 'string'],
            'other_reason_2' => ['required', 'string'],
            'other_reason_3' => ['required', 'string'],
            'other_reason_4' => ['required', 'string'],
            'other_reason_5' => ['required', 'string'],
            'other_reason_6' => ['required', 'string'],
            'other_reason_7' => ['required', 'string'],
            'other_reason_8' => ['required', 'string'],
            'other_reason_9' => ['required', 'string'],
            'other_reason_10' => ['required', 'string'],
        ];

        $this->validateData($request->all(), $validations);
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerjobSuitability($request->all(), $userId);
    }


    public function showUpdateQuisionerLevel(Request $request)
    {
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->showUpdateQuisioner($userId);
    }



    private function validateData($request, $rules)
    {
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }
    }
}