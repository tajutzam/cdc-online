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
            return [
                "fullname" => $user->fullname,
                "email" => $user->email,
                "nik" => $user->nik,
                "no_telp" => $user->no_telp,
                "foto" => $user->foto
            ];
        } else {
            return null;
        }
    }

}