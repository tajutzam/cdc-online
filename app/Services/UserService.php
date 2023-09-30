<?php


namespace App\Services;

use App\Models\Follower;
use App\Models\User;

class UserService
{
    private User $userModel;
    private Follower $follower;


    public function __construct()
    {
        $this->userModel = new User();
        $this->follower = new Follower();
    }


    public function findUserByToken($token)
    {
        $data = $this->userModel->with('jobs', 'educations', 'followers')->where('token', $token)->get()->toArray();
        $responsePojo = [];

        $user = $this->userModel->where('token', $token)->first();

        $userPojo = $this->castToUserResponse($user);
        foreach ($data as $key => $value) {
            $followersIds = collect($value['followers'])->pluck('folowers_id')->toArray();
            $followers = [];
            // Mengambil data jobs dan educations dari $value
            $jobs = $value['jobs'];
            $educations = $value['educations'];
            $educationData = [];

            $usersByFollowersId = User::whereIn('id', $followersIds)->get();
            foreach ($usersByFollowersId as $user) {
                $tempFolowers = $this->castToUserResponse($user);
                array_push($followers, $tempFolowers);
            }

            // cast to education pojo
            foreach ($educations as $key => $value) {
                # code...
                $tempEducation = $this->castToEducations($value);
                array_push($educationData, $tempEducation);
            }
            // Menyimpan hanya followers.folowers_id dalam array $tempUser
            $tempUser = [
                'user' => $userPojo,
                'followers' => $followers,
                'jobs' => $jobs,
                'educations' => $educationData,
            ];
            $responsePojo = $tempUser;
        }
        return $responsePojo;
    }


    public function findAllUser()
    {
        $data = $this->userModel->with('jobs', 'educations', 'followers')->get()->toArray();
        $responsePojo = [];

        foreach ($data as $key => $value) {
            $followersIds = collect($value['followers'])->pluck('folowers_id')->toArray();
            $followers = [];
            // Mengambil data jobs dan educations dari $value
            $jobs = $value['jobs'];
            $educations = $value['educations'];
            $educationData = [];

            $usersByFollowersId = User::whereIn('id', $followersIds)->get();
            foreach ($usersByFollowersId as $user) {
                $tempFolowers = $this->castToUserResponse($user);
                array_push($followers, $tempFolowers);
            }

            // cast to education pojo
            foreach ($educations as $key => $value) {
                # code...
                $tempEducation = $this->castToEducations($value);
                array_push($educationData, $tempEducation);
            }
            // Menyimpan hanya followers.folowers_id dalam array $tempUser
            $tempUser = [
                'followers' => $followers,
                'jobs' => $jobs,
                'educations' => $educationData,
            ];
            array_push($responsePojo, $tempUser);
        }
        return $responsePojo;
    }




    public function updateVisible($request, $token)
    {

        $key = [];

        foreach ($request['type'] as $value) {
            # code...
            if ($value['key'] != 'email' && $value['key'] != 'nik' && $value['key'] != 'no_telp' && $value['key'] != 'ttl' && $value['key'] != 'alamat') {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => 'tipe tidak valid , tolong pilih email , nik , no_telp , ttl , atau alamat'
                ], 400);
            }

            switch ($value['key']) {
                case "email":
                    array_push($key, [
                        'visible_email' => $request['value']
                    ]);
                    break;
                case "nik":
                    array_push($key, [
                        "visible_nik" => $request['value']
                    ]);
                    break;
                case "ttl":
                    array_push($key, ["visible_ttl" => $request['value']]);
                    break;
                case "no_telp":
                    array_push($key, ["visible_no_telp" => $request['value']]);
                    break;
                case "alamat":
                    array_push($key, ["visible_alamat" => $request['value']]);
                    break;
            }
        }
        $finalKey = [];

        foreach ($key as $item) {
            foreach ($item as $key => $value) {
                // Remove the "visible_" prefix and convert the key to camelCase
                $finalKey[$key] = $value;
            }
        }
        // dd($finalKey);
        try {
            //code...
            $updated = $this->userModel->where('token', $token)->update($finalKey);
            return response()->json([
                "status" => true,
                "code" => 200,
                "message" => "berhasil memperbarui visibility ",
                "data" => $updated
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function findAllFolowersLogin($token)
    {
        $data = [];
        $followersIds = User::join('folowers', 'users.id', '=', 'folowers.user_id')
            ->where('users.token', $token)
            ->pluck('folowers.folowers_id') // retrive all folowers_id , where users.token == $token
            ->toArray();
        $usersByFollowersId = User::whereIn('id', $followersIds)->get();
        foreach ($usersByFollowersId as $user) {
            $tempUser = $this->castToUserResponse($user);
            array_push($data, $tempUser);
        }
        return response()->json([
            'status' => true,
            'messages' => 'success fetch data',
            'data' => [
                'total_followers' => sizeof($data),
                'followers' => $data
            ],
            'code' => 200
        ], 200);
    }




    public function findAllFollowersByUserId($id)
    {
        $response = [];
        $user = $this->userModel->where('id', $id)->first();
        if ($user == null) {
            return response()->json([
                'status' => false,
                'messages' => 'failed fetch data , user not found',
                'data' => null,
                'code' => 404
            ], 404);
        }
        $response = $this->castToUserResponse($user);
        $response['followers'] = [];
        $followersIds = User::join('folowers', 'users.id', '=', 'folowers.user_id')
            ->where('users.id', $id)
            ->pluck('folowers.folowers_id')
            ->toArray();
        $usersByFollowersId = User::whereIn('id', $followersIds)->get();
        foreach ($usersByFollowersId as $user) {
            $tempUser = $this->castToUserResponse($user);
            array_push($response['followers'], $tempUser);
        }
        return response()->json([
            'status' => true,
            'messages' => 'success fetch data',
            'data' => [
                'total_followers' => sizeof($response['followers']),
                'user' => $response
            ],
            'code' => 200
        ], 200);
    }



    public function extractUserId($token): string
    {
        $user = $this->findUserByToken($token);
        return $user['user']['id'];
    }

    private function castToUserResponse($user)
    {
        return [
            "id" => $user->id,
            "fullname" => $user->visible_fullname == 1 ? $user->fullname : "***",
            "email" => $user->visible_email == 1 ? $user->email : "***",
            "nik" => $user->visible_nik == 1 ? $user->nik : "***",
            "no_telp" => $user->visible_no_telp == 1 ? $user->no_telp : "***",
            "foto" => $user->foto,
            'alamat' => $user->visible_alamat == 1 ? $user->alamat : "***",
            "about" => $user->about,
            "gender" => $user->gender,
            "level" => $user->level,
            "linkedin" => $user->linkedin,
            "facebook" => $user->facebook,
            "instagram" => $user->instagram,
            'twiter' => $user->twiter
        ];
    }

    private function castToEducations($education)
    {
        $strata = '';
        switch ($education['strata']) {
            case "D3":
                $strata = "D3 - Ahli Madya";
                break;
            case "D4":
                $strata = "D4 - Sarjana Terapan";
                break;
            case "S1":
                $strata = "S1 - Sarjana";
                break;
            case "S2":
                $strata = "S2 - Magister ";
                break;
            case "S3":
                $strata = "S3 - Doctor";
                break;
            default:
                $strata = $education['strata'];
                break;
        }

        return [
            "perguruan" => $education['perguruan'],
            "strata" => $strata,
            "jurusan" => $education['jurusan'],
            "prodi" => $education['prodi'],
            "tahun_masuk" => $education['tahun_masuk'],
            "tahun_lulus" => $education['tahun_lulus'],
            "id" => $education['id'],
            "no_ijasah" => $education['no_ijasah'],
        ];



    }


}