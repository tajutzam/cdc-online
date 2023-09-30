<?php


namespace App\Services;

use App\Models\Education;
use App\Models\User;

class EducationService
{

    private Education $education;

    private User $user;

    public function __construct()
    {
        $this->education = new Education();
        $this->user = new User();
    }

    public function addNewEducationUser($request , $userId)
    {
        // todo 
        $user = $this->user->where('id', $userId)->first();
        if (isset($user)) {
            try {
                //code...
                $educationUser = $this->education->create([
                    'user_id' => $user->id,
                    'perguruan' => $request['perguruan'],
                    'strata' => $request['strata'],
                    "jurusan" => $request['jurusan'],
                    "prodi" => $request['prodi'],
                    "tahun_masuk" => $request['tahun_masuk'],
                    "tahun_lulus" => $request['tahun_lulus'],
                    'no_ijasah' => $request['no_ijasah']
                ]);

                if (isset($educationUser)) {
                    unset($educationUser->user_id);
                    return response()->json([
                        'status' => true,
                        'messages' => 'Berhasil menambahkan pendidikan baru',
                        'data' => $educationUser->toArray(),
                        'code' => 201
                    ], 201, ['content-type' => 'application/json']);
                } else {
                    return response()->json([
                        'status' => false,
                        'code' => 400,
                        'messages' => 'Gagal menambahkan pendidikan baru',
                        'data' => null
                    ], 400);
                }
            } catch (\Throwable $th) {
                //throw $th;\
                return response()->json([
                    'status' => false,
                    'code' => 500,
                    'messages' => 'Gagal menambahkan pendidikan baru ,' . $th->getMessage(),
                    'data' => null
                ], 500);
            }
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'messages' => 'user id not found',
                'data' => null
            ], 400);
        }
    }

    public function updateEducationUser($request, $id, $educationId)
    {
        // todo

        $education = $this->education->where('id' , $educationId)->first(); // search education by id
        if (!isset($education)) {
            return response()->json([
                'status' => false,
                'messages' => 'Gagal memperbarui education , id tidak ditemukan',
                'data' => null,
                'code' => 400
            ], 400);
        }
        try {
            $data = $this->education
                ->where('id', $educationId) // id user
                ->where('user_id', $id)
                ->update([
                    'perguruan' => $request['perguruan'],
                    'strata' => $request['strata'],
                    "jurusan" => $request['jurusan'],
                    "prodi" => $request['prodi'],
                    "tahun_masuk" => $request['tahun_masuk'],
                    "tahun_lulus" => $request['tahun_lulus'],
                    'no_ijasah' => $request['no_ijasah']
                ]);
            if (isset($data)) {
                return response()->json([
                    'status' => true,
                    'messages' => 'Berhasil memperbarui Pendidikan',
                    'data' => $data,
                    'code' => 200
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'messages' => 'Berhasil memperbarui Pendidikan',
                    'data' => $data,
                    'code' => 400
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'messages' => 'Gagal memperbarui education ' . $th->getMessage(),
                'data' => $data,
                'code' => 500
            ], 500);
        }
    }

    public function showEducationUser($userId)
    {
        $educations = $this->education->where('user_id', $userId)->get();
        $data = [];
        foreach ($educations as $value) {
            # code...
            $tempEducation = $this->castToEducationFromArrayToPojo($value);
            array_push($data, $tempEducation);
        }
        return response()->json([
            'status' => true,
            'messages' => 'Success fetch data',
            'data' => $data,
            'code' => 200
        ], 200);
    }

    private function castToEducationFromArrayToPojo($education)
    {
        $strata = '';
        switch ($education['strata']) {
            case 'D3':
                $strata = 'D3 - Ahli Madya';
                break;
            case 'D4':
                $strata = 'D4 - Sarjana Terapan';
                break;
            case 'S1':
                $strata = 'S1 - Sarjana';
                break;
            case 'S2':
                $strata = 'S2 - Magister';
                break;
            case 'S3':
                $strata = 'S3 - Doctor';
                break;
        }
        return [
            'perguruan' => $education['perguruan'],
            'jurusan' => $education['jurusan'],
            'strata' => $strata,
            'no_ijasah' => $education['no_ijasah'],
            'prodi' => $education['prodi'],
            'tahun_masuk' => $education['tahun_masuk'],
            'tahun_lulus' => $education['tahun_lulus'],
            'id' => $education['id']
        ];
    }



}