<?php


namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthService
{

    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function login($emailOrNikRequest, $password)
    {
        $data = $this->user->where('email', $emailOrNikRequest)->first();
        if (isset($data)) {
            $isMatch = Hash::check($password, $data->password);
            if ($isMatch) {
                $token = $this->createNewToken($data->id);
                $response = [
                    "status" => true,
                    "message" => "Berhasil Login",
                    "code" => 200,
                    "data" => [
                        "token" => $token
                    ]
                ];
                return response($response, 200, ['Content-type' => 'application/json']);

            } else {
                $response = [
                    "status" => false,
                    "message" => "Gagal login , harap check email , nik , atau password anda",
                    "code" => 401,
                    "data" => null
                ];
                return response($response, 401, ['Content-type' => 'application/json']);
            }
        } else {
            $data = $this->user->where('nik', $emailOrNikRequest)->first();
            if (isset($data)) {
                $isMatch = Hash::check($password, $data->password);
                if ($isMatch) {
                    $token = $this->createNewToken($data->id);
                    $response = [
                        "status" => true,
                        "message" => "Berhasil Login",
                        "code" => 200,
                        "data" => [
                            "token" => $token
                        ]
                    ];

                    return response($response, 200, ['Content-type' => 'application/json']);

                } else {
                    $response = [
                        "status" => false,
                        "message" => "Gagal login , harap check email , nik , atau password anda",
                        "code" => 401,
                        "data" => null
                    ];
                    return response($response, 401, ['Content-type' => 'application/json']);
                }
            } else {
                $response = [
                    "status" => false,
                    "message" => "Gagal login , harap check email , nik , atau password anda",
                    "code" => 401,
                    "data" => null
                ];
                return response($response, 401, ['Content-type' => 'application/json']);
            }
        }
    }

    private function createNewToken($id)
    {
        $token = Str::random(150);
        $this->user->where('id', $id)->update([
            'token' => $token,
            'token_expire' => Carbon::now()->addWeek() // expire token 1 week
        ]);
        return $token;
    }

    public function registerUser(array $request)
    {
        try {
            //code...
            $this->user->create([
                "fullname" => $request['fullname'],
                "email" => $request['email'],
                "no_telp" => $request['no_telp'],
                "nik" => $request['nik'],
                "password" => Hash::make($request['password']),
                'level' => 'user',
                "alamat" => $request['alamat']
            ]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }


}