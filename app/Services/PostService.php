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



    public function __construct()
    {
        $this->post = new Post();
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
            return ResponseHelper::successResponse('Berhasil menambahkan postingan', $isCreated, 201);
        }
        throw new BadRequest('Ops , gagal membuat postingan terjadi kesalahan');
    }

    public function addPostJobAdmin($image, $adminId, $request, $isCanComment)
    {
        DB::beginTransaction();
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
                'message' => 'success membuat lowongan'
            ];
        } else {
            DB::rollBack();
            return [
                'status' => false,
                'message' => 'Gagal membuat lowongan'
            ];
        }
    }


    public function updateVerified($data)
    {

        DB::beginTransaction();

        $updated = $this->post->where('id', $data['id'])->update([
            'verified' => $data['verified']
        ]);

        if ($updated) {
            DB::commit();
            return ResponseHelper::successResponse('Berhasil memperbarui verifikasi', $updated, 200);
        }
        throw new WebException('ops , gagal mengupdate verifikasi');
    }



    public function getAllPost($page, $userId)
    {
        $now = Carbon::now(); // Mendapatkan tanggal saat ini menggunakan Carbon


        $expiredPosts = $this->post
            ->where('expired', '>', $now)
            ->where('verified', 'verified')
            ->where('user_id', '<>', $userId)
            ->orWhereNotNull('admin_id') // Menambahkan kondisi admin_id tidak null
            ->with('comments', 'user', 'admin')
            ->paginate(10, ['*'], 'page', $page);


        $data = [
            'total_page' => $expiredPosts->lastPage(),
            'total_item' => $expiredPosts->total()
        ];
        foreach ($expiredPosts as $datum) {
            $tempPost = $this->castToResponse($datum);
            array_push($data, $tempPost);
        }
        return ResponseHelper::successResponse('Success fetch data', $data, 200);

    }

    public function getPostByUserId($id, $page)
    {
        $dataPost = $this->post->where('user_id', $id)->paginate(10, ['*'], 'page', $page);
        $dataPagination = [
            'total_page' => $dataPost->lastPage(),
            'total_item' => $dataPost->total(),
        ];
        $data['posts'] = [];
        $data['pagination'] = $dataPagination;
        foreach ($dataPost as $datum) {
            $tempPost = $this->castToResponse($datum);
            array_push($data['posts'], $tempPost);
        }
        return ResponseHelper::successResponse('success fetch data', $data, 200);
    }


    public function updatePost($request, $userId, $id)
    {
        DB::beginTransaction();
        $post = $this->findById($id);
        if ($post->user_id == $userId) {
            $isUpdate = $post->update(
                [
                    'description' => $request['description'],
                    'link' => $request['link'],
                    'type_jobs' => $request['type_jobs'],
                    'company' => $request['company'],
                    'position' => $request['position'],
                    'post_at' => $request['post_at'],
                    'expired' => $request['expired']
                ]
            );
            if ($isUpdate) {
                Db::commit();
                return ResponseHelper::successResponse('Berhasil memperbarui postingan', $isUpdate, 200);
            }
            throw new Exception('ops , gagal memperbarui postingan terjadi kesalahan');
        }
        throw new BadRequestException('Ops , user tidak memiliki postingan tersebut');
    }

    public function deletePost($id, $userId)
    {
        DB::beginTransaction();
        $post = $this->findById($id);
        if ($post->user_id == $userId) {
            $isDelete = $post->delete();
            if ($isDelete) {
                Db::commit();
                return ResponseHelper::successResponse('Berhasil memperbarui setelan komentar', true, 200);
            } else {
                throw new Exception('ops , gagal menghapus postingan terjadi kesalahan');
            }
        }
        throw new NotFoundException('Ops , user tidak memiliki postingan tersebut');
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
                return ResponseHelper::successResponse('Berhasil memperbarui setelan komentar', $isUpdate, 200);
            }
            throw new Exception('ops , gagal memperbarui setelan komentar');
        }
        throw new NotFoundException('ops , user tidak memiliki postingan tersebut');
    }

    public function findById($id)
    {
        $post = $this->post->where('id', $id)->first();
        if (isset($post)) {
            return $post;
        }
        throw new NotFoundException('Ops , postingan tidak ditemukan');
    }

    public function info()
    {
        echo phpinfo();
    }
    private function castToResponse($data)
    {

        $fotoName = isset($data->image) == true ? $data->image : '';
        $url = url('/') . "/users/post/" . $fotoName;
        $uploader = null;
        if (isset($data->user)) {
            $uploader = $this->castToUserResponse($data->user);
        } else {
            $uploader = $data->admin;
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
            'comments' => $data->comments,
            'type_jobs' => $data->type_jobs,
            'uploader' => $uploader
        ];
    }


    public function findByPosition($request, $userId)
    {

        $posts = $this->post
            ->where(function ($query) use ($userId) {
                $query->where('user_id', '<>', $userId)
                    ->orWhereNull('user_id');
            })
            ->where('position', 'like', '%' . $request['key'] . '%')
            ->where('expired', '>', Carbon::now())
            ->where('verified', 'verified')
            ->with('user', 'admin')
            ->get();

        if (sizeof($posts) == 0) {
            throw new NotFoundException('ops , postingan dengan posisi ' . $request['key'] . " tidak ditemukan");
        }

        return collect($posts->toArray())->map(function ($post) {
            return $this->castToResponseFromArray($post);
        })->toArray();
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
            'admin' => $data['admin'] ?? null
        ];
    }


    public function findVerivyVacancy()
    {
        $data = $this->post->where(
            'verified',
            'waiting'
        )->with('user', 'admin')->orderBy('verified', 'asc')->get()->toArray();
        $collection = collect($data);
        return $collection->map(function ($data) {
            return $this->castToResponseFromArray($data);
        })->toArray();
    }


    public function findHistoryVacancy()
    {
        $data = $this->post
            ->with('user', 'admin')
            ->where(function ($query) {
                $query->where('verified', 'verified')
                    ->orWhere('verified', 'rejected');
            })
            ->get();


        $verifiedPosts = [];
        $rejectedPosts = [];

        // Loop through the $data collection and categorize posts
        foreach ($data as $post) {
            if ($post->verified === 'verified') {
                $verifiedPosts[] = $post;
            } else if ($post->verified === 'rejected') {
                $rejectedPosts[] = $post;
            }
        }

        return $data;
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

