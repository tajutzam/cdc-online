<?php



namespace App\Services;

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
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil menambahkan pekerjaan',
                    'data' => $data,
                    'code' => 201
                ], 201);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menambahkan pekerjaan baru ' . $th->getMessage(),
                    'code' => 500,
                    'data' => null
                ], 500);
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
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil menambahkan pekerjaan',
                    'data' => $data,
                    'code' => 201
                ], 201);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menambahkan pekerjaan baru ' . $th->getMessage(),
                    'code' => 500,
                    'data' => null
                ], 500);
            }
        }
    }


    public function showJobsUserLogin($id)
    {
        $data = $this->jobs->where('user_id', $id)->get()->toArray();
        return response()->json([
            'status' => true,
            'message' => 'Success fetch data',
            'data' => $data,
            'code' => 202
        ], 202);
    }

    public function updateJobsUserLogin($request, $userId)
    {
        // todo
        $data = $this->jobs->where('id', $request['jobs_id'])->where('user_id', $userId)->first();
        if (isset($data)) {
            try {
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
                    return response()->json([
                        "status" => true,
                        'message' => 'Berhasil memperbarui pekerjaan',
                        'data' => $updated,
                        'code' => 200
                    ], 200);
                } else {
                    return response()->json([
                        "status" => false,
                        'message' => 'Gagal memperbarui pekerjaan terjadi kesalahan',
                        'data' => $updated,
                        'code' => 400
                    ], 400);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    "status" => false,
                    'message' => 'Gagal memperbarui pekerjaan terjadi kesalahan ' . $th->getMessage(),
                    'data' => null,
                    'code' => 500
                ], 500);
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'jobs not found',
            'code' => 404,
            'data' => null
        ], 404);
    }

    public function removeJobsUserLogin($jobsId, $userId)
    {
        // todo
        $job = $this->jobs->where('id', $jobsId)->where('user_id', $userId)->first();
        if (isset($job)) {
            try {
                //code...
                $isDelete = $job->delete();
                return response()->json([
                    "status" => true,
                    "message" => "Berhasil menghapus data pekerjaan",
                    'data' => $isDelete,
                    'code' => 200
                ], 200);
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    "status" => false,
                    "message" => "Gagal menghapus data pekerjaan " . $th->getMessage(),
                    'data' => null,
                    'code' => 500
                ], 500);
            }
        }
        return response()->json([
            "status" => false,
            "message" => "Gagal menghapus data pekerjaan , pekerjaan tidak ditemukan",
            'data' => null,
            'code' => 404
        ], 404);
    }

    public function findByIdJobsUserLogin($userId, $jobsId)
    {
        $job = $this->jobs->where('id', $jobsId)->where('user_id', $userId)->get()->toArray();
        if (sizeof($job) > 0) {
            return response()->json([
                'status' => true,
                'message' => 'Success fetch data',
                'data' => $job[0],
                'code' => 202
            ], 202);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Gagal fetch data , jobs tidak ditemukan",
                'data' => null,
                'code' => 404
            ], 404);
        }
    }

}