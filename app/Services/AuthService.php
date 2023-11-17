<?php


namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Exceptions\WebException;
use App\Helper\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Alumni;
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
use Throwable;

class AuthService
{

    private User $user;

    private Education $education;

    private EmailService $emailService;


    private UserService $userService;


    private QuisionerProdi $prodi;

    private PasswordResetService $passwordResetService;



    public function __construct()
    {
        $this->education = new Education();
        $this->emailService = new EmailService();
        $this->user = new User();
        $this->userService = new UserService();
        $this->prodi = new QuisionerProdi();
        $this->passwordResetService = new PasswordResetService();
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

        $graduateYear = $request['tahun_lulus'];
        $fiveYearsAgo = Carbon::now()->subYears(5)->year;
        $isActive = false;
        $required_to_fill = false;
        if ($fiveYearsAgo > $graduateYear) {
            $isActive = true;
            $required_to_fill = true;
        }

        DB::beginTransaction();
        $prodi = $this->prodi->where('id', $request['kode_prodi'])->first();
        if (!isset($prodi)) {
            throw new NotFoundException('ops, prodi tidak ditemukan');
        }


        // $response = Http::withHeaders([
        //     'X-RapidAPI-Host' => 'indonesian-identification-card-ktp.p.rapidapi.com',
        //     'X-RapidAPI-Key' => env('NIK_API_KEY'),
        // ])->get("https://indonesian-identification-card-ktp.p.rapidapi.com/api/v3/check", [
        //             'nik' => $request['nik'],
        //             // Tambahkan parameter kueri lainnya sesuai kebutuhan
        //         ]);


        // $status = $response->status();
        // if ($status != 200) {
        //     throw new BadRequestException("Ops, Nik kamu tidak terdaftar di Data Kementrian Silahkan Masukan Nik Yang Sesuai");
        // }

        // dd($response->getBody());

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
                'kode_prodi' => $request['kode_prodi'],
                'account_status' => $isActive,
                'foto' => 'default.png',
                'required_to_fill' => $required_to_fill
            ]);
            $isCreated = $this->education->create([
                'user_id' => $user->id,
                'perguruan' => 'Politeknik Negeri Jember',
                'prodi' => $prodi->nama_prodi,
                'tahun_masuk' => $request['angkatan'],
                'tahun_lulus' => $request['tahun_lulus']
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


    public function verifikasiEmail($email)
    {
        $user = $this->user->where('email', $email)->first();
        if (isset($user)) {
            throw new BadRequestException('ops , email mu sudah digunakan user lain');
        }
        return [
            'status' => true,
            'message' => 'success verifikasi email , silahkan registrasi',
            'code' => 200,
            'data' => true
        ];
    }



    public function sendRecovery($email)
    {
        $response = $this->user->where('email', $email)->first();
        if (isset($response)) {
            $tokenCreated = $this->passwordResetService->save($email, $response->id);
            $url = url('/') . "/forgotpassword/" . $tokenCreated->token;
            $this->emailService->sendEmailRecovery($email, $url, $tokenCreated->expire);
            return [
                'status' => true,
                'message' => 'Berhasil Mengirim Password Reset Url',
                'data' => true,
                'code' => 200
            ];
        }
        throw new BadRequestException('Ops , email kamu belum terdaftar');
    }


    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }


    public function logoutProdi()
    {
        Auth::guard('admin')->logout();
        return redirect('/prodi/login');
    }

}