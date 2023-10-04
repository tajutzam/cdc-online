<?php


namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\FurtheStudy;
use App\Models\Identity;
use App\Models\MainSection;
use App\Models\QuisionerLevel;
use App\Models\QuisionerProdi;
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

    public function __construct()
    {
        $this->identity = new Identity();
        $this->quisionerProdi = new QuisionerProdi();
        $this->quisionerLevel = new QuisionerLevel();
        $this->mainSection = new MainSection();
        $this->furtheStudy = new FurtheStudy();
        $this->user = new User();
    }


    public function addQuisionerIdentity($request, $userId)
    {
        Db::beginTransaction();
        try {
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
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'status' => false,
                'code' => $th->getCode(),
                'message' => 'gagal mengisi kuisioner ' . $th->getMessage(),
                'data' => null
            ], $th->getCode());
        }
    }

    public function addQuisionerMain($request, $userId)
    {
        DB::beginTransaction();
        try {
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
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'status' => false,
                'code' => $th->getCode() == 0 ? 500 : $th->getCode(),
                'message' => 'gagal mengisi kuisioner ' . $th->getMessage(),
                'data' => null
            ], $th->getCode());
        }
    }


    public function addQuisionerFurtheStudy($request, $userId)
    {
        DB::beginTransaction();
        try {
            //code...
            $quisionerLevel = $this->findQuisionerLevelByUserId($userId);
            if (isset($quisionerLevel)) {
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
                            $isUpdateUser = $user->update([
                                'account_status' => 'beginner'
                            ]);
                            if ($isUpdateUser) {
                                DB::commit();
                                return $this->successResponse(['quis_terjawab' => $isCreated], 201, 'Berhasil mengisi kuisioner');
                            } else {
                                throw new NotFoundException('gagal mengisi quisioner , user tidak ditemukan', 404);
                            }
                        }
                        throw new Exception('Gagal untuk mengisi kuisioner , terjadi keslaahan', 500);
                    } else {
                        throw new Exception('Gagal untuk mengisi kuisioner , terjadi keslaahan', 500);
                    }

                }
                throw new BadRequestException('Harap isi quisioner sebelumnya terlebih dahulu', 400);
            }
            throw new NotFoundException('qusioner level not found', 404);
        } catch (\Throwable $th) {
            //throw $th;
            Db::rollBack();
            return response()->json([
                'status' => false,
                'code' => $th->getCode() == 0 ? 500 : $th->getCode(),
                'message' => 'gagal mengisi kuisioner ' . $th->getMessage(),
                'data' => null
            ], $th->getCode());
        }
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