<?php



namespace App\Services;

use App\Models\Jobs;

class JobsService
{

    private Jobs $jobs;

    public function __construct()
    {
        $this->jobs = new Jobs();
    }


    public function addNewJobs($request, $userId)
    {

        $isActiveJobs = $request['is_jobs_now'];

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
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menambahkan pekerjaan baru ' . $th->getMessage(),
                    'code' => 500,
                    'data' => null
                ], 500);
            }
        }
    }


    private function castToJobsPojo()
    {

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

}