<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Helper\ResponseHelper;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //

    private PostService $postService;
    private UserService $userService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->userService = new UserService();
    }


    public function addPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
            'link_apply' => 'required',
            'company' => 'required',
            'description' => 'required',
            'expired' => 'required|date_format:Y-m-d',
            'type_job' => 'required|in:Purnawaktu,Paruh Waktu,Wiraswasta,Pekerja Lepas,Kontrak,Musiman',
            'position' => 'required'
        ]);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        $image = $request->file('image');
        return $this->postService->addPostJob($userId, $image, $request->all());
    }

    public function getAllPost(Request $request)
    {

        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->postService->getAllPost($request->get('page'), $userId);
    }

    public function getPostUserLogin(Request $request)
    {
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->postService->getPostByUserId($userId, $request->get('page'));
    }

    public function getPostByUserId(Request $request, $id)
    {

        $this->userService->findUserById($id, $request->bearerToken());

        $data = $this->postService->getPostByUserId($id, $request->get('page'));
        $filter = $data->getData(true)['data'];

        $tempData = [];
        foreach ($filter['posts'] as $post) {
            if ($post['verified'] == true) {
                array_push($tempData, $post);
            }
        }
        unset($filter);
        $paginate = $data->getData(true)['data']['pagination'];
        $filter['pagination']['total_page'] = $paginate['total_page'];
        $filter['pagination']['total_item'] = sizeof($tempData);
        $filter['posts'] = $tempData;
        return response()->json(
            [
                'status' => 200,
                'message' => 'success fetch data',
                'data' => $filter
            ]
        );
    }



    public function updatePost(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'link' => 'url|required',
            'type_jobs' => 'required|in:Purnawaktu,Paruh Waktu,Wiraswasta,Pekerja Lepas,Kontrak,Musiman',
            'company' => 'required|string',
            'position' => 'required|string',
            'post_at' => 'required|date_format:Y-m-d',
            'expired' => 'required|date_format:Y-m-d',
        ]);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->postService->updatePost($request->all(), $userId, $id);
    }

    public function deletePost(Request $request, $id)
    {

        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->postService->deletePost($id, $userId);
    }

    public function updateComment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'option' => 'required|boolean'
        ]);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->postService->updateComment($id, $userId, $request->input('option'));
    }


    public function updateVerified(Request $request)
    {
        return $this->postService->updateVerified($request->all());
    }


    public function findByPosition(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'key' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }

        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->postService->findByPosition($request->all(), $userId);
    }
}
