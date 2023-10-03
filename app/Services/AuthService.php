<?php


namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Education;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthService
{

    private User $user;

    private Education $education;

    private EmailService $emailService;

    private UserService $userService;



    public function __construct()
    {
        $this->education = new Education();
        $this->emailService = new EmailService();
        $this->user = new User();
        $this->userService = new UserService();
    }

    public function login($emailOrNikRequest, $password)
    {
        $data = $this->user->where('email', $emailOrNikRequest)->first();
        if (isset($data)) {
            $isMatch = Hash::check($password, $data->password);
            if ($isMatch) {
                if ($data->email_verivied) {
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
                        "message" => "Gagal login , akun anda belum di aktifasi",
                        "code" => 400,
                        "data" => null
                    ];
                    return response($response, 400, ['Content-type' => 'application/json']);
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
            $expired = Carbon::now()->addHour();
            $user = $this->user->create([
                "fullname" => $request['fullname'],
                "email" => $request['email'],
                "no_telp" => $request['no_telp'],
                "nik" => $request['nik'],
                "password" => Hash::make($request['password']),
                'level' => 'user',
                "alamat" => $request['alamat'],
                'expire_email' => $expired
            ]);
            $isCreated = $this->education->create([
                'user_id' => $user->id,
                'perguruan' => 'Politeknik Negeri Jember'
            ]);
            if (isset($isCreated)) {
                $link = url('/') . '/api/user/verivication/email?id=' . "$user->id";
                // user berhasil registrasi , kirim email
                $this->emailService->sendEmailVerifikasi($user->email, $link, $expired->format('F j - H:i'));
            }
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }


    public function updateVeriviedEmail($id)
    {
        $user = $this->user->where('id', $id)->first();
        if (Carbon::now()->greaterThan($user->expire_email)) {
            return view('emails.expire', ['resendLink' => 'localhost:8000/api/users']);
        } else {
            $value = $this->userService->updateEmailVerivied($id, true);
            if ($value['status']) {
                return view('emails.success-verivied');
            } else {
                if ($value['code'] == 404) {
                    return view('emails.error-verivied', ['data' => 'Ops , akunmu gagal diverifikasi , user tidak ditemukan']);
                } else if ($value['code'] == 102) {
                    return view('emails.error-verivied', ['data' => 'Akun mu sudah diverifikasi silahkan login']);
                } else if ($value['code'] == 103) {
                    return view('emails.error-verivied', ['data' => 'Ops , akunmu gagal diverifikasi , terjadi kesalahan']);
                }
            }
        }
    }

}