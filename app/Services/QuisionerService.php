<?php


namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Exceptions\WebException;
use App\Helper\ResponseHelper;
use App\Models\CompanyApplied;
use App\Models\Competence;
use App\Models\FurtheStudy;
use App\Models\HowFindJob;
use App\Models\Identity;
use App\Models\JobSuitability;
use App\Models\MainSection;
use App\Models\Province;
use App\Models\QuisionerLevel;
use App\Models\QuisionerProdi;
use App\Models\Regency;
use App\Models\StartSearchJob;
use App\Models\StudyMethod;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
        $now = Carbon::now();
        $level = '0';

        $user = $this->user->find($userId);
        $quisionerLevel = $this->quisionerLevel->where('user_id', $userId)->orderBy('created_at', 'desc')->first();
        $prodi = $this->quisionerProdi->where('id', $request['kode_prodi'])->first();

        if ($user->account_status && $user->required_to_fill == false) {
            throw new BadRequestException('kamu tidak bisa mengisi quisioner , akun kamu sudah terverifikasi');
        }


        if (!isset($prodi)) {
            throw new NotFoundException("ops , nampaknya kode program studi yang kamu pilih tidak ada", 404);
        }

        if (isset($quisionerLevel)) { // jika user pernah mengisi quisioner
            if ($now->isBefore($quisionerLevel->expired)) {
                $interfal = $now->diff($quisionerLevel->expired);
                throw new BadRequestException('silahkan mengisi quisioner ' . $interfal->m . ' Bulan ' . $interfal->d . " Hari lagi");
            }
        }

        $quisionerCount = $this->quisionerLevel->where('user_id', $userId)->count();

        if ($quisionerCount == 0) {
            $level = '0';
        } else if ($quisionerCount == 1) {
            $level = '6';
        } else if ($quisionerCount == 2) {
            $level = '12';
        } else {
            throw new BadRequestException('ops , kamu sudah mengisi sebanyak 12 bulan ');
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
                'identitas_section' => $isCreated['id'],
                'user_id' => $userId,
                'level' => $level,
                'expired' => Carbon::now()->addMonths(6)
            ]);

            if (isset($quisionerIsCreated)) {
                Db::commit();
                $data = $this->quisionerLevel->find($quisionerIsCreated->id);
                $response = $this->quisionerLevelToResponse($data->toArray(), $isCreated->id);
                return $this->successResponse([
                    'quis_terjawab' => $response
                ], 201, 'Berhasil mengisi quisioner identitas');
            } else {
                throw new Exception("Error Processing Request", 500);
            }
        } else {
            throw new Exception("Gagal mengisi kuisioner", 500);
        }
    }

    public function updateQuisionerIdentity($request)
    {
        $identity = $this->identity->where('id', $request['id'])->first();

        if (isset($identity)) {
            unset($request['id']);
            try {
                //code...
                $isUpdate = $identity->update([
                    'kdptimsmh' => '005019',
                    'kdpstmsmh' => $request['kode_prodi'],
                    'nimhsmsmh' => $request['nim'],
                    'nmmhsmsmh' => $request['nama_lengkap'],
                    'telpomsmh' => $request['no_telp'],
                    'emailmsmh' => $request['email'],
                    'tahun_lulus' => $request['tahun_lulus'],
                    'nik' => $request['nik'],
                    'npwp' => $request['npwp'],
                ]);
                return $isUpdate;
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        throw new NotFoundException("Ops , Quisioner Tidak Ditemukan");
    }





    public function addQuisionerMain($request, $userId)
    {
        DB::beginTransaction();


        $regency = Regency::find($request['code_regency']);
        $province = Province::find($request['code_province']);

        if(!isset($province) || !isset($regency)){
            throw new BadRequestException("Kode wilayah tidak sesuai");
        }

        //code...
        $quisionerLevel = $this->findQuisionerLevelByUserId($userId);

        if (isset($quisionerLevel)) {
            $isSetIdentity = $quisionerLevel->identitas_section;
            if ($isSetIdentity) {
                if ($quisionerLevel->main_section) {
                    throw new BadRequestException('Ops , nampaknya kamu sudah mengisi kuisioner utama', 400);
                }
                $isCreated = $this->mainSection->create([
                    'f8' => $request['status'],
                    'f504' => $request['is_less_6_months'],
                    'f502' => $request['pre_grad_employment_months'],
                    'f505' => intval($request['monthly_income']),
                    'f506' => $request['post_grad_months'],
                    'f5a1' => $request['code_province'],
                    'f5a2' => $request['code_regency'],
                    'f1101' => $request['agency_type'],
                    'f5b' => $request['company_name'],
                    'f5c' => $request['job_title'],
                    'f5d' => $request['work_level'],
                ]);
                if (isset($isCreated)) {
                    $isUpdate = $quisionerLevel->update([
                        'main_section' => $isCreated->id,
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
            if (isset($quisionerLevel->furthe_study_section)) {
                throw new BadRequestException('Ops , nampaknya kamu sudah mengisi quisioner berikut', 400);
            }
            // check user sudah mengisi quisioner main
            if (isset($quisionerLevel->main_section)) {
                $isCreated = $this->furtheStudy->create([
                    'f18a' => $request['study_funding_source'],
                    'f18b' => $request['univercity_name'],
                    'f18c' => $request['study_program'],
                    'f18d' => $request['study_start_date'],
                    'f1201' => $request['education_funding_source'],
                    'f1202' => $request['financial_source'],
                    'f14' => $request['study_job_relationship'],
                    'f15' => $request['job_education_level'],
                ]);
                $user = $this->user->find($userId);
                if (isset($isCreated)) {
                    $isUpdate = $quisionerLevel->update([
                        'furthe_study_section' => $isCreated->id,
                    ]);
                    if ($isUpdate) {
                        DB::commit();
                        return $this->successResponse(['quis_terjawab' => $isCreated], 201, 'Berhasil mengisi kuisioner');
                    }
                    throw new Exception('Gagal untuk mengisi kuisioner , terjadi keslaahan', 500);
                } else {
                    throw new Exception('Gagal untuk mengisi kuisioner , terjadi keslaahan', 500);
                }
            } else {
                throw new BadRequestException('Ops , kamu harus mengisi quisioner main terlebih dahulu');
            }
        }
        throw new NotFoundException('qusioner level not found', 404);
    }


    public function addQuisionerCompetence($request, $userId)
    {
        DB::beginTransaction();

        //code...
        $quisionerLevel = $this->findQuisionerLevelByUserId($userId);
        if (!isset($quisionerLevel->furthe_study_section)) { // check user belum mengisi quisioner sebelumnya
            throw new BadRequestException('Ops , Nampaknya kamu belum mengisi quisioner sebelumnya', 400);
        }
        if (isset($quisionerLevel->competent_level_section)) {
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
            // Ganti dengan ID pengguna yang sesuai
        ];
        $created = $this->competence->create($competenceData);
        if (isset($created)) {
            $isUpdate = $quisionerLevel->update([
                'competent_level_section' => $created->id
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
        if (!isset($quisionerLevel->competent_level_section)) {
            throw new BadRequestException('Gagal mengisi kuisioner , kamu belum mengisi quisioner sebelumnya');
        }
        if (isset($quisionerLevel->study_method_section)) {
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
        ];
        $created = $this->studyMethod->create($studyMethodData);
        if (isset($created)) {
            $isUpdate = $quisionerLevel->update([
                'study_method_section' => $created->id
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

        if (!isset($quisionerLevel->study_method_section)) {
            throw new BadRequestException('Gagal mengisi kuisioner , kamu belum mengisi kuisioner sebelumnya');
        }

        if (isset($quisionerLevel->jobs_street_section)) {
            throw new BadRequestException('Ops , nampaknya kamu sudah mengisi kuisioner berikut');
        }
        DB::beginTransaction();
        $jobsStreetData = [
            'f301' => $request['job_search_start'],
            'f302' => $request['before_graduation'],
            'f303' => $request['after_graduation'],
        ];
        $created = $this->startSearchJob->create($jobsStreetData);
        if (isset($created)) {
            $isUpdate = $quisionerLevel->update([
                'jobs_street_section' => $created->id
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
        if (!isset($quisionerLevel->jobs_street_section)) {
            throw new BadRequestException('Gagal mengisi kuisioner , kamu belum mengisi kuisioner sebelumnya');
        }
        if (isset($quisionerLevel->how_find_jobs_section)) {
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
        ];
        $created = $this->howFindJob->create($howFindJobData);

        if (isset($created)) {
            $isUpdate = $quisionerLevel->update([
                'how_find_jobs_section' => $created->id
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
        if (!isset($quisionerLevel->how_find_jobs_section)) {
            throw new BadRequestException('Gagal mengisi kuisioner , kamu belum mengisi kuisioner sebelumnya');
        }
        if (isset($quisionerLevel->company_applied_section)) {
            throw new BadRequestException('Ops , nampaknya kamu sudah mengisi kuisioner ini');
        }
        DB::beginTransaction();
        $comapnyAppliedData = [
            'f6' => $request['job_applications_before_first_job'],
            'f7' => $request['job_applications_responses'],
            'f7a' => $request['interview_invitations'],
            'f1001' => $request['job_search_recently_active'],
            'f1002' => $request['job_search_recently_active_other'],
        ];
        $created = $this->comapnyAppled->create($comapnyAppliedData);
        if (isset($created)) {
            $isUpdate = $quisionerLevel->update([
                'company_applied_section' => $created->id
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
        if (!isset($quisionerLevel->company_applied_section)) {
            throw new BadRequestException('Gagal mengisi kuisioner , kamu belum mengisi kuisioner sebelumnya');
        }
        if (isset($quisionerLevel->job_suitability_section)) {
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
        ];
        $created = $this->jobSuitability->create($jobsSuitabilityData);
        $user = $this->user->find($userId);
        if (isset($created)) {
            $userUpdated = $user->update(
                ['account_status' => true]
            );
            $isUpdate = $quisionerLevel->update([
                'job_suitability_section' => $created->id
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
        $quisionerLevel = $this->quisionerLevel->where('user_id', $userId)->orderBy('created_at', 'desc')->first();
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
        $quisioner = $this->quisionerLevel->where('user_id', $userId)->orderBy('created_at', 'desc')->first();
        if (isset($quisioner)) {
            return $quisioner;
        }
        throw new NotFoundException("Quisioner level not found", 404);
    }


    public function findAllQuisionerUser($tahun = 0, $bulan = 0)
    {

        $users = $this->user->has('quisioner_level')
            ->has('quisioner_level.identity')
            ->has('quisioner_level.main')
            ->has('quisioner_level.furthe_study')
            ->has('quisioner_level.studymethod')
            ->has('quisioner_level.startsearchjobs')
            ->has('quisioner_level.howtofindjobs')
            ->has('quisioner_level.companyapplied')
            ->has('quisioner_level.jobsuitability')
            ->has('educations') // Filter hanya pengguna yang memiliki pendidikan
            ->with('quisioner_level', function ($query) {
                $query->with('identity');
                $query->with('main');
                $query->with('furthe_study');
                $query->with('competence');
                $query->with('studymethod');
                $query->with('startsearchjobs');
                $query->with('howtofindjobs');
                $query->with('companyapplied');
                $query->with('jobsuitability');
            })
            ->with('educations')
            ->with('prodi')
            ->get()
            ->toArray();



        $data['countPerDay'] = [];
        $startDate = now()->startOfWeek(); // Mendapatkan awal minggu (Minggu)
        $endDate = now()->endOfWeek(); // Mendapatkan akhir minggu (Sabtu)

        while ($startDate <= $endDate) {
            $count = 0; // Inisialisasi jumlah kuesioner menjadi 0
            foreach ($users as $user) {
                $quizzes = $user['quisioner_level']; // Mengambil data kuesioner pengguna
                foreach ($quizzes as $quiz) {
                    $quizDate = Carbon::parse($quiz['created_at'])->startOfDay();

                    // Memeriksa apakah tanggal kuesioner berada dalam rentang minggu yang diinginkan
                    if ($quizDate->format('Y-m-d') == $startDate->format('Y-m-d')) {
                        $count++;
                    }
                }
            }
            $data['countPerDay'][$startDate->format('Y-m-d')] = $count;
            $startDate->addDay();
        }


        $userFilled = $this->user->has('quisioner_level')->has('quisioner_level.identity')->has('quisioner_level.main')->has('quisioner_level.furthe_study')->has('quisioner_level.competence')->has('quisioner_level.studymethod')->has('quisioner_level.startsearchjobs')->has('quisioner_level.howtofindjobs')->has('quisioner_level.companyapplied')->has('quisioner_level.jobsuitability')->count();
        $userBlank = $this->user->whereDoesntHave('quisioner_level')->count();

        $data['quisioners'] = collect($users)->filter(function ($user) use ($tahun, $bulan) {
            $tahunMasuk = null; // Initialize the tahun_masuk variable
            $tahunLulus = null; // Initialize the tahun_lulus variable

            $hasMatchingEducation = false; // Initialize a flag
            $hasMatchingQuisioner = false; // Initialize a flag for matching quisioner level

            collect($user['educations'])->each(function ($education) use (&$tahunMasuk, &$tahunLulus, $tahun, &$hasMatchingEducation) {
                if ($education['perguruan'] === 'Politeknik Negeri Jember') {
                    $tahunMasuk = $education['tahun_masuk'];
                    $tahunLulus = $education['tahun_lulus'];
                    if ($education['tahun_masuk'] == $tahun) {
                        $hasMatchingEducation = true;
                    }
                }
            });

            if ($bulan == 0) {
                $hasMatchingQuisioner = true; // If $bulan is 0, consider quisioner level a match
            } else {
                $userQuisioners = collect($user['quisioner_level']);
                if ($userQuisioners->contains('level', $bulan)) {
                    $hasMatchingQuisioner = true; // Set the flag to true when quisioner level matches $bulan
                }
            }
            return ($tahun == 0 || $hasMatchingEducation) && $hasMatchingQuisioner;
        })->map(function ($user) {
            // Modify the items here
            $tempUser = $this->castToUserResponseFromArray($user);
            return $tempUser;
        })->toArray();
        $data['filled'] = $userFilled;
        $data['blank'] = $userBlank;
        $data['countPerDay'] = array_values($data['countPerDay']); // hapus , key tanggal
        return $data;
    }



    public function findAllQuisionerUserStudyProgram($idProdi, $tahun = 0, $bulan = 0)
    {
        $users = $this->user->has('quisioner_level')
            ->has('quisioner_level.identity')
            ->has('quisioner_level.main')
            ->has('quisioner_level.furthe_study')
            ->has('quisioner_level.studymethod')
            ->has('quisioner_level.startsearchjobs')
            ->has('quisioner_level.howtofindjobs')
            ->has('quisioner_level.companyapplied')
            ->has('quisioner_level.jobsuitability')
            ->has('educations') // Filter hanya pengguna yang memiliki pendidikan
            ->with('quisioner_level', function ($query) {
                $query->with('identity');
                $query->with('main');
                $query->with('furthe_study');
                $query->with('competence');
                $query->with('studymethod');
                $query->with('startsearchjobs');
                $query->with('howtofindjobs');
                $query->with('companyapplied');
                $query->with('jobsuitability');
            })
            ->with('educations')
            ->with('prodi')
            ->where('kode_prodi', $idProdi)
            ->get()
            ->toArray();



        $data['countPerDay'] = [];
        $startDate = now()->startOfWeek(); // Mendapatkan awal minggu (Minggu)
        $endDate = now()->endOfWeek(); // Mendapatkan akhir minggu (Sabtu)

        while ($startDate <= $endDate) {
            $count = 0; // Inisialisasi jumlah kuesioner menjadi 0
            foreach ($users as $user) {
                $quizzes = $user['quisioner_level']; // Mengambil data kuesioner pengguna
                foreach ($quizzes as $quiz) {
                    $quizDate = Carbon::parse($quiz['created_at'])->startOfDay();

                    // Memeriksa apakah tanggal kuesioner berada dalam rentang minggu yang diinginkan
                    if ($quizDate->format('Y-m-d') == $startDate->format('Y-m-d')) {
                        $count++;
                    }
                }
            }
            $data['countPerDay'][$startDate->format('Y-m-d')] = $count;
            $startDate->addDay();
        }


        $userFilled = $this->user->has('quisioner_level')->has('quisioner_level.identity')->has('quisioner_level.main')->has('quisioner_level.furthe_study')->has('quisioner_level.competence')->has('quisioner_level.studymethod')->has('quisioner_level.startsearchjobs')->has('quisioner_level.howtofindjobs')->has('quisioner_level.companyapplied')->has('quisioner_level.jobsuitability')->count();
        $userBlank = $this->user->whereDoesntHave('quisioner_level')->count();

        $data['quisioners'] = collect($users)->filter(function ($user) use ($tahun, $bulan) {
            $tahunMasuk = null; // Initialize the tahun_masuk variable
            $tahunLulus = null; // Initialize the tahun_lulus variable

            $hasMatchingEducation = false; // Initialize a flag
            $hasMatchingQuisioner = false; // Initialize a flag for matching quisioner level

            collect($user['educations'])->each(function ($education) use (&$tahunMasuk, &$tahunLulus, $tahun, &$hasMatchingEducation) {
                if ($education['perguruan'] === 'Politeknik Negeri Jember') {
                    $tahunMasuk = $education['tahun_masuk'];
                    $tahunLulus = $education['tahun_lulus'];
                    if ($education['tahun_masuk'] == $tahun) {
                        $hasMatchingEducation = true;
                    }
                }
            });

            if ($bulan == 0) {
                $hasMatchingQuisioner = true; // If $bulan is 0, consider quisioner level a match
            } else {
                $userQuisioners = collect($user['quisioner_level']);
                if ($userQuisioners->contains('level', $bulan)) {
                    $hasMatchingQuisioner = true; // Set the flag to true when quisioner level matches $bulan
                }
            }
            return ($tahun == 0 || $hasMatchingEducation) && $hasMatchingQuisioner;
        })->map(function ($user) {
            // Modify the items here
            $tempUser = $this->castToUserResponseFromArray($user);
            return $tempUser;
        })->toArray();
        $data['filled'] = $userFilled;
        $data['blank'] = $userBlank;
        $data['countPerDay'] = array_values($data['countPerDay']); // hapus , key tanggal
        return $data;
    }

    public function exrportToExcel($tahunBulan, $kodeProdi = null)
    {

        list($year, $bulan) = explode('-', $tahunBulan);

        $users = $this->user->has('quisioner_level')
            ->whereHas('educations', function ($query) use ($year) {
                $query->where('perguruan', 'Politeknik Negeri Jember');
                $query->where('tahun_lulus', $year);
            })
            ->with('quisioner_level', function ($query) use ($bulan) {
                $query->with('identity');
                $query->with('main');
                $query->with('main.province');
                $query->with('main.regency');

                $query->with('furthe_study');
                $query->with('competence');
                $query->with('studymethod');
                $query->with('startsearchjobs');
                $query->with('howtofindjobs');
                $query->with('companyapplied');
                $query->with('jobsuitability');
                $query->where('level', $bulan);
            })
            ->with('educations')
            ->with('prodi')
            ->when($kodeProdi != null, function ($query) use ($kodeProdi) {
                $query->where('kode_prodi', $kodeProdi);
            })
            ->get()
            ->toArray();

        $data = collect($users)->map(function ($user) {
            // Modify the items here
            $tempUser = $this->castToUserResponseFromArray($user);
            $dataQuisioner = $tempUser['quisioner'][0];

            $competence = $this->castComptenceLevelToLaporan($dataQuisioner['competence']);
            $dataQuisioner['competence'] = $competence;
            $dataQuisioner['studymethod'] = $this->castStudyMethodToLaporan($dataQuisioner['studymethod']);
            $dataQuisioner['furthe_study'] = $this->castFurtheStudyLaporan($dataQuisioner['furthe_study']);
            $dataQuisioner['startsearchjobs'] = $this->castStartSearchJobLaporan($dataQuisioner['startsearchjobs']);
            $dataQuisioner['main'] = $this->castMainToLaporan($dataQuisioner['main']);
            $dataQuisioner['companyapplied'] = $this->castCompanyAppliedLaporan($dataQuisioner['companyapplied']);
            $dataQuisioner['jobsuitability'] = $this->castJobsuitabilityLaporan($dataQuisioner['jobsuitability']);
            $dataQuisioner['howtofindjobs'] = $this->castToHowToFindJob($dataQuisioner['howtofindjobs']);

            $tempUser['quisioner'][0] = $dataQuisioner;
            return $tempUser;
        })->toArray();
        return $data;
    }






    public function updateFromExcel($keys, $data, $kodeProdi = null)
    {
        Db::beginTransaction();
        foreach ($data as $value) {
            // dd($value);
            if ($kodeProdi != null) {
                $tempData = $this->quisionerLevel->where('user_id', $value['id user'])->where('level', strval($value['level']))
                    ->with('user', function ($query) use ($kodeProdi) {
                        $query->with('prodi')->where('id', $kodeProdi);
                    })
                    ->first();
                // dd($tempData);
            } else {
                $tempData = $this->quisionerLevel->where('user_id', $value['id user'])->where('level', strval($value['level']))
                    ->first();
            }
            if (isset($tempData)) {
                $idIdentitas = $tempData->identitas_section;
                $idMain = $tempData->main_section;
                $idFurthe = $tempData->furthe_study_section;
                $idCompetence = $tempData->competent_level_section;
                $idStudyMethod = $tempData->study_method_section;
                $idJobsStreet = $tempData->jobs_street_section;
                $idHowFindJobs = $tempData->how_find_jobs_section;
                $idCompanyApplied = $tempData->company_applied_section;
                $idJobSuitability = $tempData->job_suitability_section;
                try {
                    //code...
                    $this->updateIdentitas($idIdentitas, $value);
                    $this->updateMain($idMain, array_intersect_key($value, array_flip([
                        'f8',
                        'f504',
                        'f502',
                        'f505',
                        'f5a1',
                        'f5a2',
                        'f506',
                        'f1101',
                        'f5b',
                        'f5c',
                        'f5d',
                    ])));
                    $this->updateFrutheStudy($idFurthe, array_intersect_key($value, array_flip([
                        'f18a',
                        'f18b',
                        'f18d',
                        'f1201',
                        'f1202',
                        'f14',
                        'f15',
                    ])));
                    $this->updateCompetence($idCompetence, array_intersect_key($value, array_flip([
                        'f1761',
                        'f1762',
                        'f1763',
                        'f1764',
                        'f1765',
                        'f1766',
                        'f1767',
                        'f1768',
                        'f1769',
                        'f1770',
                        'f1771',
                        'f1772',
                        'f1773',
                        'f1774',
                    ])));
                    $this->updateStudyMethod($idStudyMethod, array_intersect_key($value, array_flip([
                        'f21',
                        'f22',
                        'f23',
                        'f24',
                        'f25',
                        'f26',
                        'f27',
                    ])));
                    $this->updateJobsStreet($idJobsStreet, array_intersect_key($value, array_flip([
                        'f301',
                        'f302',
                        'f303',
                    ])));
                    $this->updateHowFindJob($idHowFindJobs, array_intersect_key($value, array_flip([
                        'f401',
                        'f402',
                        'f403',
                        'f404',
                        'f405',
                        'f406',
                        'f407',
                        'f408',
                        'f409',
                        'f410',
                        'f411',
                        'f412',
                        'f413',
                        'f414',
                        'f415',
                        'f416',
                    ])));

                    $this->updateCompanyApplied($idCompanyApplied, array_intersect_key($value, array_flip([
                        'f6',
                        'f7',
                        'f7a',
                        'f1001',
                        'f1002',
                    ])));

                    $this->updateJobSuitability($idJobSuitability, array_intersect_key($value, array_flip([
                        'f1601',
                        'f1602',
                        'f1603',
                        'f1604',
                        'f1605',
                        'f1606',
                        'f1607',
                        'f1608',
                        'f1609',
                        'f1610',
                        'f1611',
                        'f1612',
                        'f1613',
                        'f1614',
                    ])));
                } catch (\Throwable $th) {
                    //throw $th;
                    throw new WebException($th->getMessage());
                }
            } else {
                throw new WebException("Ops , Data User Pada Excel Kamu Tidak Ditemukan Silahkan Masukan Excel Yang Valid");
            }
        }
        return true;
    }

    private function updateIdentitas($idIdentitas, $data)
    {
        $updated = $this->identity->where('id', $idIdentitas)->update([
            'kdptimsmh' => $data['kode pt'],
            'kdpstmsmh' => $data['kode prodi'],
            'nimhsmsmh' => $data['nim'],
            'nmmhsmsmh' => $data['nama'],
            'telpomsmh' => $data['hp'],
            'tahun_lulus' => $data['tahun lulus'],
            'npwp' => $data['npwp'],
        ]);
        if ($updated) {
            DB::commit();
        }
    }

    public function updateMain($idMain, $data)
    {

        $main = $this->mainSection->where('id', $idMain)->first();
        if (!isset($main)) {
            throw new NotFoundException("Ops, Quisioner Main Tidak Ditemukan");
        }
        try {
            //code...
            $updated = $main->update($data);
            if ($updated) {
                Db::commit();
                return $updated;
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception($th->getMessage());
        }
    }

    public function updateFrutheStudy($idFurthe, $data)
    {
        $data['f18d'] = Carbon::parse($data['f18d']);
        $furtheStudy = $this->furtheStudy->where('id', $idFurthe)->first();
        if (!isset($furtheStudy)) {
            throw new NotFoundException("Ops , Quisioner Furthe Study Tidak Ditemukan");
        }
        try {
            //code...
            $updated = $furtheStudy->update($data);
            if ($updated) {
                Db::commit();
                return $updated;
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception($th->getMessage());
        }
    }

    public function updateCompetence($idCompetence, $data)
    {
        $competence = $this->competence->where('id', $idCompetence)->first();

        if (!isset($competence)) {
            throw new NotFoundException("Ops, Quisioner Kompeten Tidak Ditemukan");
        }

        try {
            //code...
            $updated = $competence->update($data);
            if ($updated) {
                Db::commit();
                return $updated;
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception($th->getMessage());
        }
    }

    public function updateStudyMethod($idStudyMethod, $data)
    {
        $studyMethod = $this->studyMethod->where('id', $idStudyMethod)->first();
        if (!isset($studyMethod)) {
            throw new NotFoundException("Ops, Quisioner Metode Belajar Tidak Ditemukan");
        }
        try {
            //code...
            $updated = $studyMethod->update($data);
            if ($updated) {
                Db::commit();
                return $updated;
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception($th->getMessage());
        }
    }

    public function updateJobsStreet($idJobsStreet, $data)
    {
        $job = $this->startSearchJob->where('id', $idJobsStreet)->first();
        if (!isset($job)) {
            throw new NotFoundException("Ops, Quisioner Jobs Street Tidak Ditemukan");
        }
        try {
            //code...
            $updated = $job->update($data);
            if ($updated) {
                Db::commit();
                return $updated;
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception($th->getMessage());
        }
    }

    public function updateHowFindJob($idHowFindJob, $data)
    {
        $howFindJob = $this->howFindJob->where('id', $idHowFindJob)->first();
        if (!isset($howFindJob)) {
            throw new NotFoundException("Ops, Quisioner Bagaimana Mendapat Pekerjaan Tidak Ditemukan");
        }
        try {
            //code...
            $updated = $howFindJob->update($data);
            if ($updated) {
                Db::commit();
                return $updated;
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception($th->getMessage());
        }
    }

    public function updateCompanyApplied($idCompanyApplied, $data)
    {

        $companyApplied = $this->comapnyAppled->where('id', $idCompanyApplied)->first();

        if (!isset($companyApplied)) {
            throw new NotFoundException("Ops, Quisioner Perusahaan Dilamar Tidak Ditemukan");
        }

        try {
            //code...
            $updated = $companyApplied->update($data);
            if ($updated) {
                Db::commit();
                return $updated;
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception($th->getMessage());
        }
    }

    public function updateJobSuitability($idJobSuitability, $data)
    {
        $jobSuitability = $this->jobSuitability->where('id', $idJobSuitability)->first();
        if (!isset($jobSuitability)) {
            throw new NotFoundException("Ops, Quisioner Kesesuaian Pekerjaan Tidak Ditemukan");
        }

        try {
            //code...
            $updated = $jobSuitability->update($data);
            if ($updated) {
                Db::commit();
                return $updated;
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception($th->getMessage());
        }
    }



    private function successResponse($data, $code, $message)
    {
        return ResponseHelper::successResponse($message, $data, $code);
    }


    public function castToUserResponseFromArray($user)
    {

        $url = url('/') . "/users/" . $user['foto'];
        return [
            "id" => $user['id'],
            "fullname" => $user['visible_fullname'] == 1 ? $user['fullname'] : "***",
            "email" => $user['visible_email'] == 1 ? $user['email'] : "***",
            "nik" => $user['visible_nik'] == 1 ? $user['nik'] : "***",
            "no_telp" => $user['visible_no_telp'] == 1 ? $user['no_telp'] : "***",
            "foto" => $url,
            'ttl' => $user['ttl'],
            'alamat' => $user['visible_alamat'] == 1 ? $user['alamat'] : "***",
            "about" => $user['about'],
            "gender" => $user['gender'],
            "level" => $user['level'],
            'nim' => $user['nim'],
            "linkedin" => $user['linkedin'],
            "facebook" => $user['facebook'],
            "instagram" => $user['instagram'],
            'twiter' => $user['twiter'],
            'prodi' => $user['prodi'],
            'account_status' => $user['account_status'],
            'quisioner' => $user['quisioner_level'],
            'tahun_masuk' => $user['educations'][0]['tahun_masuk'],
            'tahun_lulus' => $user['educations'][0]['tahun_lulus']
        ];
    }


    public function quisionerLevelToResponse($data, $id)
    {
        $response = [];
        $attributesToCheck = [
            'identitas_section',
            'main_section',
            'furthe_study_section',
            'competent_level_section',
            'study_method_section',
            'jobs_street_section',
            'how_find_jobs_section',
            'company_applied_section',
            'job_suitability_section',
        ];

        foreach ($attributesToCheck as $attribute) {
            if (!is_null($data[$attribute])) {
                $response[$attribute] = true;
            } else {
                $response[$attribute] = false;
            }
        }
        $response['id'] = $id;
        return $response;
    }


    public function findQuisionerByUser($userId, $level)
    {

        $user = $this->user->where('id', $userId)->first();
        if (!isset($user)) {
            throw new WebException('Ops , user tidak ditemukan');
        }
        $users = $this->user->has('quisioner_level')
            ->has('educations') // Filter hanya pengguna yang memiliki pendidikan
            ->with('quisioner_level', function ($query) use ($level) {
                $query->where('level', $level);
                $query->with('identity');
                $query->with('main');
                $query->with('furthe_study');
                $query->with('competence');
                $query->with('studymethod');
                $query->with('startsearchjobs');
                $query->with('howtofindjobs');
                $query->with('companyapplied');
                $query->with('jobsuitability');
            })
            ->with('educations')
            ->with('prodi')
            ->get()
            ->toArray();
        if (sizeof($users) == 0) {
            throw new WebException('Ops , user belum mengisi quisioner sama sekali');
        }
        return $users;
    }



    public function exrportToExcelAkreditasi($tahunBulan, $kodeProdi = null)
    {

        list($year, $bulan) = explode('-', $tahunBulan);

        $users = $this->user->has('quisioner_level')
            ->whereHas('educations', function ($query) use ($year) {
                $query->where('perguruan', 'Politeknik Negeri Jember');
                $query->where('tahun_lulus', $year);
            })
            ->with('quisioner_level', function ($query) use ($bulan) {
                $query->with('identity');
                $query->with('main');
                $query->with('main.province');
                $query->with('main.regency');

                $query->with('furthe_study');
                $query->with('competence');
                $query->with('studymethod');
                $query->with('startsearchjobs');
                $query->with('howtofindjobs');
                $query->with('companyapplied');
                $query->with('jobsuitability');
                $query->where('level', $bulan);
            })
            ->with('educations')
            ->with('prodi')
            ->when($kodeProdi != null, function ($query) use ($kodeProdi) {
                $query->where('kode_prodi', $kodeProdi);
            })
            ->get()
            ->toArray();

        $data = collect($users)->map(function ($user) {
            // Modify the items here
            $tempUser = $this->castToUserResponseFromArray($user);
            $dataQuisioner = $tempUser['quisioner'][0];

            $competence = $this->castComptenceLevelToAkreditasi($dataQuisioner['competence']);
            $dataQuisioner['competence'] = $competence;
            $dataQuisioner['studymethod'] = $this->castStudyMethodToAkreditasi($dataQuisioner['studymethod']);
            $dataQuisioner['furthe_study'] = $this->castFurtheStudyAkreditasi($dataQuisioner['furthe_study']);
            $dataQuisioner['startsearchjobs'] = $this->castStartSearchJobAkreditasi($dataQuisioner['startsearchjobs']);
            $dataQuisioner['main'] = $this->castMainToAkreditasi($dataQuisioner['main']);
            $dataQuisioner['companyapplied'] = $this->castCompanyAppliedAkreditasi($dataQuisioner['companyapplied']);
            $dataQuisioner['jobsuitability'] = $this->castJobsuitabilityAkreditasi($dataQuisioner['jobsuitability']);
            $tempUser['quisioner'][0] = $dataQuisioner;
            return $tempUser;
        })->toArray();




        return $data;
    }


    private function castComptenceLevelToAkreditasi($data)
    {
        $result = [];
        unset($data['id']);
        foreach ($data as $key => $value) {
            # code...
            $akreditasi = 1;
            switch ($value) {
                case "Sangat Rendah":
                    $akreditasi = 1;
                    break;
                case "Rendah":
                    $akreditasi = 2;
                    break;
                case "Netral":
                    $akreditasi = 3;
                    break;
                case "Tinggi":
                    $akreditasi = 4;
                    break;
                case "Sangat Tinggi":
                    $akreditasi = 5;
                    break;
                default:
                    $akreditasi = 1;
            }
            $result[$key] = $akreditasi;
        }
        return $result;
    }


    private function castComptenceLevelToLaporan($data)
    {
        $result = [];
        unset($data['id']);
        foreach ($data as $key => $value) {
            # code...
            $akreditasi = "1";
            switch ($value) {
                case "Sangat Rendah":
                    $akreditasi = "1-Sangat Rendah";
                    break;
                case "Rendah":
                    $akreditasi = "2-Rendah";
                    break;
                case "Netral":
                    $akreditasi = "3-Netral";
                    break;
                case "Tinggi":
                    $akreditasi = "4-Tinggi";
                    break;
                case "Sangat Tinggi":
                    $akreditasi = "5-Sangat Tinggi";
                    break;
                default:
                    $akreditasi = "5-Sangat Tinggi";
            }
            $result[$key] = $akreditasi;
        }
        return $result;
    }
    public function castStudyMethodToAkreditasi($data)
    {
        $result = [];
        unset($data['id']);
        foreach ($data as $key => $value) {
            # code...
            $akreditasi = 1;
            switch ($value) {
                case "Sangat Besar":
                    $akreditasi = 1;
                    break;
                case "Besar":
                    $akreditasi = 2;
                    break;
                case "Cukup Besar":
                    $akreditasi = 3;
                    break;
                case "Kurang":
                    $akreditasi = 4;
                    break;
                case "Tidak Sama Sekali":
                    $akreditasi = 5;
                    break;
                default:
                    $akreditasi = 1;
            }
            $result[$key] = $akreditasi;
        }
        return $result;
    }
    public function castStudyMethodToLaporan($data)
    {
        $result = [];
        unset($data['id']);
        foreach ($data as $key => $value) {
            # code...
            $akreditasi = "1";
            switch ($value) {
                case "Sangat Besar":
                    $akreditasi = "1-Sangat Besar";
                    break;
                case "Besar":
                    $akreditasi = "2-Besar";
                    break;
                case "Cukup Besar":
                    $akreditasi = "3-Cukup Besar";
                    break;
                case "Kurang":
                    $akreditasi = "4-Kurang";
                    break;
                case "Tidak Sama Sekali":
                    $akreditasi = "5-Tidak Sama Sekali";
                    break;
                default:
                    $akreditasi = "1-Sangat Besar";
            }
            $result[$key] = $akreditasi;
        }
        return $result;
    }
    private function castFurtheStudyAkreditasi($data)
    {
        unset($data['id']);
        $result = $data;
        if ($data['f18a'] == 'Beasiswa') {
            $result['f18a'] = 1;
        } else {
            $result['f18a'] = 2;
        }


        switch ($data['f1201']) {
            case 'Biaya Sendiri/Keluarga':
                # code...
                $result['f1201'] = 1;
                break;
            case 'Beasiswa ADIK':
                # code...
                $result['f1201'] = 2;
                break;
            case 'Beasiswa BIDIKMISI':
                # code...
                $result['f1201'] = 3;
                break;
            case 'Beasiswa PPA':
                # code...
                $result['f1201'] = 4;
                break;
            case 'Beasiswa AFIRMASI':
                # code...
                $result['f1201'] = 5;
                break;
            case 'Beasiswa Perusahaan/Swasta ':
                # code...
                $result['f1201'] = 6;
                break;
            case 'Lainnya, tuliskan':
                # code...
                $result['f1201'] = 7;
                break;
            default:
                # code...
                $result['f1201'] = 1;
                break;
        }


        switch ($data['f14']) {
            case "Sangat Erat":
                $result['f14'] = 1;
                break;
            case "Erat":
                $result['f14'] = 2;
                break;
            case "Cukup Erat":
                $result['f14'] = 3;
                break;
            case "Kurang Erat":
                $result['f14'] = 4;
                break;
            case "Tidak Sama Sekali":
                $result['f14'] = 5;
                break;
            default:
                $result['f14'] = 1;
                break;
        }



        switch ($data['f15']) {
            case "Setingkat Lebih Tinggi":
                $result['f15'] = 1;
                break;
            case "Tingkat yang Sama":
                $result['f15'] = 2;
                break;
            case "Setingkat Lebih Rendah":
                $result['f15'] = 3;
                break;
            case "Tidak Perlu Pendidikan Tinggi":
                $result['f15'] = 4;
                break;
            default:
                $result['f15'] = 1;
                break;
        }

        return $result;
    }

    private function castFurtheStudyLaporan($data)
    {
        unset($data['id']);
        $result = $data;
        if ($data['f18a'] == 'Beasiswa') {
            $result['f18a'] = "1-Beasiswa";
        } else {
            $result['f18a'] = "2-Biaya Sendiri";
        }


        switch ($data['f1201']) {
            case 'Biaya Sendiri/Keluarga':
                # code...
                $result['f1201'] = "1-Biaya Sendiri/Keluarga";
                break;
            case 'Beasiswa ADIK':
                # code...
                $result['f1201'] = "2-Beasiswa ADIK";
                break;
            case 'Beasiswa BIDIKMISI':
                # code...
                $result['f1201'] = "3-Beasiswa BIDIKMISI";
                break;
            case 'Beasiswa PPA':
                # code...
                $result['f1201'] = "4-Beasiswa PPA";
                break;
            case 'Beasiswa AFIRMASI':
                # code...
                $result['f1201'] = "5-Beasiswa AFIRMASI";
                break;
            case 'Beasiswa Perusahaan/Swasta ':
                # code...
                $result['f1201'] = "6-Beasiswa Perusahaan/Swasta";
                break;
            case 'Lainnya, tuliskan':
                # code...
                $result['f1201'] = "7-Lainnya, tuliskan";
                break;
            default:
                # code...
                $result['f1201'] = "1-Biaya Sendiri/Keluarga";
                break;
        }


        switch ($data['f14']) {
            case "Sangat Erat":
                $result['f14'] = "1-Sangat Erat";
                break;
            case "Erat":
                $result['f14'] = "2-Erat";
                break;
            case "Cukup Erat":
                $result['f14'] = "3-Cukup Erat";
                break;
            case "Kurang Erat":
                $result['f14'] = "4-Kurang Erat";
                break;
            case "Tidak Sama Sekali":
                $result['f14'] = "5-Tidak Sama Sekali";
                break;
            default:
                $result['f14'] = "1-Sangat Erat";
                break;
        }



        switch ($data['f15']) {
            case "Setingkat Lebih Tinggi":
                $result['f15'] = "1-Setingkat Lebih Tinggi";
                break;
            case "Tingkat yang Sama":
                $result['f15'] = "2-Tingkat yang Sama";
                break;
            case "Setingkat Lebih Rendah":
                $result['f15'] = "3-Setingkat Lebih Rendah";
                break;
            case "Tidak Perlu Pendidikan Tinggi":
                $result['f15'] = "4-Tidak Perlu Pendidikan Tinggi";
                break;
            default:
                $result['f15'] = "1-Setingkat Lebih Tinggi";
                break;
        }

        return $result;
    }
    private function castStartSearchJobAkreditasi($data)
    {
        $result = $data;
        switch ($data['f301']) {
            case 'Saya mencari kerja sebelum lulus':
                # code...
                $result['f301'] = 1;
                break;
            case 'Saya mencari kerja sesudah wisuda':
                # code...
                $result['f301'] = 2;
                break;
            case 'Saya tidak mencari kerja':
                # code...
                $result['f301'] = 3;
                break;
            default:
                # code...
                $result['f301'] = 1;
                break;
        }
        return $result;
    }


    private function castStartSearchJobLaporan($data)
    {
        $result = $data;
        switch ($data['f301']) {
            case 'Saya mencari kerja sebelum lulus':
                # code...
                $result['f301'] = "1-Saya mencari kerja sebelum lulus";
                break;
            case 'Saya mencari kerja sesudah wisuda':
                # code...
                $result['f301'] = "2-Saya mencari kerja sesudah wisuda";
                break;
            case 'Saya tidak mencari kerja':
                # code...
                $result['f301'] = "3-Saya tidak mencari kerja";
                break;
            default:
                # code...
                $result['f301'] = "1-Saya mencari kerja sebelum lulus";
                break;
        }
        return $result;
    }
    private function castMainToAkreditasi($data)
    {
        $result = $data;
        switch ($data['f8']) {
            case 'Bekerja (full time / part time)':
                # code...
                $result['f8'] = 1;
                break;
            case 'Belum memungkinkan bekerja':
                # code...
                $result['f8'] = 2;
                break;
            case 'Wiraswasta':
                # code...
                $result['f8'] = 3;
                break;
            case 'Melanjutkan Pendidikan':
                # code...
                $result['f8'] = 4;
                break;
            case 'Tidak kerja tetapi sedang mencari kerja':
                # code...
                $result['f8'] = 5;
                break;
            default:
                # code...
                $result['f8'] = 1;
                break;
        }

        if ($data['f504'] = "Ya") {
            $result['f504'] = 1;
        } else {
            $result['f504'] = 2;
        }

        switch ($data['f1101']) {
            case 'Intansi pemerintah':
                # code...
                $result['f1101'] = 1;
                break;
            case 'BUMN/BUMD':
                # code...
                $result['f1101'] = 6;
                break;
            case 'Institusi/Organisasi Multilateral':
                # code...
                $result['f1101'] = 7;
                break;
            case 'Organisasi non-profit/Lembaga Swadaya Masyarakat':
                # code...
                $result['f1101'] = 2;
                break;
            case 'Perusahaan swasta':
                # code...
                $result['f1101'] = 3;
                break;
            case 'Wiraswasta/perusahaan sendiri':
                # code...
                $result['f1101'] = 4;
                break;
            case 'Lainnya, Tuliskan':
                # code...
                $result['f1101'] = 5;
                break;
            default:
                # code...
                $result['f1101'] = 5;
                break;
        }

        switch ($data['f5c']) {
            case 'Founder':
                # code...
                $result['f5c'] = 1;
                break;
            case 'Co-Founder':
                # code...
                $result['f5c'] = 2;
                break;
            case 'Staff':
                # code...
                $result['f5c'] = 3;
                break;
            case 'Freelance/Kerja Lepas':
                # code...
                $result['f5c'] = 4;
                break;
            default:
                $result['f5c'] = 4;
                # code...
                break;
        }


        switch ($data['f5d']) {
            case 'Lokal/wilayah/wiraswasta tidak berbadan hukum':
                # code...
                $result['f5d'] = 1;
                break;
            case 'Nasional/wiraswasta berbadan hukum':
                # code...
                $result['f5d'] = 2;
                break;
            case 'Multinasional/Internasional':
                # code...
                $result['f5d'] = 3;
                break;

            default:
                # code...
                $result['f5d'] = 1;
                break;
        }

        return $result;
    }


    private function castMainToLaporan($data)
    {
        $result = $data;
        switch ($data['f8']) {
            case 'Bekerja (full time / part time)':
                # code...
                $result['f8'] = "1-Bekerja (full time/ part time)";
                break;
            case 'Belum memungkinkan bekerja':
                # code...
                $result['f8'] = "2-Belum memungkinkan bekerja";
                break;
            case 'Wiraswasta':
                # code...
                $result['f8'] = "3-Wiraswasta";
                break;
            case 'Melanjutkan Pendidikan':
                # code...
                $result['f8'] = "4-Melanjutkan Pendidikan";
                break;
            case 'Tidak kerja tetapi sedang mencari kerja':
                # code...
                $result['f8'] = "5-Tidak kerja tetapi sedang mencari kerja";
                break;
            default:
                # code...
                $result['f8'] = "1-Bekerja (full time/part time )";
                break;
        }

        if ($data['f504'] = "Ya") {
            $result['f504'] = "1-Ya";
        } else {
            $result['f504'] = "2-Tidak";
        }

        switch ($data['f1101']) {
            case 'Intansi pemerintah':
                # code...
                $result['f1101'] = "1-Instansi";
                break;
            case 'BUMN/BUMD':
                # code...
                $result['f1101'] = "6-BUMN/BUMD";
                break;
            case 'Institusi/Organisasi Multilateral':
                # code...
                $result['f1101'] = "7-Institusi/Organisasi Multilateral";
                break;
            case 'Organisasi non-profit/Lembaga Swadaya Masyarakat':
                # code...
                $result['f1101'] = "2-Organisasi non-profit/Lembaga Swadaya Masyarakat";
                break;
            case 'Perusahaan swasta':
                # code...
                $result['f1101'] = "3-Perusahaan swasta";
                break;
            case 'Wiraswasta/perusahaan sendiri':
                # code...
                $result['f1101'] = "4-Wiraswasta/perusahaan sendiri";
                break;
            case 'Lainnya, Tuliskan':
                # code...
                $result['f1101'] = "Lainnya, Tuliskan";
                break;
            default:
                # code...
                $result['f1101'] = "5-Lainnya, Tuliskan";
                break;
        }

        switch ($data['f5c']) {
            case 'Founder':
                # code...
                $result['f5c'] = "1-Founder";
                break;
            case 'Co-Founder':
                # code...
                $result['f5c'] = "2-Co-Founder";
                break;
            case 'Staff':
                # code...
                $result['f5c'] = "3-Staff";
                break;
            case 'Freelance/Kerja Lepas':
                # code...
                $result['f5c'] = "4-Freelance/Kerja Lepas";
                break;
            default:
                $result['f5c'] = "4-Freelance/Kerja Lepas";
                # code...
                break;
        }


        switch ($data['f5d']) {
            case 'Lokal/wilayah/wiraswasta tidak berbadan hukum':
                # code...
                $result['f5d'] = "1-Lokal/wilayah/wiraswasta tidak berbadan hukum";
                break;
            case 'Nasional/wiraswasta berbadan hukum':
                # code...
                $result['f5d'] = "2-Nasional/wiraswasta berbadan hukum";
                break;
            case 'Multinasional/Internasional':
                # code...
                $result['f5d'] = '3-Multinasional/Internasional';
                break;

            default:
                # code...
                $result['f5d'] = "1-Lokal/wilayah/wiraswasta tidak berbadan hukum";
                break;
        }

        return $result;
    }
    private function castCompanyAppliedAkreditasi($data)
    {
        $result = $data;
        switch ($data['f1001']) {
            case 'Tidak':
                # code...
                $result['f1001'] = 1;
                break;
            case 'Tidak, tapi saya sedang menunggu hasil lamaran kerja':
                # code...
                $result['f1001'] = 2;
                break;
            case 'Ya, saya akan mulai bekerja dalam 2 minggu ke depan':
                # code...
                $result['f1001'] = 3;
                break;
            case 'Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan':
                # code...
                $result['f1001'] = 4;
                break;
            case 'Lainya':
                # code...
                $result['f1001'] = 5;
                break;
            default:
                # code...
                $result['f1001'] = 5;
                break;
        }
        return $result;
    }

    private function castCompanyAppliedLaporan($data)
    {
        $result = $data;
        switch ($data['f1001']) {
            case 'Tidak':
                # code...
                $result['f1001'] = "1-Tidak";
                break;
            case 'Tidak, tapi saya sedang menunggu hasil lamaran kerja':
                # code...
                $result['f1001'] = "2-Tidak, tapi saya sedang menunggu hasil lamaran kerja";
                break;
            case 'Ya, saya akan mulai bekerja dalam 2 minggu ke depan':
                # code...
                $result['f1001'] = "3-Ya, saya akan mulai bekerja dalam 2 minggu ke depan";
                break;
            case 'Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan':
                # code...
                $result['f1001'] = "4-Ya, tapi saya belum pasti akan bekerja dalam 2 minggu ke depan";
                break;
            case 'Lainya':
                # code...
                $result['f1001'] = "5-Lainnya";
                break;
            default:
                # code...
                $result['f1001'] = "5-Lainnya";
                break;
        }
        return $result;
    }

    private function castJobsuitabilityAkreditasi($data)
    {
        $result = $data;
        if ($data['f1601'] == 'Tidak sesuai') {
            $result['f1601'] = 0;
        } else {
            $result['f1601'] = 1;
        }

        if ($data['f1602'] == 'Saya belum mendapatkan pekerjaan yang lebih sesuai') {
            $result['f1602'] = 1;
        } else {
            $result['f1602'] = 0;
        }
        if ($data['f1603'] == 'Di pekerjaan ini saya memeroleh prospek karir yang baik') {
            $result['f1603'] = 1;
        } else {
            $result['f1603'] = 0;
        }

        if ($data['f1604'] == 'Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya') {
            $result['f1604'] = 1;
        } else {
            $result['f1604'] = 0;
        }

        if ($data['f1605'] == 'Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya') {
            $result['f1605'] = 1;
        } else {
            $result['f1605'] = 0;
        }

        if ($data['f1606'] == 'Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini') {
            $result['f1606'] = 1;
        } else {
            $result['f1606'] = 0;
        }

        if ($data['f1607'] == 'Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini') {
            $result['f1607'] = 1;
        } else {
            $result['f1607'] = 0;
        }

        if ($data['f1608'] == "Pekerjaan saya saat ini lebih menarik") {
            $result['f1608'] = 1;
        } else {
            $result['f1608'] = 0;
        }

        if ($data['f1609'] == "Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel, dll") {
            $result['f1609'] = 1;
        } else {
            $result['f1609'] = 0;
        }

        if ($data['f1610'] == "Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya") {
            $result['f1610'] = 1;
        } else {
            $result['f1610'] = 0;
        }

        if ($data['f1611'] == "Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya") {
            $result['f1611'] = 1;
        } else {
            $result['f1611'] = 0;
        }

        if ($data['f1612'] == "Pada awal meniti karir ini, saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya") {
            $result['f1612'] = 1;
        } else {
            $result['f1612'] = 0;
        }

        if ($data['f1613'] == "Lainnya") {
            $result['f1613'] = 1;
        } else {
            $result['f1613'] = 0;
        }
        return $result;
    }


    private function castJobsuitabilityLaporan($data)
    {
        $result = $data;
        if ($data['f1601'] == 'Tidak sesuai') {
            $result['f1601'] = "0-Tidak sesuai";
        } else {
            $result['f1601'] = "1-Pekerjaan saya sekarang sudah sesuai dengan pendidikan saya";
        }

        if ($data['f1602'] == 'Saya belum mendapatkan pekerjaan yang lebih sesuai') {
            $result['f1602'] = "1-Saya belum mendapatkan pekerjaan yang lebih sesuai";
        } else {
            $result['f1602'] = "0-Pekerjaan saya sudah sesuai";
        }
        if ($data['f1603'] == 'Di pekerjaan ini saya memeroleh prospek karir yang baik') {
            $result['f1603'] = "1-Di pekerjaan ini saya memeroleh prospek karir yang baik";
        } else {
            $result['f1603'] = "0- Pekerjaan saya sudah sesuai";
        }

        if ($data['f1604'] == 'Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya') {
            $result['f1604'] = "1-Saya lebih suka bekerja di area pekerjaan yang tidak ada hubungannya dengan pendidikan saya'";
        } else {
            $result['f1604'] = "0-Pekerjaan saya sudah sesuai";
        }

        if ($data['f1605'] == 'Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya') {
            $result['f1605'] = "1-Saya dipromosikan ke posisi yang kurang berhubungan dengan pendidikan saya dibanding posisi sebelumnya";
        } else {
            $result['f1605'] = "0-Pekerjaan saya sudah sesuai";
        }

        if ($data['f1606'] == 'Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini') {
            $result['f1606'] = "1-Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini";
        } else {
            $result['f1606'] = "0-Pekerjaan Saya Sudah Sesuai";
        }

        if ($data['f1607'] == 'Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini') {
            $result['f1607'] = "1-Saya dapat memeroleh pendapatan yang lebih tinggi di pekerjaan ini";
        } else {
            $result['f1607'] = "0-Pekerjaan Saya Sudah Sesuai";
        }

        if ($data['f1608'] == "Pekerjaan saya saat ini lebih menarik") {
            $result['f1608'] = "1-Pekerjaan saya saat ini lebih menarik";
        } else {
            $result['f1608'] = "0-Pekerjaan Saya Sudah Sesuai";
        }

        if ($data['f1609'] == "Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel, dll") {
            $result['f1609'] = "1-Pekerjaan saya saat ini lebih memungkinkan saya mengambil pekerjaan tambahan/jadwal yang fleksibel, dll";
        } else {
            $result['f1609'] = "0-Pekerjaan Saya Sudah Sesuai";
        }

        if ($data['f1610'] == "Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya") {
            $result['f1610'] = "1-Pekerjaan saya saat ini lokasinya lebih dekat dari rumah saya";
        } else {
            $result['f1610'] = "0-Pekerjaan Saya Sudah Sesuai";
        }

        if ($data['f1611'] == "Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya") {
            $result['f1611'] = "1-Pekerjaan saya saat ini dapat lebih menjamin kebutuhan keluarga saya";
        } else {
            $result['f1611'] = "0-Pekerjaan Saya Sudah Sesuai";
        }

        if ($data['f1612'] == "Pada awal meniti karir ini, saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya") {
            $result['f1612'] = "1-Pada awal meniti karir ini, saya harus menerima pekerjaan yang tidak berhubungan dengan pendidikan saya";
        } else {
            $result['f1612'] = "0-Pekerjaan Saya Sudah Sesuai";
        }

        if ($data['f1613'] == "Lainnya") {
            $result['f1613'] = "1-Lainnya";
        } else {
            $result['f1613'] = "0-Pekerjaan Saya Sudah Sesuai";
        }
        return $result;
    }


    private function castToHowToFindJob($data)
    {
        $result = [];

        if ($data['f401'] == 'Ya') {
            $result['f401'] = "1-Ya";
        } else {
            $result['f401'] = "0-Tidak";
        }

        if ($data['f402'] == 'Ya') {
            $result['f402'] = "1-Ya";
        } else {
            $result['f402'] = "0-Tidak";
        }

        if ($data['f403'] == 'Ya') {
            $result['f403'] = "1-Ya";
        } else {
            $result['f403'] = "0-Tidak";
        }

        if ($data['f404'] == 'Ya') {
            $result['f404'] = "1-Ya";
        } else {
            $result['f404'] = "0-Tidak";
        }

        if ($data['f405'] == 'Ya') {
            $result['f405'] = "1-Ya";
        } else {
            $result['f405'] = "0-Tidak";
        }

        if ($data['f406'] == 'Ya') {
            $result['f406'] = "1-Ya";
        } else {
            $result['f406'] = "0-Tidak";
        }

        if ($data['f407'] == 'Ya') {
            $result['f407'] = "1-Ya";
        } else {
            $result['f407'] = "0-Tidak";
        }

        if ($data['f408'] == 'Ya') {
            $result['f408'] = "1-Ya";
        } else {
            $result['f408'] = "0-Tidak";
        }

        if ($data['f409'] == 'Ya') {
            $result['f409'] = "1-Ya";
        } else {
            $result['f409'] = "0-Tidak";
        }

        if ($data['f410'] == 'Ya') {
            $result['f410'] = "1-Ya";
        } else {
            $result['f410'] = "0-Tidak";
        }

        if ($data['f411'] == 'Ya') {
            $result['f411'] = "1-Ya";
        } else {
            $result['f411'] = "0-Tidak";
        }

        if ($data['f412'] == 'Ya') {
            $result['f412'] = "1-Ya";
        } else {
            $result['f412'] = "0-Tidak";
        }

        if ($data['f413'] == 'Ya') {
            $result['f413'] = "1-Ya";
        } else {
            $result['f413'] = "0-Tidak";
        }

        if ($data['f414'] == 'Ya') {
            $result['f414'] = "1-Ya";
        } else {
            $result['f414'] = "0-Tidak";
        }

        if ($data['f415'] == 'Ya') {
            $result['f415'] = "1-Ya";
        } else {
            $result['f415'] = "0-Tidak";
        }

        if ($data['f416'] == 'Ya') {
            $result['f416'] = "1-Ya";
        } else {
            $result['f416'] = "0-Tidak";
        }

        return $result;
    }
}