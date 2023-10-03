<?php


namespace App\Services;

use App\Models\Followed;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserService
{
    private User $userModel;
    private Follower $follower;
    private Followed $followed;

    public function __construct()
    {
        $this->userModel = new User();
        $this->follower = new Follower();
        $this->followed = new Followed();
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


    public function findAllUser($pageNumber) // need pagination 
    {

        $perPage = 10; // Jumlah item per halaman, sesuaikan dengan kebutuhan Anda

        $pagination = $this->userModel->with('jobs', 'educations', 'followers')->paginate($perPage, ['*'], 'page', $pageNumber);
        $data = $pagination->items();
        $responsePojo = [
            "total_page" => $pagination->lastPage(),
            "total_items" => $pagination->total()
        ];
        foreach ($data as $key => $value) {
            $followersIds = collect($value['followers'])->pluck('folowers_id')->toArray();
            $followers = [];
            $userData = $this->castToUserResponseFromArray($value);

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
                'user' => $userData,
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
            'twiter' => $user->twiter,
            'account_status' => $user->account_status
        ];
    }

    private function castToUserResponseFromArray($user)
    {
        return [
            "id" => $user['id'],
            "fullname" => $user['visible_fullname'] == 1 ? $user['fullname'] : "***",
            "email" => $user['visible_email'] == 1 ? $user['email'] : "***",
            "nik" => $user['visible_nik'] == 1 ? $user['nik'] : "***",
            "no_telp" => $user['visible_no_telp'] == 1 ? $user['no_telp'] : "***",
            "foto" => $user['foto'],
            'alamat' => $user['visible_alamat'] == 1 ? $user['alamat'] : "***",
            "about" => $user['about'],
            "gender" => $user['gender'],
            "level" => $user['level'],
            "linkedin" => $user['linkedin'],
            "facebook" => $user['facebook'],
            "instagram" => $user['instagram'],
            'twiter' => $user['twiter'],
            'account_status' => $user['account_status']
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

    public function followUser($idUserLogin, $userId)
    {
        $userFollower = $this->userModel->where('id', $userId)->first();
        if (isset($userFollower)) {
            try {
                $isFolowed = $this->followed->where('user_id', $userId)->where('folowed_id', $idUserLogin)->first();
                if (isset($isFolowed)) {
                    // jika user sudah memfolow
                    return response()->json([
                        'status' => false,
                        'message' => 'Ops , kamu sudah mengikuti user tersebut',
                        'code' => 400,
                        'data' => 0
                    ], 400);
                } else {
                    try {
                        //code...
                        $isCreated = $this->followed->create([
                            'user_id' => $userId,
                            "folowed_id" => $idUserLogin
                        ]);
                        if (isset($isCreated)) {
                            $isCreatedFolowers = $this->follower->create([
                                'user_id' => $userId,
                                "folowers_id" => $idUserLogin
                            ]);
                            if (isset($isCreatedFolowers)) {
                                return response()->json([
                                    'status' => true,
                                    'message' => 'berhasil mengikuti user',
                                    'data' => $isCreated,
                                    'code' => 201
                                ], 201);
                            } else {
                                DB::rollBack();
                                return response()->json([
                                    'status' => true,
                                    'message' => 'gagal mengikuti user',
                                    'data' => $isCreated,
                                    'code' => 500
                                ], 500);
                            }
                        }
                    } catch (\Throwable $th) {
                        DB::rollback();
                        //throw $th;
                        return response()->json([
                            'status' => false,
                            'message' => 'Gagal mengikuti user ' . $th->getMessage(),
                            'code' => 500,
                            'data' => 0
                        ], 500);
                    }
                }
            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal mengikuti user ' . $th->getMessage(),
                    'code' => 500,
                    'data' => 0
                ], 500);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengikuti user , user tidak ditemukan',
                'code' => 404,
                'data' => null
            ], 404);
        }
    }

    public function unfollowUser($idUserLogin, $userId): JsonResponse
    {
        $tempFolowed = $this->followed->where('user_id', $userId)->where('folowed_id', $idUserLogin)->first();
        if (isset($tempFolowed)) {
            try {
                //code...
                $isDelete = $tempFolowed->delete();
                if ($isDelete) {
                    $checkUserFolower = $this->follower->where('user_id', $userId)->where('folowers_id', $idUserLogin)->first();
                    if (isset($checkUserFolower)) {
                        // remove user 
                        $isUnfollow = $checkUserFolower->delete();
                        if ($isUnfollow) {
                            return response()->json([
                                'status' => true,
                                'message' => 'berhasil unfollow user',
                                'code' => 200,
                                'data' => $isDelete
                            ], 200);
                        } else {
                            return response()->json([
                                'status' => false,
                                'message' => 'Gagal berhenti mengikuti , user sudah berhenti mengikuti',
                                'code' => 400,
                                'data' => null
                            ], 400);
                        }
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Gagal berhenti mengikuti , user sudah berhenti mengikuti',
                            'code' => 400,
                            'data' => null
                        ], 400);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Gagal unfollow user',
                        'code' => 400,
                        'data' => $isDelete
                    ], 200);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Gagal unfollow user ' . $th->getMessage(),
                        'code' => 500,
                        'data' => null
                    ],
                    500
                );
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal unfollow user , user tidak ditemukan',
                'data' => null,
                'code' => 404
            ], 404);
        }
    }

    public function showUserFollowed($id)
    {
        $response = [];
        $user = $this->userModel->where('id', $id)->first();
        $response = $this->castToUserResponse($user);
        $response['followed'] = [];
        $followersIds = User::join('folowed', 'users.id', '=', 'folowed.folowed_id')
            ->where('users.id', $id)
            ->pluck('folowed.user_id')
            ->toArray();
        $usersByFollowersId = User::whereIn('id', $followersIds)->get();
        foreach ($usersByFollowersId as $user) {
            $tempUser = $this->castToUserResponse($user);
            array_push($response['followed'], $tempUser);
        }
        return response()->json([
            'status' => true,
            'messages' => 'success fetch data',
            'data' => [
                'total_followers' => sizeof($response['followed']),
                'user' => $response
            ],
            'code' => 200
        ], 200);
    }

    public function updateUserLogin($request, $userId)
    {
        try {


            //code...
            $isUpdate = $this->userModel->where('id', $userId)->update([

                'fullname' => $request['fullname'],
                'ttl' => $request['ttl'],
                'about' => $request['about'],
                'linkedin' => $request['linkedin'],
                'instagram' => $request['instagram'],
                'twiter' => $request['x'],
                'facebook' => $request['facebook'],
                'no_telp' => $request['no_telp'],
                'gender' => $request['gender'],
                'alamat' => $request['alamat'],
                'nik' => $request['nik']

            ]);
            if ($isUpdate) {
                return response()->json([
                    'status' => true,
                    'message' => 'Success memperbarui profile',
                    'data' => $isUpdate,
                    'code' => 200
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal memperbarui profile',
                    'data' => $isUpdate,
                    'code' => 400
                ], 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => 'Gagal memperbarui profile ' . $th->getMessage(),
                'data' => null,
                'code' => 500
            ], 500);
        }
    }

    public function updateFotoProfile($request)
    {

    }
}