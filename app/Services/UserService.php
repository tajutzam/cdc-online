<?php


namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\WebException;
use App\Helper\ResponseHelper;
use App\Models\Education;
use App\Models\Followed;
use App\Models\Follower;
use App\Models\User;
use Cloudinary\Api\Exception\BadRequest;
use Cloudinary\Api\Exception\NotFound;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    private User $userModel;
    private Follower $follower;
    private Followed $followed;
    private Education $education;

    private EmailService $emailService;

    public function __construct()
    {
        $this->userModel = new User();
        $this->follower = new Follower();
        $this->followed = new Followed();
        $this->education = new Education();
        $this->emailService = new EmailService();
    }


    public function findUserByToken($token)
    {
        $data = $this->userModel->with('jobs', 'educations', 'followers')->where('token', $token)->get()->toArray();
        $responsePojo = [];

        $user = $this->userModel->with('prodi')->where('token', $token)->first();

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

    public function findUserById($id, $token)
    {
        $data = $this->userModel->with('jobs', 'educations', 'followers', 'followed')->where('id', $id)->first();

        if (!isset($data)) {
            throw new NotFoundException('ops , user tidak ditemukan');
        }

        $data = $data->toArray();

        $responsePojo = [];

        $user = $this->userModel->where('id', $id)->first();

        $userLoginId = $this->extractUserId($token);

        $followersData = $data['followers'];
        $isFollow = false;
        foreach ($followersData as $key => $value) {
            # code...
            if ($value['folowers_id'] == $userLoginId) {
                $isFollow = true;
            }
        }

        $userPojo = $this->castToUserResponse($user);
        $userPojo['isFollow'] = $isFollow;

        $followersIds = collect($data['followers'])->pluck('folowers_id')->toArray();
        $followers = [];
        // Mengambil data jobs dan educations dari $value
        $jobs = $data['jobs'];
        $educations = $data['educations'];
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

        return ResponseHelper::successResponse('success fetch data', $responsePojo, 200);
    }

    public function findAllUser($pageNumber, $angkatan, $prodi, $id) // need pagination 
    {
        $perPage = 10; // Jumlah item per halaman, sesuaikan dengan kebutuhan Anda

        $education = $this->education
            ->where(function ($query) use ($prodi, $angkatan) {
                if (isset($angkatan)) {
                    $query->whereRaw('LOWER(perguruan) LIKE ?', ['%' . strtolower('Politeknik Negeri Jember') . '%'])
                        ->where(function ($subquery) use ($angkatan) {
                            $subquery->whereRaw('LOWER(tahun_masuk) LIKE ?', ['%' . strtolower($angkatan) . '%'])
                                ->orWhereRaw('LOWER(tahun_masuk)  LIKE ?', ['%' . strtolower($angkatan) . '%']);
                        })
                        ->whereRaw('TRIM(LOWER(prodi)) LIKE ?', ['%' . strtolower($prodi) . '%']);
                } else {
                    $query->whereRaw('LOWER(perguruan) LIKE ?', ['%' . strtolower('Politeknik Negeri Jember') . '%'])

                        ->whereRaw('LOWER(prodi) LIKE ?', ['%' . strtolower($prodi) . '%']);
                }
            })
            ->get()
            ->pluck('user_id')
            ->toArray();

        $queryData = $this->userModel->with('jobs', 'educations', 'followers')->where('id', '<>', $id)
            ->whereIn('id', $education);
        $paginate = $queryData->paginate($perPage, ['*'], 'page', $pageNumber);
        $data = $paginate->items();

        $responsePojo = [
            "total_page" => $paginate->lastPage(),
            "total_items" => $paginate->total()
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



    public function findAll($active = null)
    {

        $query = $this->userModel->with('jobs', 'educations', 'prodi');
        $response = [];

        $response['alumni'] = $query->when(isset($active), function ($query) use ($active) {
            if (isset($active)) {
                $query->where('account_status', $active);
            }
        })->whereHas('educations', function ($educationQuery) {
            $educationQuery->where('perguruan', 'Politeknik Negeri Jember');
        })->get()->toArray();



        $statusCounts = $this->userModel
            ->select('account_status', DB::raw('COUNT(*) as count'))
            ->when(isset($active), function ($query) use ($active) {
                $query->where('account_status', $active);
            })
            ->whereHas('educations', function ($educationQuery) {
                $educationQuery->where('perguruan', 'Politeknik Negeri Jember');
            })
            ->groupBy('account_status')
            ->get();

        $active = 0;
        $nonActive = 0;
        foreach ($statusCounts as $statusCount) {
            if ($statusCount->account_status == 1) {
                $active = $statusCount->count;
            } else {
                $nonActive = $statusCount->count;
            }
        }


        $now = now(); // Tanggal sekarang
        $today = $now->dayOfWeek; // Mendapatkan hari dalam format 0 (Minggu) hingga 6 (Sabtu)

        // Menghitung tanggal awal (Minggu) dalam seminggu tertentu
        $startDate = $now->subDays($today)->startOfDay();

        // Menghitung tanggal akhir (Sabtu) dalam seminggu tertentu
        $endDate = $startDate->copy()->addDays(6)->endOfDay();

        $addedActiveInWeek = $this->userModel
            ->where('account_status', true) // Hanya data dengan account_status true
            ->whereBetween('created_at', [$startDate, $endDate]) // Filter data yang dibuat dalam rentang waktu (Minggu hingga Sabtu)
            ->count(); // Menghitung jumlah data

        $addedNonActiveInWeek = $this->userModel
            ->where('account_status', false) // Hanya data dengan account_status true
            ->whereBetween('created_at', [$startDate, $endDate]) // Filter data yang dibuat dalam rentang waktu (Minggu hingga Sabtu)
            ->count(); // Menghitung jumlah data

        $response['count'] = [
            'active' => $active,
            'nonactive' => $nonActive,
            'actviceWeek' => $addedActiveInWeek,
            'nonActiveWeek' => $addedNonActiveInWeek
        ];
        return $response;
    }

    public function findAllByProdi($active, $kodeProdi)
    {
        $query = $this->userModel->with('jobs', 'educations', 'prodi');
        $response = [];
        $response['alumni'] = $query->when(isset($active), function ($query) use ($active) {
            $query->where('account_status', $active);
        })->whereHas('educations', function ($educationQuery) {
            $educationQuery->where('perguruan', 'Politeknik Negeri Jember');
        })->whereHas('prodi', function ($prodiQuery) use ($kodeProdi) {
            $prodiQuery->where('id', $kodeProdi); // Gunakan nilai $kodeProdi dari parameter
        })->get()->map(function ($user) {
            return $user;
        })->toArray();


        $statusCounts = $this->userModel
            ->select('account_status', DB::raw('COUNT(*) as count'))
            ->when(isset($active), function ($query) use ($active) {
                $query->where('account_status', $active);
            })
            ->whereHas('educations', function ($educationQuery) {
                $educationQuery->where('perguruan', 'Politeknik Negeri Jember');
            })->whereHas('prodi', function ($prodiQuery) use ($kodeProdi) {
                $prodiQuery->where('id', $kodeProdi); // Gunakan nilai $kodeProdi dari parameter
            })
            ->groupBy('account_status')
            ->get();

        $active = 0;
        $nonActive = 0;
        foreach ($statusCounts as $statusCount) {
            if ($statusCount->account_status == 1) {
                $active = $statusCount->count;
            } else {
                $nonActive = $statusCount->count;
            }
        }

        $response['count'] = [
            'active' => $active,
            'nonactive' => $nonActive
        ];

        return $response;
    }

    public function updateVisible($request, $token)
    {

        $key = [];
        Db::beginTransaction();

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

        //code...
        $updated = $this->userModel->where('token', $token)->update($finalKey);
        if ($updated) {
            Db::commit();
            return ResponseHelper::successResponse('Berhsail memperbarui visibility', $updated, 200);
        }
        throw new Exception('ops , gagal memperbarui visibility terjadi kesalahan');
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
        return ResponseHelper::successResponse('success fetch data', [
            'total_followers' => sizeof($data),
            'followers' => $data
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
        return ResponseHelper::successResponse('success fetch data', [
            'total_followers' => sizeof($response['followers']),
            'user' => $response
        ], 200);
    }

    public function sendFcmToken($token, $id)
    {
        Db::beginTransaction();
        $user = $this->userModel->where('id', $id)->first();
        if (isset($user)) {
            $updated = $user->update([
                'fcm_token' => $token
            ]);
            if ($updated) {
                Db::commit();
                return ResponseHelper::successResponse('berhasil mengirim token', $updated, 200);
            }
            throw new Exception('ops , gagal mengirim fcm token , terjadi kesalahan');
        }
        throw new UnauthorizedException('ops , akun tidak ditemukan silahkan login terlebih dahulu');
    }


    public function extractUserId($token): string
    {

        $user = $this->userModel->where('token', '=', $token)->first();

        if (isset($user)) {
            return $user['id'];
        } else {
            throw new UnauthorizedException('ops , your token is not valid please login again');
        }
    }

    private function castToUserResponse($user)
    {

        $fotoName = isset($user->foto) == true ? $user->foto : '';

        $url = url('/') . "/users/" . $fotoName;
        return [
            "id" => $user->id,
            "fullname" => $user->visible_fullname == 1 ? $user->fullname : "***",
            "email" => $user->visible_email == 1 ? $user->email : "***",
            "nik" => $user->visible_nik == 1 ? $user->nik : "***",
            "no_telp" => $user->visible_no_telp == 1 ? $user->no_telp : "***",
            "foto" => $url,
            'ttl' => $user->visible_ttl == 1 ? $user->ttl : '***',
            'alamat' => $user->visible_alamat == 1 ? $user->alamat : "***",
            "about" => $user->about,
            "gender" => $user->gender == 'male' ? "Laki-Laki" : "Perempuan",
            "level" => $user->level,
            "linkedin" => $user->linkedin,
            "facebook" => $user->facebook,
            "instagram" => $user->instagram,
            'twiter' => $user->twiter,
            'account_status' => $user->account_status,
            'prodi' => $user->prodi->id,
            "latitude" => $user->latitude,
            "longtitude" => $user->longtitude,
            'state_quisioner' => $user->state_quisioner
        ];
    }

    public function castToUserResponseFromArray($user)
    {

        $url = url('/') . "/users/" . $user['foto'];
        return [
            "id" => $user['id'],
            'nim' => $user['nim'],
            "fullname" => $user['visible_fullname'] == 1 ? $user['fullname'] : "***",
            "email" => $user['visible_email'] == 1 ? $user['email'] : "***",
            "nik" => $user['visible_nik'] == 1 ? $user['nik'] : "***",
            "no_telp" => $user['visible_no_telp'] == 1 ? $user['no_telp'] : "***",
            "foto" => $url,
            'ttl' => $user['visible_ttl'] == 1 ? $user['ttl'] : "***",
            'alamat' => $user['visible_alamat'] == 1 ? $user['alamat'] : "***",
            "about" => $user['about'],
            "gender" => $user['gender'] == "male" ? "Laki-Laki" : "Perempuan",
            "level" => $user['level'],
            "linkedin" => $user['linkedin'],
            "facebook" => $user['facebook'],
            "instagram" => $user['instagram'],
            'twiter' => $user['twiter'],
            'account_status' => $user['account_status'],
            'latitude' => $user['latitude'],
            'longtitude' => $user['longtitude'],
            'state_quisioner' => $user['state_quisioner']
        ];
    }

    public function castToUserResponseFromArrayWithJoin($user)
    {

        $url = url('/') . "/users/" . $user['foto'];
        return [
            "id" => $user['id'],
            "fullname" => $user['visible_fullname'] == 1 ? $user['fullname'] : "***",
            "email" => $user['visible_email'] == 1 ? $user['email'] : "***",
            "nik" => $user['visible_nik'] == 1 ? $user['nik'] : "***",
            "no_telp" => $user['visible_no_telp'] == 1 ? $user['no_telp'] : "***",
            "foto" => $url,
            'ttl' => $user['visible_ttl'] == 1 ? $user['ttl'] : "***",
            'alamat' => $user['visible_alamat'] == 1 ? $user['alamat'] : "***",
            "about" => $user['about'],
            "gender" => $user['gender'] == "male" ? "Laki-Laki" : "Perempuan",
            "level" => $user['level'],
            "linkedin" => $user['linkedin'],
            "facebook" => $user['facebook'],
            "instagram" => $user['instagram'],
            'twiter' => $user['twiter'],
            'account_status' => $user['account_status'],
            'latitude' => $user['latitude'],
            'longtitude' => $user['longtitude'],
            'state_quisioner' => $user['state_quisioner'],
            'educations' => $user['educations']->toArray(),
            'prodi' => $user['prodi']->toArray()
        ];
    }

    public function getTopUser()
    {
        $data = $this->userModel->with('followers', 'jobs')->get()->toArray();

        $data = collect($data)->sortByDesc(function ($user) {
            return count($user['followers']);
        })->values()->take(20)->all();

        $response = collect($data)->map(function ($user) {
            $lastJob = collect($user['jobs'])->where('pekerjaan_saatini', 1)->first();

            $tempData = $this->castToUserResponseFromArray($user);
            $tempData['followers'] = $user['followers'];
            $tempData['total_followers'] = sizeof($user['followers']);
            $tempData['job'] = $lastJob ? $lastJob['jabatan'] : null;
            $tempData['company'] = $lastJob ? $lastJob['perusahaan'] : null;
            return $tempData;
        })->toArray();
        return $response;
    }

    public function getTopUserBySalary()
    {
        $data = $this->userModel->with([
            'jobs' => function ($query) {
                $query->where('pekerjaan_saatini', true);
            }
        ])->get()->toArray();

        // Gunakan metode koleksi untuk mengambil nama posisi pekerjaan terakhir dan gaji tertinggi
        return collect($data)->filter(function ($user) {
            return count($user['jobs']) > 0; // Filter pengguna yang memiliki setidaknya satu pekerjaan.
        })->map(function ($user) {
            if (isset($user['jobs'])) {
                $lastJob = collect($user['jobs'])->where('pekerjaan_saatini', 1)->first();

                $formattedCurrency = 0;

                if (isset($lastJob)) {
                    $formattedCurrency = number_format($lastJob['gaji'], 2); // 2 decimal places for cents
                    return [
                        'fullname' => $user['fullname'],
                        'last_position' => $lastJob ? $lastJob['jabatan'] : null,
                        'highest_salary' => $lastJob ? $formattedCurrency : null,
                        'company' => $lastJob['perusahaan'],
                        'account_status' => $user['account_status'],
                        'image' => url('/') . '/users/' . $user['foto']
                    ];
                }
            }

        })->sortByDesc('highest_salary')->values()->take(20)->toArray();
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
        DB::beginTransaction();
        if (isset($userFollower)) {
            if ($idUserLogin == $userId) {
                throw new BadRequestException("Ops , Kamu tidak bisa mengikuti diri sendiri");
            }
            try {
                $isFolowed = $this->followed->where('user_id', $userId)->where('folowed_id', $idUserLogin)->first();
                if (isset($isFolowed)) {
                    // jika user sudah memfolow
                    throw new BadRequest('ops kamu sudah mengikuti user tersebut');
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
                                DB::commit();
                                return ResponseHelper::successResponse('berhasil mengikuti user', $isCreatedFolowers, 201);
                            } else {
                                throw new Exception();
                            }
                        }
                    } catch (\Throwable $th) {
                        throw new Exception($th->getMessage());
                    }
                }
            } catch (\Throwable $th) {
                throw new Exception($th->getMessage());
            }
        } else {
            throw new NotFoundException('gagal mengikuti user , user tidak ditemukan');
        }
    }

    public function unfollowUser($idUserLogin, $userId): JsonResponse
    {
        DB::beginTransaction();
        $tempFolowed = $this->followed->where('user_id', $userId)->where('folowed_id', $idUserLogin)->first();
        if (isset($tempFolowed)) {
            try {
                $isDelete = $tempFolowed->delete();
                if ($isDelete) {
                    $checkUserFolower = $this->follower->where('user_id', $userId)->where('folowers_id', $idUserLogin)->first();
                    if (isset($checkUserFolower)) {
                        // remove user 
                        $isUnfollow = $checkUserFolower->delete();
                        if ($isUnfollow) {
                            Db::commit();
                            return ResponseHelper::successResponse('Success unfollow', $isUnfollow, 200);
                        } else {
                            throw new BadRequestException('Gagal berhenti mengikuti , user sudah berhenti mengikuti');
                        }
                    } else {
                        throw new BadRequestException('Gagal berhenti mengikuti , user sudah berhenti mengikuti');
                    }
                } else {
                    throw new BadRequestException('Gagal berhenti mengikuti , user sudah berhenti mengikuti');
                }
            } catch (\Throwable $th) {
                //throw $th;
                throw new Exception($th->getMessage());
            }
        } else {
            throw new NotFoundException('Gagal unfollow user , user tidak ditemukan');
        }
    }

    public function showUserFollowed($id)
    {
        $response = [];
        $user = $this->userModel->where('id', $id)->first();
        if (isset($user)) {
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
            return ResponseHelper::successResponse('success fetch data', [
                'total_followers' => sizeof($response['followed']),
                'user' => $response
            ], 200);
        }
        throw new NotFoundException('user not found');
    }

    public function updateUserLogin($request, $userId)
    {
        DB::beginTransaction();
        $filteredKeys = array_filter(array_keys($request), function ($key) use ($request) {
            return $request[$key] !== '***';
        });

        $dataBasedOnFilteredKeys = array_intersect_key($request, array_flip($filteredKeys));
        $dataBasedOnFilteredKeys['twiter'] = $dataBasedOnFilteredKeys['x'];
        unset($dataBasedOnFilteredKeys['x']);

        try {
            //code...
            // check 4 visibility
            $isUpdate = $this->userModel->where('id', $userId)->update($dataBasedOnFilteredKeys);
            if ($isUpdate) {
                DB::commit();
                return ResponseHelper::successResponse('success memberbarui profile', $isUpdate, 200);
            } else {
                throw new Exception('ops , gagal memperbarui user');
            }
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception('ops , gagal memperbarui user ' . $th->getMessage());
        }
    }

    public function updateFotoProfile($image, $id)
    {
        $folder = "users";
        $fileName = time() . '.' . $image->extension();
        $urlResource = $image->move($folder, $fileName);
        $user = $this->userModel->where('id', $id)->first();

        $oldFileName = $user->foto;
        $oldPath = "public/$folder/" . $oldFileName;

        $this->deleteFile($oldPath); // delete old  images

        if (isset($user)) {
            $isUpdated = $user->update([
                'foto' => $fileName
            ]);
            if ($isUpdated) {
                $url = url('/') . "/" . $urlResource;
                return ResponseHelper::successResponse('success update foto profile', $url, 200);
            } else {
                throw new Exception('gagal memperbarui foto profile , terjadi kesalahan');
            }
        } else {
            throw new NotFoundException('user not found');
        }
    }

    private function deleteFile($path)
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    public function updateEmailVerivied($id, $value)
    {
        $user = $this->userModel->where('id', $id)->first();
        if (isset($user)) {

            if ($user->email_verivied) {
                return [
                    'status' => false,
                    'code' => 102 // user sudah melakukan verivikasi
                ];
            }
            $isUpdate = $user->update([
                'email_verivied' => $value
            ]);
            if ($isUpdate) {
                return [
                    'status' => true,
                    'code' => 101 // 101 untuk berhasil verivikasi
                ];
            } else {
                return [
                    'status' => false,
                    'code' => 103 // 103 untuk User gagal verivikasi
                ];
            }
        } else {
            return [
                'status' => false,
                'code' => 404 // 404 user tidak ditemukan
            ];
        }
    }

    public function updateEmail($id, $email)
    {
        $user = $this->userModel->where('id', $id)->first();
        $expired = Carbon::now()->addHour();
        if (isset($user)) {
            $isUpdate = $user->update([
                'email' => $email,
                'email_verivied' => false,
                'expire_email' => $expired,
                'token' => null
            ]);
            if ($isUpdate) {
                try {
                    //code...
                    $link = url('/') . '/api/user/verivication/email?id=' . "$user->id";
                    $this->emailService->sendEmailVerifikasi($email, $link, $expired->format('F j - H:i'));
                    return response()->json([
                        'status' => true,
                        'message' => "Berhasil update email , silahkan verivikasi email dan login ulang",
                        'code' => 200
                    ], 200);
                } catch (\Throwable $th) {
                    //throw $th;
                    return response()->json([
                        'status' => false,
                        'message' => $th->getMessage(),
                        'code' => 500
                    ], 500);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'gagal melakukan update email',
                    'code' => 400
                ], 400);
            }
        }
    }

    public function findByName($request, $id)
    {
        $searchTerm = $request['key']; // Get the search query from the request

        $users = $this->userModel->where('fullname', 'like', '%' . $searchTerm . '%')->where('id', '<>', $id)->get();
        $response = collect($users)->map(function ($user) {
            return $this->castToUserResponseFromArray($user);
        })->toArray();
        if (sizeof($response) == 0) {
            throw new NotFoundException('user dengan nama ' . $searchTerm . ' tidak ditemukan');
        }
        return $response;
    }


    public function updateLongtitudeLangtitude($request, $userId)
    {
        DB::beginTransaction();
        $userModel = $this->userModel->where('id', $userId)->first();
        if (!isset($userModel)) {
            throw new NotFoundException('ops , user not found');
        }
        $isUpdated = $userModel->update([
            'longtitude' => $request['longtitude'],
            'latitude' => $request['latitude']
        ]);
        if ($isUpdated) {
            DB::commit();
            return [
                'status' => true,
                'message' => 'berhasil memperbarui posisi',
                'code' => 200
            ];
        }
        throw new Exception('ops , terjadi masalah');
    }


    public function checkUserStatus($token)
    {

        $userId = $this->extractUserId($token);
        $user = $this->userModel->where('id', $userId)
            ->with(['educations' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])
            ->first();
        if ($user) {
            // Ambil educations yang pertama kali diinsert
            $firstEducation = $user->educations->first();
            if (!isset($firstEducation)) {
                return $user->account_status;
            }
            $graduated = $firstEducation->tahun_lulus;
            if ($graduated == date('Y') - 5) {
                return true;
            } else {
                return $user->account_status;
            }
        } else {
            throw new NotFoundException('ops , Nampaknya user yang kamu cari tidak ditemukan');
        }
    }

    public function updateLongtitudeLatitude($request, $userId)
    {
        Db::beginTransaction();
        $user = $this->userModel->where('id', $userId)->first();
        if (!isset($user)) {
            throw new NotFoundException('ops , user tidak ditemukan');
        }
        $isUpdateed = $user->update([
            'latitude' => $request['latitude'],
            'longtitude' => $request['longtitude']
        ]);
        if ($isUpdateed) {
            DB::commit();
            return [
                'status' => true,
                'code' => 200,
                'message' => ' success update lotitude'
            ];
        }
        throw new Exception('');
    }

    public function updatePassword($email, $password)
    {
        $user = $this->userModel->where('email', $email)->first();
        Db::beginTransaction();
        if (isset($user)) {
            $updated = $user->update(
                [
                    'password' => Hash::make($password)
                ]
            );
            if ($updated) {
                Db::commit();
                return true;
            }
            throw new WebException("Ops , gagal memperbarui password terjadi kesalahan");
        }
        throw new WebException('Ops , token kamu tidak valid , email tidak ditemukan');
    }

    public function logout($userId)
    {
        $user = $this->userModel->where('id', $userId)->first();
        if (isset($user)) {
            $updated = $user->update([
                'token' => null
            ]);
            if ($updated) {
                return [
                    'status' => true,
                    'message' => 'Sukses Logout',
                    'code' => 200,
                    'data' => true
                ];
            } else {
                throw new Exception('Ops , terjadi kesalahan saat logout');
            }
        }
    }

    public function countPerDayActive()
    {
        $startDate = now()->startOfWeek(); // Mendapatkan awal minggu (Minggu)
        $endDate = now()->endOfWeek(); // Mendapatkan akhir minggu (Sabtu)

        $data = [];

        while ($startDate <= $endDate) {
            $count = $this->userModel
                ->whereDate('created_at', $startDate->toDateString())
                ->where('account_status', true)
                ->with('educations')
                ->whereHas('educations', function ($educationQuery) {
                    $educationQuery->where('perguruan', 'Politeknik Negeri Jember');
                })
                ->count();
            $data[$startDate->format('Y-m-d')] = $count;

            $startDate->addDay();
        }
        return $data;
    }

    public function countPerDayNonActive()
    {
        $startDate = now()->startOfWeek(); // Mendapatkan awal minggu (Minggu)
        $endDate = now()->endOfWeek(); // Mendapatkan akhir minggu (Sabtu)

        $data = [];

        while ($startDate <= $endDate) {
            $count = $this->userModel
                ->whereDate('created_at', $startDate->toDateString())
                ->where('account_status', false)
                ->with('educations')
                ->whereHas('educations', function ($educationQuery) {
                    $educationQuery->where('perguruan', 'Politeknik Negeri Jember');
                })
                ->count();
            $data[$startDate->format('Y-m-d')] = $count;

            $startDate->addDay();
        }
        return $data;
    }

    public function findByEmail($email)
    {
        return $this->userModel->where('email', $email)->first();
    }


    // find user yang sudah bekerja setiap angkatan
    public function findLastFiveYearsAlumniWhoHaveWorked()
    {
        $currentYear = date('Y'); // Tahun saat ini
        $yearsAgo = $currentYear - 4; // Lima tahun yang lalu

        $users = $this->userModel
            ->whereHas('educations', function ($query) use ($yearsAgo) {
                $query->select(DB::raw('MAX(tahun_masuk) as latest_year'))
                    ->groupBy('user_id')
                    ->having('latest_year', '>=', $yearsAgo);
            })
            ->whereHas('quisioner_level', function ($query) {
                $query->whereHas('main', function ($mainQuery) {
                    $mainQuery->orWhere('f8', 'Bekerja (full time/part time)');
                    $mainQuery->orWhere('f8', 'Wiraswasta');
                });
            })
            ->with([
                'educations' => function ($query) use ($yearsAgo) {
                    $query->where('tahun_masuk', '>=', $yearsAgo);
                },
                'quisioner_level'
            ])
            ->get();


        $groupedUsers = $users->groupBy(function ($user) {
            return $user->educations->first()->tahun_masuk;
        })->map(function ($users) {
            $zero = 0;
            $six = 0;
            $twelve = 0;

            foreach ($users as $value) {
                # code...
                foreach ($value->toArray()['quisioner_level'] as $valueQuisioner) {
                    # code...
                    if ($valueQuisioner['level'] == '0') {
                        $zero++;
                    } else if ($valueQuisioner['level'] == '6') {
                        $six++;
                    } else if ($valueQuisioner['level'] == '12') {
                        $twelve++;
                    }
                }
            }
            return [
                '0' => $zero,
                '6' => $six,
                '12' => $twelve
            ];
        })->toArray();

        // Tambahkan tahun-tahun yang tidak memiliki data
        $missingYears = range($currentYear, $yearsAgo);
        foreach ($missingYears as $year) {
            if (!isset($groupedUsers[$year])) {
                $groupedUsers[$year] = [
                    '0' => 0,
                    '6' => 0,
                    '12' => 0
                ];
                ; // Tambahkan array kosong
            }
        }
        return $groupedUsers;
    }


    public function findLastFiveYearsAlumniWhoHaveWorkedByStudyProgram($idProdi)
    {
        $currentYear = date('Y'); // Tahun saat ini
        $yearsAgo = $currentYear - 4; // Lima tahun yang lalu

        $users = $this->userModel
            ->whereHas('educations', function ($query) use ($yearsAgo) {
                $query->select(DB::raw('MAX(tahun_masuk) as latest_year'))
                    ->groupBy('user_id')
                    ->having('latest_year', '>=', $yearsAgo);
            })
            ->whereHas('quisioner_level', function ($query) {
                $query->whereHas('main', function ($mainQuery) {
                    $mainQuery->orWhere('f8', 'Bekerja (full time/part time)');
                    $mainQuery->orWhere('f8', 'Wiraswasta');
                });
            })
            ->with([
                'educations' => function ($query) use ($yearsAgo) {
                    $query->where('tahun_masuk', '>=', $yearsAgo);
                },
                'quisioner_level'
            ])
            ->where(
                'kode_prodi',
                $idProdi
            )
            ->get();


        $groupedUsers = $users->groupBy(function ($user) {
            return $user->educations->first()->tahun_masuk;
        })->map(function ($users) {
            $zero = 0;
            $six = 0;
            $twelve = 0;

            foreach ($users as $value) {
                # code...
                foreach ($value->toArray()['quisioner_level'] as $valueQuisioner) {
                    # code...
                    if ($valueQuisioner['level'] == '0') {
                        $zero++;
                    } else if ($valueQuisioner['level'] == '6') {
                        $six++;
                    } else if ($valueQuisioner['level'] == '12') {
                        $twelve++;
                    }
                }
            }
            return [
                '0' => $zero,
                '6' => $six,
                '12' => $twelve
            ];
        })->toArray();

        // Tambahkan tahun-tahun yang tidak memiliki data
        $missingYears = range($currentYear, $yearsAgo);
        foreach ($missingYears as $year) {
            if (!isset($groupedUsers[$year])) {
                $groupedUsers[$year] = [
                    '0' => 0,
                    '6' => 0,
                    '12' => 0
                ];
                ; // Tambahkan array kosong
            }
        }
        return $groupedUsers;
    }



    public function countUsersPerStudyProgram()
    {
        $data = $this->userModel->whereHas('prodi', function ($query) {
            $query->groupBy('nama_prodi');
        })
            ->with('prodi')
            ->get()
            ->toArray();

        // Inisialisasi array untuk menyimpan jumlah data per program studi
        $totalPerStudyProgram = [];

        // Mengelompokkan data berdasarkan program studi
        foreach ($data as $user) {
            $namaProdi = $user['prodi']['nama_prodi'];

            // Jika program studi belum ada dalam array, inisialisasi dengan 1
            if (!isset($jumlahDataPerProdi[$namaProdi])) {
                $totalPerStudyProgram[$namaProdi] = 1;
            } else {
                // Jika program studi sudah ada dalam array, tambahkan 1 ke jumlahnya
                $totalPerStudyProgram[$namaProdi]++;
            }
        }
        $result = [];
        foreach ($totalPerStudyProgram as $key => $count) {
            $temp = [
                'name' => $key,
                'y' => $count
            ];
            array_push($result, $temp);
        }
        // Hasilnya akan berisi jumlah data per program studi
        return $result;
    }

    public function applicationEnrollmentProgress()
    {

        $year = 2023; // Ganti dengan tahun yang sesuai
        $monthlyCounts = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        $monthlyData = [];
        foreach ($monthlyCounts as $count) {
            $monthName = $months[$count->month];
            $monthlyData[$monthName] = $count->count;
        }

        // Tampilkan jumlah pengguna yang mendaftar pada setiap bulan
        $result = [];
        foreach ($months as $monthNumber => $monthName) {
            $count = isset($monthlyData[$monthName]) ? $monthlyData[$monthName] : 0;
            $temp = [
                'name' => $monthName,
                'y' => $count
            ];
            array_push($result, $temp);
        }
        return $result;
    }

    public function totalUsers()
    {
        return $this->userModel->count();
    }

    public function findAllUserHaveWork()
    {
        return $this->userModel
            ->whereHas('quisioner_level', function ($query) {
                $query->whereHas('main', function ($mainQuery) {
                    $mainQuery->orWhere('f8', 'Bekerja (full time/part time)');
                    $mainQuery->orWhere('f8', 'Wiraswasta');
                });
            })->count();
    }

    public function findAllUserHaveNotWork()
    {
        return $this->userModel
            ->whereDoesntHave('quisioner_level') // Equivalent to orWhereNotHas for absence of related models
            ->orWhereHas('quisioner_level', function ($query) {
                $query->whereHas('main', function ($mainQuery) {
                    $mainQuery->where(function ($mainWhere) {
                        $mainWhere->where('f8', 'Belum memungkinkan bekerja')
                            ->orWhere('f8', 'Tidak kerja tetapi sedang mencari kerja');
                    });
                });
            })
            ->count();
    }

    public function userCard($userId)
    {
        $user = $this->userModel
            ->with([
                'educations' => function ($query) {
                    $query->where('perguruan', 'Politeknik Negeri Jember')->first();
                }
            ])
            ->where('id', $userId)
            ->first();

        $response = $this->castToUserResponseFromArray($user);
        if (isset($user['educations'][0])) {
            $response['educations'] = $user['educations'][0]->toArray();
        } else {
            $response['educations'] = [];
        }
        return $response;
    }





}
