<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
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
        return $this->postService->getAllPost($request->get('page'));
    }



}