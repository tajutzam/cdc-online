<?php



namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Cloudinary\Api\Exception\BadRequest;
use Exception;
use Illuminate\Support\Carbon;
use Iloveimg\Iloveimg;
use Intervention\Image\Facades\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class PostService
{


    private Post $post;



    public function __construct()
    {
        $this->post = new Post();

    }

    public function addPostJob($userId, $image, $request)
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
                'type_job' => $request['type_job'],
                'expired' => Carbon::parse($request['expired']),
                'user_id' => $userId
            ]
        );
        if (isset($isCreated)) {
            $url = url('/') . "/users/post/" . $fileName;
            $isCreated['image'] = $url;
            return $this->successResponse($isCreated, 201, 'Success add new post');
        }
        throw new BadRequest('Ops , gagal membuat postingan terjadi kesalahan');
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
        $expiredPosts = $this->post->where('expired', '>', $now)->paginate(10, ['*'], 'page', $page);
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
        $data = [
            'total_page' => $dataPost->lastPage(),
            'total_item' => $dataPost->total(),
        ];
        foreach ($dataPost as $datum) {
            $tempPost = $this->castToResponse($datum);
            array_push($data, $tempPost);
        }
        return $this->successResponse($data, 200, 'success fetch data');
    }

    public function findById($id)
    {
        return $this->post->find($id);
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
            'post_at' => $data->post_at
        ];
    }

}