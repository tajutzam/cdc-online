<?php


namespace App\Services;

use App\Models\User;

class UserService
{


    private User $userModel;


    public function __construct()
    {
        $this->userModel = new User();
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
            "fullname" => $user->visible_fullname == 1 ? $user->fullname : "***",
            "email" => $user->visible_email == 1 ? $user->email : "***",
            "nik" => $user->visible_nik == 1 ? $user->nik : "***",
            "no_telp" => $user->visible_no_telp == 1 ? $user->no_telp : "***",
            "foto" => $user->foto,
        ];
    }

}