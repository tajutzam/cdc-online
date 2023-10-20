<?php



namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
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
            return $this->successResponse($isCreated, 201, 'Success add new post');
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
                'verivied' => true,
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
            'verivied' => $data['verified']
        ]);

        if ($updated) {
            DB::commit();
            return $this->successResponse($updated, 200, 'success update verifikasi');
        }
        throw new Exception('ops , gagal mengupdate verifikasi');
    }





    private function successResponse($data, $code, $message)
    {
        return response()->json(
            [
                'status' => true,
                'data' => $data,
                'message' => $message,
                'code' => $code
            ],
            $code
        );
    }

    public function getAllPost($page)
    {
        $now = Carbon::now(); // Mendapatkan tanggal saat ini menggunakan Carbon
        $expiredPosts = $this->post->where('expired', '>', $now)->where('verivied', true)->paginate(10, ['*'], 'page', $page);
        $data = [
            'total_page' => $expiredPosts->lastPage(),
            'total_item' => $expiredPosts->total()
        ];
        foreach ($expiredPosts as $datum) {
            $tempPost = $this->castToResponse($datum);
            array_push($data, $tempPost);
        }
        return $this->successResponse($data, 200, 'success fetch data');
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
        return $this->successResponse($data, 200, 'success fetch data');
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
                return $this->successResponse($isUpdate, 200, 'success update post lowongan pekerjaan');
            }
            Db::rollback();
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
                return $this->successResponse(true, 200, 'success delete postingan');
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
                return $this->successResponse($isUpdate, 200, 'berhasil memperbarui setelan komentar');
            }
            Db::rollBack();
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
            'verified' => $data->verivied
        ];
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
            'verified' => $data['verivied'],
            'user' => $data['user'],
            'admin' => $data['admin']
        ];
    }


    public function findAllPostFromAdmin()
    {
        $data = $this->post->with('user', 'admin')->orderBy('verivied', 'asc')->get()->toArray();
        $collection = collect($data);
        return $collection->map(function ($data) {
            return $this->castToResponseFromArray($data);
        })->toArray();
    }
}
