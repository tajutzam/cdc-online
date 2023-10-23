<?php


namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Education;
use App\Models\QuisionerProdi;
use App\Models\User;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class AuthService
{

    private User $user;

    private Education $education;

    private EmailService $emailService;


    private UserService $userService;


    private QuisionerProdi $prodi;

    public function __construct()
    {
        $this->education = new Education();
        $this->emailService = new EmailService();
        $this->user = new User();
        $this->userService = new UserService();
        $this->prodi = new QuisionerProdi();
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

        DB::beginTransaction();
        $prodi = $this->prodi->where('id', $request['kode_prodi'])->first();
        if (!isset($prodi)) {
            throw new NotFoundException('ops, prodi tidak ditemukan');
        }
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
                'expire_email' => $expired,
                'nim' => $request['nim'],
                'kode_prodi' => $request['kode_prodi']
            ]);
            $isCreated = $this->education->create([
                'user_id' => $user->id,
                'perguruan' => 'Politeknik Negeri Jember',
                'prodi' => $request['kode_prodi']
            ]);
            if (isset($isCreated)) {
                DB::commit();
                $link = url('/') . '/api/user/verivication/email?id=' . "$user->id";
                // user berhasil registrasi , kirim email
                $this->emailService->sendEmailVerifikasi($user->email, $link, $expired->format('F j - H:i'));
            }
            return true;
        } catch (\Throwable $th) {
            Db::rollBack();
            throw new Exception($th->getMessage()); //throw $th;
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


    public function verifikasiNim($nim)
    {

        $header = [
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzNyIsImp0aSI6IjA1OTYxNjYzNjkxOGNkZTc0YWEwYmUwMzVjNmZkYzIyY2I3NDdlNTM3ZjU4OGE1NjA0YzViMGRlZTMwOGExNWM2ODI1YjNjN2YyZDhlMGVhIiwiaWF0IjoxNjk4MDI4ODM4LjgxODM4MiwibmJmIjoxNjk4MDI4ODM4LjgxODM4NywiZXhwIjoxNjk4MTE1MjM4LjgxMjIwNywic3ViIjoiIiwic2NvcGVzIjpbXX0.c0e3MM-M-Z5CgVts0F_GEZhBtzkRdU1W4_mz1CM-6lsoE4Kw47c8yqL8p1TJM2_TWXusTfEF3SxR4o2F60nbMwrUnB6XGyRCqdrxKqSAdgOByNdPvni0NxadRAu-b5Up0XVwN0uaKhV6qAns9LTVV7gVXydQNOAk6uqjQ3Mi4ruQ1UWaiSvWg4PAoOvnRSWG1QTURTZUgo2fJtoCqlDxqkbGk_5xm7Eu9YPcq8wBB0tp6IS0m3Eacqypj4nSF5kf9F9A1esVNzv26rS-SwuAEa_WYw58g1YliITrOr_ODZui4rFYVLscWHDTyNrY5i2pgjpQdzIM5dIKKxWFA_F7K5oRHlsNfoNg8s5nvk6Hrl6KtCBDQoO7WDdMt-4n6VOYUdW5klLyCWMC12YN4xWNY6XUZUVF2HAohWBmaMeuaTo9IqWCMfBksnslZ2rDn12ikTKaZ5Zg9w4w1UNd5J-9DM6ykps639jFAy14ooGW__Y2X-_AvmDoG1zkk6yQaedKot65h_ORRTrbvLXVnfGpWuqc3LSPH6zS7BhdO2gcnqoeLC7Aaz53Y6_5aorQTzEqlpgqUZTzq7iqkzk4n4eHQ0zleUepHZ1DYx2fIQkgIiGOAXcwevuu-bmsybrj8kz8T7Hl2s4pVZBLi06RYA20sx65BGH-zr2LRJ_AJvp3nIY'
        ];
        $response = Http::withHeaders($header)->get('http://api.polije.ac.id/resources/akademik/mahasiswa?debug=true&nim=e41211674');
        echo $response;
    }

    public function generateToken()
    {

        $grant_type = env('TOKEN_API_GRANT_TYPE');
        $client_id = env('TOKEN_API_CLIENT_ID');
        $client_secreet = env('TOKEN_API_CLIENT_SCREET');

        if (!isset($grant_type) || !isset($client_id) || !isset($client_secreet)) {
            throw new Exception('ops , your env not included the token');
        }

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'http://api.polije.ac.id/oauth/token',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('grant_type' => $grant_type, 'client_id' => $client_id, 'client_secret' => $client_secreet),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

}