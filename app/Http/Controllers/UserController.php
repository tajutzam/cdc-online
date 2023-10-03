<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TokenMiddleware;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateVisibleRequest;
use App\Services\UserService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    private UserService $userService;

    public function __construct()
    {
        $this->middleware(TokenMiddleware::class);
        $this->userService = new UserService();
    }

    public function getOneUser(Request $request)
    {
        $token = $request->header('Authorization');
        $data = $this->userService->findUserByToken(Str::after($token, 'Bearer '));
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'fetch success',
            'data' => $data
        ], 200);
    }

    public function findAllUser(Request $request)
    {
        $data = $this->userService->findAllUser($request->get('page'), $request->get('angkatan'), $request->get('prodi'));
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'fetch success',
            'data' => $data
        ], 200);
    }

    public function updateVisibility(UpdateVisibleRequest $updateVisibleRequest)
    {
        $request = $updateVisibleRequest->all();
        $rawToken = $updateVisibleRequest->header('Authorization');
        $token = Str::after($rawToken, "Bearer ");
        return $this->userService->updateVisible($request, $token);
    }

    public function findFolowersByUserLogin(Request $request)
    {
        dd($request);
        $rawToken = $request->header('Authorization');
        $token = Str::after($rawToken, "Bearer ");
        return $this->userService->findAllFolowersLogin($token);
    }

    public function findAllFolowersJoin($id)
    {
        return $this->userService->findAllFollowersByUserId($id);
    }

    public function followUser(Request $request)
    {
        $userId = $this->userService->extractUserId($request->bearerToken());
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'data' => null,
                'code' => 400
            ], 400);
        }
        return $this->userService->followUser($userId, $request->input('user_id'));
    }

    public function unfollowUser(Request $request)
    {
        $userId = $this->userService->extractUserId($request->bearerToken());
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'data' => null,
                'code' => 400
            ], 400);
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->userService->unfollowUser($userId, $request->input('user_id'));
    }

    public function showUserFolowed(Request $request)
    {
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->userService->showUserFollowed($userId);
    }

    public function showUserFolowedById($id)
    {
        return $this->userService->showUserFollowed($id);

    }

    public function updateProfileUserLogin(UpdateProfileRequest $updateProfileRequest)
    {
        $updateProfileRequest->validate($updateProfileRequest->rules(), $updateProfileRequest->messages());
        $userId = $this->userService->extractUserId($updateProfileRequest->bearerToken());
        return $this->userService->updateUserLogin($updateProfileRequest->all(), $userId);
    }

    public function updateEmailUserLogin(Request $request)
    {

        $validator = Validator::make($request->all(), ['email' => 'required|email|unique:users,email']);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'code' => 400
            ], 400);
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->userService->updateEmail($userId, $request->input('email'));
    }

    public function updateFotoProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'code' => 400,
                'data' => null
            ], 400);
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->userService->updateFotoProfile($request->file('image'), $userId);
    }

    public function findUserById(Request $request, $id)
    {
        $data = $this->userService->findUserById($id, $request->bearerToken());
        return response()->json([
            'status' => true,
            'message' => 'success fetch data',
            'data' => $data,
            'code' => 200
        ], 200);
    }

}