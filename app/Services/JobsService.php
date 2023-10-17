<?php



namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\DB;

class JobsService
{

    private \App\Models\Jobs $jobs;

    public function __construct()
    {
        $this->jobs = new \App\Models\Jobs();
    }


    public function addNewJobs($request, $userId)
    {

        $isActiveJobs = $request['is_jobs_now'];
        DB::beginTransaction();

        if ($isActiveJobs) {
            try {
                $data = $this->jobs->create([
                    'user_id' => $userId,
                    'perusahaan' => $request['perusahaan'],
                    'jabatan' => $request['jabatan'],
                    'gaji' => $request['gaji'],
                    'jenis_pekerjaan' => $request['jenis_pekerjaan'],
                    'tahun_masuk' => $request['tahun_masuk'],
                    'pekerjaan_saatini' => true
                ]);
                Db::commit();
                return ResponseHelper::successResponse('Berhasil Menambahkan pekerjaan', $data, 201);

            } catch (\Throwable $th) {
                throw new \Exception('gagal menambahkan pekerjaan terjadi kesalahan');
            }
        } else {
            try {
                $data = $this->jobs->create([
                    'user_id' => $userId,
                    'perusahaan' => $request['perusahaan'],
                    'jabatan' => $request['jabatan'],
                    'gaji' => $request['gaji'],
                    'jenis_pekerjaan' => $request['jenis_pekerjaan'],
                    'tahun_masuk' => $request['tahun_masuk'],
                    'tahun_keluar' => $request['tahun_keluar'],
                    'pekerjaan_saatini' => false
                ]);
                Db::commit();
                return ResponseHelper::successResponse('Berhasil Menambahkan pekerjaan', $data, 201);
            } catch (\Throwable $th) {
                throw new \Exception('gagal menambahkan pekerjaan terjadi kesalahan');
            }
        }
    }


    public function showJobsUserLogin($id)
    {
        $data = $this->jobs->where('user_id', $id)->get()->toArray();
        return ResponseHelper::successResponse('Success fetch data', $data, 200);
    }

    public function updateJobsUserLogin($request, $userId)
    {
        // todo
        Db::beginTransaction();
        $data = $this->jobs->where('id', $request['jobs_id'])->where('user_id', $userId)->first();
        if (isset($data)) {
            $updated = $data->update([
                'perusahaan' => $request['perusahaan'],
                'jabatan' => $request['jabatan'],
                'gaji' => $request['gaji'],
                'jenis_pekerjaan' => $request['jenis_pekerjaan'],
                'tahun_masuk' => $request['tahun_masuk'],
                'tahun_keluar' => $request['is_jobs_now'] == true ? null : $request['tahun_keluar'],
                "pekerjaan_saatini" => $request['is_jobs_now']
            ]);
            if ($updated) {
                Db::commit();
                return ResponseHelper::successResponse('Berhasil memperbarui pekerjaan', $data, 200);
            }
            throw new \Exception('gagal Memperbarui pekerjaan terjadi kesalahan');
        }
        throw new NotFoundException('ops , jobs not found');
    }

    public function removeJobsUserLogin($jobsId, $userId)
    {
        // todo
        Db::beginTransaction();
        $job = $this->jobs->where('id', $jobsId)->where('user_id', $userId)->first();
        if (isset($job)) {
            try {
                //code...
                $isDelete = $job->delete();
                Db::commit();
                return ResponseHelper::successResponse('Berhasil memperbarui pekerjaan', $isDelete, 200);
            } catch (\Throwable $th) {
                throw new \Exception('gagal Memperbarui pekerjaan terjadi kesalahan');
            }
        }
        throw new NotFoundException('ops , jobs not found');
    }

    public function findByIdJobsUserLogin($userId, $jobsId)
    {
        $job = $this->jobs->where('id', $jobsId)->where('user_id', $userId)->get()->toArray();
        if (sizeof($job) > 0) {
            return ResponseHelper::successResponse('success fetch data', $job[0], 200);
        }
        throw new NotFoundException('ops , jobs not found');
    }

}