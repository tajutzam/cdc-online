<?php



namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Exceptions\WebException;
use App\Helper\ResponseHelper;
use App\Models\Post;
use App\Models\User;
use Cloudinary\Api\Exception\BadRequest;
use Cloudinary\Api\Exception\NotFound;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Iloveimg\Iloveimg;
use Intervention\Image\Facades\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostService
{


    private Post $post;

    private NotificationService $notificationService;

    public function __construct()
    {
        $this->post = new Post();
        $this->notificationService = new NotificationService();
    }

    public function addPostJob($userId, $image, $request, $adminId = null)
    {
        $folder = "users/post";
        $fileName = time() . '.' . $image->extension();
        $urlResource = $image->move($folder, $fileName);
        if (!isset($urlResource)) {
            throw new BadRequest('ops gagal mengirim status , silahkan coba lagi');
        }
        $isCreated = $this->post->create(
            [
                'image' => $fileName,
                'link_apply' => $request['link_apply'],
                'description' => $request['description'],
                'company' => $request['company'],
                'position' => $request['position'],
                'type_jobs' => $request['type_job'],
                'expired' => Carbon::parse($request['expired']),
                'user_id' => $userId,
                'admin_id' => $adminId
            ]
        );
        if (isset($isCreated)) {
            $url = url('/') . "/users/post/" . $fileName;
            $isCreated['image'] = $url;
            return ResponseHelper::successResponse('Berhasil menambahkan Lowongan', $isCreated, 201);
        }
        throw new BadRequest('Ops, Gagal mengirim lowongan Terjadi Kesalahan');
    }

    public function addPostJobAdmin($image, $adminId, $request, $isCanComment)
    {
        DB::beginTransaction();
        $folder = "users/post";
        $fileName = time() . '.' . $image->extension();
        $urlResource = $image->move($folder, $fileName);
        if (!isset($urlResource)) {
            throw new BadRequest('Ops, Gagal mengirim status silaahkan coba lagi');
        }
        $isCreated = $this->post->create(
            [
                'image' => $fileName,
                'link_apply' => $request['link_apply'],
                'description' => $request['description'],
                'company' => $request['company'],
                'position' => $request['position'],
                'type_jobs' => $request['type_jobs'],
                'expired' => Carbon::parse($request['expired']),
                'user_id' => null,
                'admin_id' => $adminId,
                'verified' => 'verified',
                'can_comment' => $isCanComment
            ]
        );
        if (isset($isCreated)) {
            DB::commit();
            return [
                'status' => true,
                'message' => 'Sukses membuat Lowongan'
            ];
        } else {
            DB::rollBack();
            return [
                'status' => false,
                'message' => 'Gagal membuat Lowongan'
            ];
        }
    }



    public function addPostJobMitra($image, $mitraId, $request)
    {
        DB::beginTransaction();
        $folder = "users/post";
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $urlResource = $image->move($folder, $fileName);
        if (!isset($urlResource)) {
            throw new BadRequest('Ops, Gagal mengirim status silaahkan coba lagi');
        }
        $isCreated = $this->post->create(
            [
                'image' => $fileName,
                'link_apply' => $request['link_apply'],
                'description' => $request['description'],
                'company' => $request['company'],
                'position' => $request['position'],
                'type_jobs' => $request['type_jobs'],
                'expired' => Carbon::parse($request['expired']),
                'user_id' => null,
                'admin_id' => null,
                'post_at' => Carbon::parse($request['upload_at']),
                'mitra_id' => $mitraId,
                'can_comment' => true,
                'bukti' => $request['bukti']
            ]
        );
        if (isset($isCreated)) {
            DB::commit();
            return [
                'status' => true,
                'message' => 'Sukses membuat Lowongan'
            ];
        } else {
            DB::rollBack();
            return [
                'status' => false,
                'message' => 'Gagal membuat Lowongan'
            ];
        }
    }


    public function updateVerified($data, $type = null)
    {
        DB::beginTransaction();
        $updated = $this->post->where('id', $data['id'])->update([
            'verified' => $data['verified']
        ]);
        if ($updated) {
            $post = $this->post->where('id', $data['id'])->with('user', 'mitra')->first();
            DB::commit();
            if (isset($type)) {

            } else {
                if ($data['verified'] == 'verified') {
                    $this->notificationService->sendNotificationPost($post->user, "Selamat, Lowongan Anda Disetujui !", "Lowongan : " . $post->position . " di :" . $post->perusahaan, $post->id);
                } else {
                    $this->notificationService->sendNotificationPost($post->user, "Mohon Maaf, Lowongan Anda Ditolak", "Pesan", $post->id);
                }
            }
            return ResponseHelper::successResponse('Berhasil memperbarui Verifikasi', $updated, 200);
        }
        throw new WebException('Ops, Gagal memperbarui Verifikasi');
    }


    public function getAllPost($page, $userId)
    {
        $now = Carbon::now(); // Mendapatkan tanggal saat ini menggunakan Carbon

        $expiredPosts = $this->post
            ->where('expired', '>', $now)
            ->where('verified', 'verified')
            ->where('user_id', '<>', $userId)
            ->orWhereNotNull('admin_id')
            ->orWhereNotNull('mitra_id')
            ->with([
                'comments' => function ($query) {
                    $query->with('user');
                },
                'user',
                'admin',
                'mitra'
            ])
            ->paginate(10, ['*'], 'page', $page);


        $data = [
            'total_page' => $expiredPosts->lastPage(),
            'total_item' => $expiredPosts->total()
        ];
        foreach ($expiredPosts as $index => $datum) {

            $tempPost = $this->castToResponse($datum);
            $comments = [];
            // dd($tempPost['comments']);
            foreach ($datum['comments'] as $key => $value) {
                # code...
                $tempComments = $this->castToUserResponse($value['user']);
                $value['user'] = $tempComments;
                $newValue = $value;
                // dd($value['user']);
                array_push($comments, $newValue->getAttributes());
            }
            if (sizeof($datum['comments']) > 0) {
                $tempPost['comments'] = $comments;
            }
            array_push($data, $tempPost);
        }

        return ResponseHelper::successResponse('Sukses Fetch Data', $data, 200);
    }

    public function getPostByUserId($id, $page)
    {
        $expiredPosts = $this->post
            ->where('user_id', $id)
            ->with([
                'comments' => function ($query) {
                    $query->with('user');
                },
                'user',
            ])
            ->paginate(10, ['*'], 'page', $page);



        $pagination = [
            'total_page' => $expiredPosts->lastPage(),
            'total_item' => $expiredPosts->total()
        ];

        $data['posts'] = [];
        $data['pagination'] = $pagination;
        foreach ($expiredPosts as $keyIndex => $datum) {
            $tempPost = $this->castToResponse($datum);
            foreach ($datum['comments'] as $key => $value) {
                # code...
                $tempComments = $this->castToUserResponse($value['user']);
                $tempPost['comments'][$key]['user'] = $tempComments;
            }
            array_push($data['posts'], $tempPost);
        }

        return ResponseHelper::successResponse('Sukses Fetch Data', $data, 200);
    }


    public function updatePost($request, $userId, $id)
    {
        DB::beginTransaction();
        $post = $this->findById($id);
        if ($post->user_id == $userId) {
            $isUpdate = $post->update(
                [
                    'description' => $request['description'],
                    'link_apply' => $request['link'],
                    'type_jobs' => $request['type_jobs'],
                    'company' => $request['company'],
                    'position' => $request['position'],
                    'post_at' => $request['post_at'],
                    'expired' => $request['expired']
                ]
            );
            if ($isUpdate) {
                Db::commit();
                return ResponseHelper::successResponse('Berhasil memperbarui Lowongan', $isUpdate, 200);
            }
            throw new Exception('Ops, Gagal memperbarui Lowongan. Terjadi Kesalahan');
        }
        throw new BadRequestException('Ops, Pengguna tidak memiliki Lowongan tersebut');
    }

    public function deletePost($id, $userId)
    {
        DB::beginTransaction();
        $post = $this->findById($id);
        if ($post->user_id == $userId) {
            $isDelete = $post->delete();
            if ($isDelete) {
                Db::commit();
                return ResponseHelper::successResponse('Berhasil memperbarui setelan Komentar', true, 200);
            } else {
                throw new Exception('Ops, Gagal menghapus Lowongan. Terjadi Kesalahan');
            }
        }
        throw new NotFoundException('Ops, Pengguna tidak memiliki Lowongan Tersebut');
    }

    public function updateComment($id, $userId, $option)
    {
        DB::beginTransaction();
        $post = $this->findById($id);
        if ($post->user_id == $userId) {
            $isUpdate = $post->update([
                'can_comment' => $option
            ]);
            if ($isUpdate) {
                DB::commit();
                return ResponseHelper::successResponse('Berhasil memperbarui setelan Komentar', $isUpdate, 200);
            }
            throw new Exception('Ops, Gagal memperbarui setelan komentar');
        }
        throw new NotFoundException('Ops, Pengguna tidak memiliki Lowongan Tersebut');
    }

    public function findById($id)
    {
        $post = $this->post->where('id', $id)->with('comments.user')->first();
        if (isset($post)) {
            return $post;
        }
        throw new NotFoundException('Ops, Lowongan tidak ditemukan');
    }


    public function findByIdCast($id)
    {
        $post = $this->findById($id);
        if (isset($post)) {
            return $this->castToResponse($post);
        }
        throw new NotFoundException('Ops, Lowongan tidak ditemukan');
    }

    public function info()
    {
        echo phpinfo();
    }
    private function castToResponse($data)
    {
        // dd($data->toArray());
        $fotoName = isset($data->image) == true ? $data->image : '';
        $url = url('/') . "/users/post/" . $fotoName;
        $comments = $data->comments->toArray();
        $dataComments = [];
        foreach ($comments as $key => $value) {
            # code...
            $userComment = $this->castToUserResponseFromArray($value['user']);
            $value['user'] = $userComment;
            array_push($dataComments, $value);
        }
        $uploader = [
            'foto' => '',
            'fullname' => ''
        ];
        if (isset($data->user)) {
            $uploader['foto'] = $data->user->foto;
            $uploader['fullname'] = $data->user->fullname;

        } else if (isset($data->mitra)) {
            $image = url('/') . '/mitra/logo/' . $data->mitra->logo;
            $uploader['foto'] = $image;
    
            $uploader['fullname'] = $data->mitra->name;

        } else {
            $uploader['foto'] = url('/')."/assets/images/admin.png";
            $uploader['fullname'] = $data->admin->name;
        }
        return [
            'id' => $data->id,
            'user_id' => $data->user_id,
            'link_apply' => $data->link_apply,
            'image' => $url,
            'description' => $data->description,
            'company' => $data->company,
            'position' => $data->position,
            'expired' => $data->expired,
            'post_at' => $data->post_at,
            'can_comment' => $data->can_comment,
            'verified' => $data->verified,
            'comments' => $dataComments,
            'type_jobs' => $data->type_jobs,
            'uploader' => $uploader
        ];
    }


    public function findByPosition($request, $userId)
    {

        $now = Carbon::now();
        $expiredPosts = $this->post
            ->where('expired', '>', $now)
            ->where('verified', '=', 'verified')
            ->where('user_id', '<>', $userId)
            ->where('position', 'like', '%' . $request['key'] . '%')
            // ->orWhereNotNull('admin_id')
            ->with([
                'comments' => function ($query) {
                    $query->with('user');
                },
                'user',
                'admin'
            ])
            ->get();

        $data = [];

        foreach ($expiredPosts as $index => $datum) {
            $tempPost = $this->castToResponse($datum);
            $comments = [];
            // dd($tempPost['comments']);
            foreach ($datum['comments'] as $key => $value) {
                # code...
                $tempComments = $this->castToUserResponse($value['user']);
                $value['user'] = $tempComments;
                $newValue = $value;
                // dd($value['user']);
                array_push($comments, $newValue->getAttributes());
            }
            if (sizeof($datum['comments']) > 0) {
                $tempPost['comments'] = $comments;
            }
            array_push($data, $tempPost);
        }
        return ResponseHelper::successResponse('Sukses Fetch Data', $data, 200);
    }


    private function castToResponseFromArray($data)
    {

        $fotoName = isset($data['image']) == true ? $data['image'] : '';
        $url = url('/') . "/users/post/" . $fotoName;
        return [
            'id' => $data['id'],
            'user_id' => $data['user_id'],
            'link_apply' => $data['link_apply'],
            'image' => $url,
            'description' => $data['description'],
            'company' => $data['company'],
            'position' => $data['position'],
            'expired' => $data['expired'],
            'post_at' => $data['post_at'],
            'can_comment' => $data['can_comment'],
            'verified' => $data['verified'],
            'user' => $data['user'] ?? null,
            'admin' => $data['admin'] ?? null,
            'mitra' => $data['mitra'] ?? null,
            'bukti' => $data['bukti'] == null ? null : url('/') . "/bukti/" . $data['bukti']
        ];
    }


    public function findVerivyVacancy()
    {
        $data = $this->post
            ->where('verified', 'waiting')
            ->where(function ($query) {
                $query->whereHas('user')->orWhereHas('admin');
            })
            ->with('user', 'admin')
            ->orderBy('verified', 'asc')
            ->get()
            ->toArray();

        $endDate = Carbon::now(); // Current date and time
        $startDate = $endDate->copy()->startOfWeek(); // Start of the current week (Sunday)
        $endDate = $endDate->copy()->endOfWeek(); // End of the current week (Saturday)

        $count = $this->post
            ->where('verified', 'waiting')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();


        // Calculate the start date and end date for the one-week period
        // Calculate the start date (Sunday) and end date (Saturday) for the one-week period


        // Create an array to store the counts for each day
        $countsByDay = [];

        // Loop through each day within the one-week period
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            // Count the job postings for the current day
            $countTempDay = $this->post
                ->where('verified', 'waiting')
                ->whereDate('created_at', $currentDate)
                ->count();

            // Store the count in the array with the date as the key
            $countsByDay[$currentDate->toDateString()] = $countTempDay;

            // Move to the next day
            $currentDate->addDay();
        }


        $dataResponse['total_of_week'] = $count;
        $dataResponse['count_by_day'] = $countsByDay;
        $collection = collect($data);
        $dataResponse['vacancy'] = $collection->map(function ($data) {
            return $this->castToResponseFromArray($data);
        })->toArray();

        return $dataResponse;
    }


    public function findVerifyVacancyMitra()
    {
        $data = $this->post
            ->where('verified', 'waiting')
            ->where(function ($query) {
                $query->whereHas('mitra');
            })
            ->with('mitra')
            ->orderBy('verified', 'asc')
            ->get()
            ->toArray();


        $endDate = Carbon::now(); // Current date and time
        $startDate = $endDate->copy()->startOfWeek(); // Start of the current week (Sunday)
        $endDate = $endDate->copy()->endOfWeek(); // End of the current week (Saturday)

        $count = $this->post
            ->where('verified', 'waiting')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();


        // Calculate the start date and end date for the one-week period
        // Calculate the start date (Sunday) and end date (Saturday) for the one-week period


        // Create an array to store the counts for each day
        $countsByDay = [];

        // Loop through each day within the one-week period
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            // Count the job postings for the current day
            $countTempDay = $this->post
                ->where('verified', 'waiting')
                ->whereDate('created_at', $currentDate)
                ->count();

            // Store the count in the array with the date as the key
            $countsByDay[$currentDate->toDateString()] = $countTempDay;

            // Move to the next day
            $currentDate->addDay();
        }


        $dataResponse['total_of_week'] = $count;
        $dataResponse['count_by_day'] = $countsByDay;
        $collection = collect($data);
        $dataResponse['vacancy'] = $collection->map(function ($data) {
            return $this->castToResponseFromArray($data);
        })->toArray();

        return $dataResponse;
    }



    public function castToUserResponseFromArray($user)
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
            'state_quisioner' => $user['state_quisioner']
        ];
    }


    public function findHistoryVacancy()
    {
        $data = [];
        $dataActive = $this->post
            ->with('user', 'admin', 'mitra')
            ->where(function ($query) {
                $query->where('verified', 'verified')
                    ->where('expired', '>', Carbon::now());
            })
            ->get();

        $dataNonActive = $this->post
            ->with('user', 'admin')
            ->where('verified', 'rejected')
            ->orwhere('expired', '<=', Carbon::now())
            ->get();


        $data['countPerDayActive'] = [];
        $startDate = now()->startOfWeek(); // Mendapatkan awal minggu (Minggu)
        $endDate = now()->endOfWeek(); // Mendapatkan akhir minggu (Sabtu)

        while ($startDate <= $endDate) {
            $count = $this->post
                ->whereDate('created_at', $startDate->toDateString())
                ->where('expired', '>', Carbon::now())
                ->where('verified', 'verified')
                ->count();

            $data['countPerDayActive'][$startDate->format('Y-m-d')] = $count;

            $startDate->addDay();
        }

        $data['countPerDayNonactive'] = [];
        $startDate = now()->startOfWeek(); // Mendapatkan awal minggu (Minggu)
        $endDate = now()->endOfWeek(); // Mendapatkan akhir minggu (Sabtu)

        while ($startDate <= $endDate) {
            $count = $this->post
                ->whereDate('created_at', $startDate->toDateString())
                ->where(function ($query) {
                    $query->where('verified', '!=', 'verified') // Assuming 'verified' is a specific value, update accordingly
                        ->orWhere('expired', '<', Carbon::now());
                })
                ->count();

            $data['countPerDayNonactive'][$startDate->format('Y-m-d')] = $count;

            $startDate->addDay();
        }



        $data['active'] = $dataActive;
        $data['nonActive'] = $dataNonActive;
        $data['countPerDayActive'] = array_values($data['countPerDayActive']);
        $data['countPerDayNonactive'] = array_values($data['countPerDayNonactive']);

        return $data;
    }



    public function countPostByUserId($id)
    {
        $user = User::where('id', $id)->first();
        if (!isset($user)) {
            throw new NotFoundException("Ops , user tidak ditemukan");
        }
        return $this->post->where('user_id', $id)->count();
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
            'ttl' => $user->ttl,
            'alamat' => $user->visible_alamat == 1 ? $user->alamat : "***",
            "about" => $user->about,
            "gender" => $user->gender,
            "level" => $user->level,
            "linkedin" => $user->linkedin,
            "facebook" => $user->facebook,
            "instagram" => $user->instagram,
            'twiter' => $user->twiter,
            'account_status' => $user->account_status,
            "latitude" => $user->latitude,
            "longtitude" => $user->longtitude
        ];
    }
}
