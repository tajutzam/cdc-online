<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Helper\ResponseHelper;
use App\Http\Middleware\TokenMiddleware;
use App\Http\Middleware\VeriviedMiddleware;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateVisibleRequest;
use App\Services\UserService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

class UserController extends Controller
{
    //
    private UserService $userService;

    public function __construct()
    {
        $this->middleware([TokenMiddleware::class]);
        $this->userService = new UserService();
    }


    /**
     * @OA\PathItem(
     *   path="/api/user",
     * )
     */
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
        $userId = $this->userService->extractUserId($request->bearerToken());
        $data = $this->userService->findAllUser($request->get('page'), $request->get('angkatan'), $request->get('prodi'), $userId);
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

    public function findAllFollowers(Request $request)
    {

        $token = $request->bearerToken();
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
        return $this->userService->findUserById($id, $request->bearerToken());

    }

    public function sendFcmToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->userService->sendFcmToken($request->input('token'), $userId);
    }


    public function findByName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }


        $userId = $this->userService->extractUserId($request->bearerToken());

        $response = $this->userService->findByName($request->all(), $userId);
        return ResponseHelper::successResponse('success fetch data', $response, 200);
    }

    public function getTopUser()
    {
        $response = $this->userService->getTopUser();
        return ResponseHelper::successResponse('success fetch data', $response, 200);
    }


    public function getTopSalary()
    {
        $response = $this->userService->getTopUserBySalary();
        return ResponseHelper::successResponse('success fetch data', $response, 200);
    }



    public function setPosition(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longtitude' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }
        $userId = $this->userService->extractUserId($request->bearerToken());
        $response = $this->userService->updateLongtitudeLangtitude($request->all(), $userId);
        return ResponseHelper::successResponse('success update latitude', $response, 200);

    }

}