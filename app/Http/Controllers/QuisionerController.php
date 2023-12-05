<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Helper\ResponseHelper;
use App\Http\Middleware\TokenMiddleware;
use App\Services\QuisionerService;
use App\Services\UserService;
use Exception;
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
            'code_province' => 'required',
            'code_regency' => 'required',
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



    public function updateIdentity(Request $request)
    {
        $this->validateData($request->all(), [
            'id' => 'required',
            "kode_prodi" => 'required',
            "nim" => "required",
            "nama_lengkap" => "required",
            "no_telp" => "required",
            "email" => "required|email",
            "tahun_lulus" => 'required',
            "nik" => "required|digits:16|numeric",
            "npwp" => "required|numeric"
        ]);
        $updated = $this->quisionerService->updateQuisionerIdentity($request->all());
        return ResponseHelper::successResponse("Sukses Memperbarui Data", $updated, 200);
    }

    public function updateMain(Request $request)
    {
        $this->validateData($request->all(), [
            'id' => 'required',
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
        // set to data db
        $request = $request->all();
        $data = [
            'id' => $request['id'],
            'f8' => $request['status'],
            'f504' => $request['is_less_6_months'],
            'f502' => $request['pre_grad_employment_months'],
            'f505' => $request['monthly_income'],
            'f506' => $request['post_grad_months'],
            'f5a1' => $request['code_province'],
            'f5a2' => $request['code_regency'],
            'f1101' => $request['agency_type'],
            'f5b' => $request['company_name'],
            'f5c' => $request['job_title'],
            'f5d' => $request['work_level'],
        ];

        $idQuisioner = $data['id'];
        unset($data['id']);


        //code...
        $updated = $this->quisionerService->updateMain($idQuisioner, $data);
        return ResponseHelper::successResponse("Sukses Update Quisioner", $updated, 200);
    }


    public function updateFurtheStudy(Request $request)
    {
        $this->validateData($request->all(), [
            'id' => 'required',
            'study_funding_source' => 'nullable|string',
            'univercity_name' => 'nullable|string',
            'study_program' => 'nullable|string',
            'study_start_date' => 'nullable|date',
            'education_funding_source' => 'required|string',
            'financial_source' => 'nullable|string',
            'study_job_relationship' => 'required|string',
            'job_education_level' => 'nullable|string',
        ]);
        $request = $request->all();
        $data = [
            'id' => $request['id'],
            'f18a' => $request['study_funding_source'],
            'f18b' => $request['univercity_name'],
            'f18c' => $request['study_program'],
            'f18d' => $request['study_start_date'],
            'f1201' => $request['education_funding_source'],
            'f1202' => $request['financial_source'],
            'f14' => $request['study_job_relationship'],
            'f15' => $request['job_education_level'],
        ];
        $id = $data['id'];
        unset($data['id']);
        $updated = $this->quisionerService->updateFrutheStudy($id, $data);
        return ResponseHelper::successResponse("Sukses Update Quisioner", $updated, 200);
    }


    public function updateCompetence(Request $request)
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
            'id' => 'required',
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

        $request = $request->all();
        $competenceData = [
            'f1761' => $request['etik_lulus'],
            'f1762' => $request['etika_saatini'],
            'f1763' => $request['keahlian_lulus'],
            'f1764' => $request['keahlian_saatini'],
            'f1765' => $request['english_lulus'],
            'f1766' => $request['english_saatini'],
            'f1767' => $request['teknologi_informasi_lulus'],
            'f1768' => $request['teknologi_informasi_saatini'],
            'f1769' => $request['komunikasi_lulus'],
            'f1770' => $request['komunikasi_saatini'],
            'f1771' => $request['kerjasama_lulus'],
            'f1772' => $request['kerjasama_saatini'],
            'f1773' => $request['pengembangan_diri_lulus'],
            'f1774' => $request['pengembangan_diri_saatini'],
            // Ganti dengan ID pengguna yang sesuai
        ];

        $id = $request['id'];
        $updated = $this->quisionerService->updateCompetence($id, $competenceData);
        return ResponseHelper::successResponse("Sukses Update Quisioner", $updated, 200);

    }


    public function updateStudyMethod(Request $request)
    {

        $this->validateData($request->all(), [
            'id' => 'required',
            'academicStudy' => 'required|string',
            'demonstrasi' => 'required|string',
            'research_participation' => 'required|string',
            'intern' => 'required|string',
            'practice' => 'required|string',
            'field_work' => 'required|string',
            'discucion' => 'required|string',
        ]);

        $studyMethodData = [
            'f21' => $request['academicStudy'],
            'f22' => $request['demonstrasi'],
            'f23' => $request['research_participation'],
            'f24' => $request['intern'],
            'f25' => $request['practice'],
            'f26' => $request['field_work'],
            'f27' => $request['discucion'],
        ];

        $id = $request->only('id');
        $updated = $this->quisionerService->updateStudyMethod($id, $studyMethodData);
        return ResponseHelper::successResponse("Sukses Update Quisioner", $updated, 200);
    }

    public function updateJobStreet(Request $request)
    {
        $this->validateData($request->all(), [
            'id' => 'required',
            'job_search_start' => 'required|string',
            'before_graduation' => 'required|numeric',
            'after_graduation' => 'required|numeric'
        ]);

        $request = $request->all();

        $jobsStreetData = [
            'f301' => $request['job_search_start'],
            'f302' => $request['before_graduation'],
            'f303' => $request['after_graduation'],
        ];

        $id = $request['id'];
        $updated = $this->quisionerService->updateJobsStreet($id, $jobsStreetData);
        return ResponseHelper::successResponse("Sukses Update Quisioner", $updated, 200);

    }


    public function updateHowFindJobs(Request $request)
    {
        $this->validateData($request->all(), [
            'id' => 'required',
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
        ]);
        $request = $request->all();
        $howFindJobData = [
            'f401' => $request['news_paper'],
            'f402' => $request['unknown_vacancies'],
            'f403' => $request['exchange'],
            'f405' => $request['contacted_company'],
            'f406' => $request['Kemenakertrans'],
            'f407' => $request['commercial_swasta'],
            'f408' => $request['cdc'],
            'f409' => $request['alumni'],
            'f410' => $request['network_college'],
            'f411' => $request['relation'],
            'f412' => $request['self_employed'],
            'f413' => $request['intern'],
            'f414' => $request['workplace_during_college'],
            'f415' => $request['other'],
            'f416' => $request['other_job_source'],
            'f404' => $request['internet'],
        ];
        $id = $request['id'];
        $updated = $this->quisionerService->updateHowFindJob($id, $howFindJobData);
        return ResponseHelper::successResponse("Sukses Update Quisioner", $updated, 200);
    }


    public function updateCompanyApplied(Request $request)
    {
        $this->validateData($request->all(), [
            'id' => 'required',
            'job_applications_before_first_job' => 'required|integer',
            'job_applications_responses' => 'required|integer',
            'interview_invitations' => 'required|integer',
            'job_search_recently_active' => 'required|string',
            'job_search_recently_active_other' => 'required|string',
        ]);
        $request = $request->all();
        $companyAppliedData = [
            'f6' => $request['job_applications_before_first_job'],
            'f7' => $request['job_applications_responses'],
            'f7a' => $request['interview_invitations'],
            'f1001' => $request['job_search_recently_active'],
            'f1002' => $request['job_search_recently_active_other'],
        ];
        $id = $request['id'];
        $updated = $this->quisionerService->updateCompanyApplied($id, $companyAppliedData);
        return ResponseHelper::successResponse("Sukses Update Quisioner", $updated, 200);
    }

    public function updateJobSuitability(Request $request)
    {
        $validations = [
            "id" => 'required',
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
        $request = $request->all();
        $jobsSuitabilityData = [
            'f1601' => $request['job_suitability_not_related'],
            'f1602' => $request['job_suitability_not_related_2'],
            'f1603' => $request['job_suitability_reason'],
            'f1604' => $request['job_suitability_reason_2'],
            'f1605' => $request['other_reason'],
            'f1606' => $request['other_reason_2'],
            'f1607' => $request['other_reason_3'],
            'f1608' => $request['other_reason_4'],
            'f1609' => $request['other_reason_5'],
            'f1610' => $request['other_reason_6'],
            'f1611' => $request['other_reason_7'],
            'f1612' => $request['other_reason_8'],
            'f1613' => $request['other_reason_9'],
            'f1614' => $request['other_reason_10'],
        ];
        $id = $request['id'];
        $updated = $this->quisionerService->updateJobSuitability($id, $jobsSuitabilityData);
        return ResponseHelper::successResponse("Sukses Update Quisioner", $updated, 200);
    }

    private function validateData($request, $rules)
    {
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }
    }
}