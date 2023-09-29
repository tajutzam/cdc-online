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
        $user = $this->userModel->where('token', $token)->first();
        if (isset($user)) {
            return $this->castToUserResponse($user);
        } else {
            return null;
        }
    }

    public function findAllUser()
    {
        $users = $this->userModel->get();
        $response = [];
        foreach ($users as $user) {
            # code...
            $userCast = $this->castToUserResponse($user);
            array_push($response, $userCast);
        }
        return $response;

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
            "level" => $user->level
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
            "level" => $user['level']
        ];
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
        $userByToken = $this->findUserByToken($token);
        $data = [];
        if (isset($userByToken)) {
            $data = [];
            $followersIds = User::join('folowers', 'users.id', '=', 'folowers.user_id')
                ->where('users.id', $userByToken['id'])
                ->pluck('folowers.folowers_id')
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
        } else {
            return response()->json([
                'status' => false,
                'message' => 'your token is not valid',
                'data' => null,
                'code' => 401
            ], 401);
        }
    }


    public function findAllFollowersByUserId($id)
    {
        $data = [];
        $followersIds = User::join('folowers', 'users.id', '=', 'folowers.user_id')
            ->where('users.id', $id)
            ->pluck('folowers.folowers_id')
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

    public function extractUserId($token): string
    {
        $user = $this->findUserByToken($token);
        return $user['id'];
    }
}