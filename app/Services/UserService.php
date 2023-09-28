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
        $user = $this->findUserByToken($token);
        if ($user == null) {
            return response()->json([
                'status' => false,
                'message' => 'your token is not valid',
                'data' => null
            ], 401);
        }
        // dd($request['type']);
        if ($request['type'] != 'email' && $request['type'] != 'nik' && $request['type'] != 'no_telp' && $request['type'] != 'ttl' && $request['type'] != 'alamat') {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'tipe tidak valid , tolong pilih email , nik , no_telp , ttl , atau alamat'
            ], 400);
        }
        $key = "";
        switch ($request['type']) {
            case "email":
                $key = 'visible_email';
                break;
            case "nik":
                $key = "visible_nik";
                break;
            case "ttl":
                $key = "visible_ttl";
                break;
            case "no_telp":
                $key = "visible_no_telp";
                break;
            case "alamat":
                $key = "visible_alamat";
                break;
        }
        try {
            //code...
            $updated = $this->userModel->where('token', $token)->update([
                $key => $request['value'] == 1 ? true : false,
            ]);
            return response()->json([
                "status" => true,
                "code" => 200,
                "message" => "berhasil memperbarui visibility " . $request['type'],
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
            $user = User::find($userByToken['id']);
            $followers = $this->follower->where('user_id', $user->id)->get()->toArray();
            foreach ($followers as $follower) {
                # code... iterate to find detail users
                $tempUser = User::find($follower['folowers_id']);
                $temp = $this->castToUserResponse($tempUser);
                array_push($data, $temp);
            }
            return response()->json(
                [
                    'status' => true,
                    'message' => 'success fetch data',
                    'data' => [
                        'total_followers' => sizeof($data),
                        'followers' => $data
                    ],
                    'code' => 200
                ],
                200
            );
        } else {
            return response()->json([
                'status' => false,
                'message' => 'your token is not valid',
                'data' => null,
                'code' => 401
            ], 401);
        }
    }

    public function findAllFollowersByIdUser($id)
    {
        $user = User::find($id);
        $data = [];
        if (isset($user)) {
            $user = User::find($id);
            $followers = $this->follower->where('user_id', $user->id)->get()->toArray();
            foreach ($followers as $follower) {
                # code... iterate to find detail users
                $tempUser = User::find($follower['folowers_id']);
                $temp = $this->castToUserResponse($tempUser);
                array_push($data, $temp);
            }
            return response()->json(
                [
                    'status' => true,
                    'message' => 'success fetch data',
                    'data' => [
                        'total_followers' => sizeof($data),
                        'followers' => $data
                    ],
                    'code' => 200
                ],
                200
            );
        } else {
            return response()->json([
                'status' => false,
                'message' => 'user id not found',
                'data' => null,
                'code' => 400
            ], 400);
        }
    }
}