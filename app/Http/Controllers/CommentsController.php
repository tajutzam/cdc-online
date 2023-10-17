<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Helper\ResponseHelper;
use App\Http\Middleware\TokenMiddleware;
use App\Services\CommentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    //


    private CommentService $commentService;
    private UserService $userService;

    public function __construct()
    {
        $this->commentService = new CommentService();
        $this->userService = new UserService();
        $this->middleware([TokenMiddleware::class]);
    }

    public function addComment(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'post_id' => 'required',
            'comment' => 'required'
        ]);
        if ($validated->fails()) {
            throw new BadRequestException($validated->errors()->first());
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        $data = $this->commentService->addComment($userId, $request->input('post_id'), $request->input('comment'));
        return ResponseHelper::successResponse(
            $data['message'],
            $data['data'],
            $data['code']
        );
    }

    public function deleteComment(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'post_id' => 'required',
            'comment_id' => 'required'
        ]);
        if ($validated->fails()) {
            throw new BadRequestException($validated->errors()->first());
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        $data = $this->commentService->deleteComment($request->input('post_id'), $request->input('comment_id'), $userId);
        return ResponseHelper::successResponse(
            $data['message'],
            $data['data'],
            $data['code']
        );
    }

}