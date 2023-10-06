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
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerMain($request->all(), $userId);
    }

    public function addQuisionerFurtheStudy(Request $request)
    {
        $this->validateData($request->all(), [
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
            'academicStudy' => 'required|in:Sangat Besar,Besar,Cukup Besar,Kurang,Tidak Sama Sekali',
            'demonstrasi' => 'required|in:Sangat Besar,Besar,Cukup Besar,Kurang,Tidak Sama Sekali',
            'research_participation' => 'required|in:Sangat Besar,Besar,Cukup Besar,Kurang,Tidak Sama Sekali',
            'intern' => 'required|in:Sangat Besar,Besar,Cukup Besar,Kurang,Tidak Sama Sekali',
            'practice' => 'required|in:Sangat Besar,Besar,Cukup Besar,Kurang,Tidak Sama Sekali',
            'field_work' => 'required|in:Sangat Besar,Besar,Cukup Besar,Kurang,Tidak Sama Sekali',
            'discucion' => 'required|in:Sangat Besar,Besar,Cukup Besar,Kurang,Tidak Sama Sekali',
        ]);

        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerStudyMethod($request->all(), $userId);
    }

    public function addQuisionerJobStreet(Request $request)
    {
        $this->validateData($request->all(), [
            'job_search_start' => 'required|in:Saya mencari kerja sebelum lulus,Saya mencari kerja sesudah wisuda,Saya tidak mencari kerja',
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
            'job_search_recently_active' => 'required|in:Tidak,Tidak, tapi saya sedang menunggu hasil lamaran kerja,Ya, saya akan mulai bekerja dalam 2 minggu ke depan,Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan,Lainnya',
            'job_search_recently_active_other' => 'required|string',
        ]);
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->quisionerService->addQuisionerCompanyApplied($request->all(), $userId);
    }


    public function addQuisionerJobSuitability(Request $request)
    {


        $validations = [
            'job_suitability_not_related' => ['required', 'in:Tidak sesuai,Pekerjaan saya sekarang sudah sesuai dengan pendidikan saya'],
            'job_suitability_not_related_2' => ['required', 'in:Pekerjaan saya sudah sesuai,Pekerjaan saya sudah sesuai-Saya belum mendapatkan pekerjaan yang lebih sesuai,Saya belum mendapatkan pekerjaan yang lebih sesuai'],
            'job_suitability_reason' => ['required', 'in:Pekerjaan saya sudah sesuai,Di pekerjaan ini saya memeroleh prospek karir yang baik'],
            'job_suitability_reason_2' => ['required', 'in:Pekerjaan saya sudah sesuai,Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya'],
            'other_reason' => ['required', 'in:Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya,Pekerjaan saya sudah sesuai'],
            'other_reason_2' => ['required', 'in:Pekerjaan saya sudah sesuai,Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini'],
            'other_reason_3' => ['required', 'in:Pekerjaan saya sudah sesuai,Pekerjaan saya saat ini lebih aman/terjamin/secure'],
            'other_reason_4' => ['required', 'in:Pekerjaan saya sudah sesuai,Pekerjaan saya saat ini lebih menarik'],
            'other_reason_5' => ['required', 'in:Pekerjaan saya sudah sesuai,Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel dll'],
            'other_reason_6' => ['required', 'in:Pekerjaan saya sudah sesuai,Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya'],
            'other_reason_7' => ['required', 'in:Pekerjaan saya sudah sesuai,Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya'],
            'other_reason_8' => ['required', 'in:Pekerjaan saya sudah sesuai,Pada awal meniti karir ini saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya'],
            'other_reason_9' => ['required', 'in:Pekerjaan saya sudah sesuai,Lainnya'],
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