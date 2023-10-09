<?php


namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\CompanyApplied;
use App\Models\Competence;
use App\Models\FurtheStudy;
use App\Models\HowFindJob;
use App\Models\Identity;
use App\Models\JobSuitability;
use App\Models\MainSection;
use App\Models\QuisionerLevel;
use App\Models\QuisionerProdi;
use App\Models\StartSearchJob;
use App\Models\StudyMethod;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class QuisionerService
{



    private Identity $identity;

    private QuisionerProdi $quisionerProdi;

    private QuisionerLevel $quisionerLevel;

    private MainSection $mainSection;
    private FurtheStudy $furtheStudy;

    private User $user;

    private StudyMethod $studyMethod;

    private Competence $competence;

    private StartSearchJob $startSearchJob;
    private HowFindJob $howFindJob;
    private CompanyApplied $comapnyAppled;
    private JobSuitability $jobSuitability;
    public function __construct()
    {
        $this->identity = new Identity();
        $this->quisionerProdi = new QuisionerProdi();
        $this->quisionerLevel = new QuisionerLevel();
        $this->mainSection = new MainSection();
        $this->furtheStudy = new FurtheStudy();
        $this->user = new User();
        $this->competence = new Competence();
        $this->studyMethod = new StudyMethod();
        $this->startSearchJob = new StartSearchJob();
        $this->howFindJob = new HowFindJob();
        $this->comapnyAppled = new CompanyApplied();
        $this->jobSuitability = new JobSuitability();
    }


    public function addQuisionerIdentity($request, $userId)
    {
        Db::beginTransaction();

        //code...
        $identityQuisioner = $this->identity->where('user_id', $userId)->first();
        $prodi = $this->quisionerProdi->where('id', $request['kode_prodi'])->first();
        if (!isset($prodi)) {
            throw new NotFoundException("ops , nampaknya kode program studi yang kamu pilih tidak ada", 404);
        }

        if (isset($identityQuisioner)) {
            throw new BadRequestException("Ops , kamu sudah mengisi quisioner identitas", 400);
        }
        $isCreated = $this->identity->create([
            'kdptimsmh' => '005019',
            'kdpstmsmh' => $request['kode_prodi'],
            'nimhsmsmh' => $request['nim'],
            'nmmhsmsmh' => $request['nama_lengkap'],
            'telpomsmh' => $request['no_telp'],
            'emailmsmh' => $request['email'],
            'tahun_lulus' => $request['tahun_lulus'],
            'nik' => $request['nik'],
            'npwp' => $request['npwp'],
            'user_id' => $userId
        ]);

        if (isset($isCreated)) {

            $quisionerIsCreated = $this->quisionerLevel->create([
                'identitas_section' => true,
                'user_id' => $userId
            ]);
            if (isset($quisionerIsCreated)) {
                Db::commit();
                $data = $this->quisionerLevel->find($quisionerIsCreated->id);
                return $this->successResponse([
                    'quis_terjawab' => $data
                ], 201, 'Berhasil mengisi quisioner identitas');
            } else {
                throw new Exception("Error Processing Request", 500);
            }
        } else {
            throw new Exception("Gagal mengisi kuisioner", 500);

        }

    }

    public function addQuisionerMain($request, $userId)
    {
        DB::beginTransaction();
        //code...
        $quisionerLevel = $this->findQuisionerLevelByUserId($userId);
        if (isset($quisionerLevel)) {
            $isSetIdentity = $quisionerLevel->identitas_section;
            if ($isSetIdentity) {
                $isAlreadySet = $this->mainSection->where('user_id', $userId)->first();
                if ($isAlreadySet) {
                    throw new BadRequestException('Ops , nampaknya kamu sudah mengisi kuisioner utama', 400);
                }
                $isCreated = $this->mainSection->create([
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
                    'user_id' => $userId
                ]);
                if (isset($isCreated)) {
                    $isUpdate = $quisionerLevel->update([
                        'main_section' => true,
                    ]);
                    if ($isUpdate) {
                        DB::commit();
                        return $this->successResponse(['quis_terjawab' => $isCreated], 201, 'Berhasil mengisi kuisioner');
                    }
                    throw new Exception('Gagal untuk mengisi kuisioner , terjadi keslaahan', 500);
                } else {
                    throw new Exception('Gagal untuk mengisi kuisioner , terjadi keslaahan', 500);
                }
            }
            throw new BadRequestException('Harap isi quisioner sebelumnya', 400);
        }
        throw new NotFoundException("quisioner level not found", 404);
    }


    public function addQuisionerFurtheStudy($request, $userId)
    {

        DB::beginTransaction();
        //code...
        $quisionerLevel = $this->findQuisionerLevelByUserId($userId);
        if (isset($quisionerLevel)) {
            if ($quisionerLevel->furthe_study_section) {
                throw new BadRequestException('Ops , nampaknya kamu sudah mengisi quisioner berikut', 400);
            }
            $isSetMainSection = $this->mainSection->where('user_id', $userId)->first();
            if (isset($isSetMainSection)) {
                $isCreated = $this->furtheStudy->create([
                    'f18a' => $request['study_funding_source'],
                    'f18b' => $request['univercity_name'],
                    'f18c' => $request['study_program'],
                    'f18d' => $request['study_start_date'],
                    'f1201' => $request['education_funding_source'],
                    'f1202' => $request['financial_source'],
                    'f14' => $request['study_job_relationship'],
                    'f15' => $request['job_education_level'],
                    'user_id' => $userId,
                ]);
                $user = $this->user->find($userId);
                if (isset($isCreated)) {
                    $isUpdate = $quisionerLevel->update([
                        'furthe_study_section' => true,
                    ]);
                    if ($isUpdate) {
                        DB::commit();
                        return $this->successResponse(['quis_terjawab' => $isCreated], 201, 'Berhasil mengisi kuisioner');
                    }
                    throw new Exception('Gagal untuk mengisi kuisioner , terjadi keslaahan', 500);
                } else {
                    throw new Exception('Gagal untuk mengisi kuisioner , terjadi keslaahan', 500);
                }
            }
            throw new BadRequestException('Harap isi quisioner sebelumnya terlebih dahulu', 400);
        }
        throw new NotFoundException('qusioner level not found', 404);

    }


    public function addQuisionerCompetence($request, $userId)
    {
        DB::beginTransaction();

        //code...
        $quisionerLevel = $this->findQuisionerLevelByUserId($userId);
        if (!$quisionerLevel->furthe_study_section) {
            throw new BadRequestException('Ops , Nampaknya kamu belum mengisi quisioner sebelumnya', 400);
        }
        if ($quisionerLevel->competent_level_section) {
            throw new BadRequestException('Ops , kamu sudah mengisi quisioner berikut', 400);
        }
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
            'user_id' => $userId,
            // Ganti dengan ID pengguna yang sesuai
        ];
        $created = $this->competence->create($competenceData);
        if (isset($created)) {
            $isUpdate = $quisionerLevel->update([
                'competent_level_section' => true
            ]);
            if ($isUpdate) {
                DB::commit();
                return $this->successResponse(['quis_terjawab' => $created], 201, 'Berhasil mengisi kuisioner');
            }
            throw new NotFoundException('gagal mengisi quisioner , user tidak ditemukan', 404);
        }
        throw new Exception('Ops , gagal ,mengisi kuisioner terjadi kesalahan', 500);

    }


    public function addQuisionerStudyMethod($request, $userId)
    {
        $quisionerLevel = $this->findQuisionerLevelByUserId($userId);
        if (!$quisionerLevel->competent_level_section) {
            throw new BadRequestException('Gagal mengisi kuisioner , kamu belum mengisi quisioner sebelumnya');
        }
        if ($quisionerLevel->study_method_section) {
            throw new BadRequestException('Ops , nampaknya kamu sudah mengisi kuisioner ini');
        }
        DB::beginTransaction();
        $studyMethodData = [
            'f21' => $request['academicStudy'],
            'f22' => $request['demonstrasi'],
            'f23' => $request['research_participation'],
            'f24' => $request['intern'],
            'f25' => $request['practice'],
            'f26' => $request['field_work'],
            'f27' => $request['discucion'],
            'user_id' => $userId
        ];
        $created = $this->studyMethod->create($studyMethodData);
        if (isset($created)) {
            $isUpdate = $quisionerLevel->update([
                'study_method_section' => true
            ]);
            if ($isUpdate) {
                DB::commit();
                return $this->successResponse(['quis_terjawab' => $created], 201, 'Berhasil mengisi kuisioner');
            }
            throw new Exception('Gagal memperbarui kuisioner');
        }
        throw new Exception('Gagal mengisi kuisioner');
    }

    public function addQuisionerJobsStreet($request, $userId)
    {
        $quisionerLevel = $this->findQuisionerLevelByUserId($userId);

        if (!$quisionerLevel->study_method_section) {
            throw new BadRequestException('Gagal mengisi kuisioner , kamu belum mengisi kuisioner sebelumnya');
        }

        if ($quisionerLevel->jobs_street_section) {
            throw new BadRequestException('Ops , nampaknya kamu sudah mengisi kuisioner berikut');
        }
        DB::beginTransaction();
        $jobsStreetData = [
            'f301' => $request['job_search_start'],
            'f302' => $request['before_graduation'],
            'f303' => $request['after_graduation'],
            'user_id' => $userId
        ];
        $created = $this->startSearchJob->create($jobsStreetData);
        $user = $this->user->find($userId);
        if (isset($created)) {
            $isUpdate = $quisionerLevel->update([
                'jobs_street_section' => true
            ]);
            if ($isUpdate) {
                DB::commit();
                return $this->successResponse(['quis_terjawab' => $created], 201, 'Berhasil mengisi kuisioner');
            }
            throw new Exception('Gagal memperbarui kuisioner');
        }
        throw new Exception('Gagal mengisi kuisioner');

    }


    public function addQuisionerHowFindJob($request, $userId)
    {
        $quisionerLevel = $this->findQuisionerLevelByUserId($userId);
        if (!$quisionerLevel->jobs_street_section) {
            throw new BadRequestException('Gagal mengisi kuisioner , kamu belum mengisi kuisioner sebelumnya');
        }
        if ($quisionerLevel->how_find_jobs_section) {
            throw new BadRequestException('Ops , nampaknya kamu sudah mengisi kuisioner ini');
        }

        DB::beginTransaction();
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
            'user_id' => $userId
        ];
        $created = $this->howFindJob->create($howFindJobData);

        if (isset($created)) {
            $isUpdate = $quisionerLevel->update([
                'how_find_jobs_section' => true
            ]);
            if ($isUpdate) {
                DB::commit();
                return $this->successResponse(['quis_terjawab' => $created], 201, 'Berhasil mengisi kuisioner');
            }
            throw new Exception('Gagal memperbarui kuisioner');
        }
        throw new Exception('Ops ,  gagal mengisi kuisioner terjadi kesalahan');

    }

    public function addQuisionerCompanyApplied($request, $userId)
    {
        $quisionerLevel = $this->findQuisionerLevelByUserId($userId);
        if (!$quisionerLevel->how_find_jobs_section) {
            throw new BadRequestException('Gagal mengisi kuisioner , kamu belum mengisi kuisioner sebelumnya');
        }
        if ($quisionerLevel->company_applied_section) {
            throw new BadRequestException('Ops , nampaknya kamu sudah mengisi kuisioner ini');
        }
        DB::beginTransaction();
        $comapnyAppliedData = [
            'f6' => $request['job_applications_before_first_job'],
            'f7' => $request['job_applications_responses'],
            'f7a' => $request['interview_invitations'],
            'f1001' => $request['job_search_recently_active'],
            'f1002' => $request['job_search_recently_active_other'],
            'user_id' => $userId
        ];
        $created = $this->comapnyAppled->create($comapnyAppliedData);
        if (isset($created)) {
            $isUpdate = $quisionerLevel->update([
                'company_applied_section' => true
            ]);
            if ($isUpdate) {
                DB::commit();
                return $this->successResponse(['quis_terjawab' => $created], 201, 'Berhasil mengisi kuisioner');
            }
            throw new Exception('Gagal memperbarui kuisioner');
        }
        throw new Exception('Ops ,  gagal mengisi kuisioner terjadi kesalahan');
    }

    public function addQuisionerjobSuitability($request, $userId)
    {
        $quisionerLevel = $this->findQuisionerLevelByUserId($userId);
        if (!$quisionerLevel->company_applied_section) {
            throw new BadRequestException('Gagal mengisi kuisioner , kamu belum mengisi kuisioner sebelumnya');
        }
        if ($quisionerLevel->job_suitability_section) {
            throw new BadRequestException('Ops , nampaknya kamu sudah mengisi kuisioner ini');
        }

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
            'user_id' => $userId,
        ];
        $created = $this->jobSuitability->create($jobsSuitabilityData);
        $user = $this->user->find($userId);
        if (isset($created)) {
            $userUpdated = $user->update(
                ['account_status' => true]
            );
            $isUpdate = $quisionerLevel->update([
                'job_suitability_section' => true
            ]);
            if ($isUpdate && $userUpdated) {
                DB::commit();
                return $this->successResponse(['quis_terjawab' => $created], 201, 'Berhasil mengisi kuisioner');
            }
            throw new Exception('Gagal memperbarui kuisioner');
        }
        throw new Exception('Gagal mengisi kuisioner');
    }
    public function showUpdateQuisioner($userId)
    {
        $quisionerLevel = $this->quisionerLevel->where('user_id', $userId)->first();
        if (isset($quisionerLevel)) {
            return $this->successResponse($quisionerLevel, 200, 'Success fetch data');
        }
        return response()->json([
            'status' => false,
            'message' => 'Ops , user belum melakukan pengisian quisioner sama sekali',
            'data' => null,
            'code' => 404
        ], 404);
    }


    private function findQuisionerLevelByUserId($userId)
    {
        $quisioner = $this->quisionerLevel->where('user_id', $userId)->first();
        if (isset($quisioner)) {
            return $quisioner;
        }
        throw new NotFoundException("Quisioner level not found", 404);
    }
    private function successResponse($data, $code, $message)
    {
        return response()->json(
            [
                'status' => true,
                'data' => $data,
                'message' => $message,
                'code' => $code
            ],
            $code
        );
    }

}