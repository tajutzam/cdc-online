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
     * @OA\Get(
     *     path="/user",
     *     tags={"User"},
     *     summary="Get user login",
     *     description="Returns user data",
     *     operationId="getUserData",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="fetch success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="string", format="uuid", example="42435330-f8d0-42c2-8d30-96b1c9659093"),
     *                     @OA\Property(property="fullname", type="string", example="mohammad tajut zamzami"),
     *                     @OA\Property(property="email", type="string", example="test@gmail.com"),
     *                     @OA\Property(property="nik", type="string", example="***"),
     *                     @OA\Property(property="no_telp", type="string", example="***"),
     *                     @OA\Property(property="foto", type="string", format="uri", example="http://localhost:8000/users/foto.png"),
     *                     @OA\Property(property="ttl", type="string", format="date-time", example="2023-11-06T12:00:00Z"),
     *                     @OA\Property(property="alamat", type="string", example="jawa timur , banyuwangi"),
     *                     @OA\Property(property="about", type="string", example="saya adalah orang yang memiliki tekat tinggi"),
     *                     @OA\Property(property="gender", type="string", example="male"),
     *                     @OA\Property(property="level", type="string", example="user"),
     *                     @OA\Property(property="linkedin", type="string", example="linkedin.com/zam"),
     *                     @OA\Property(property="facebook", type="string", example=null),
     *                     @OA\Property(property="instagram", type="string", example=null),
     *                     @OA\Property(property="twitter", type="string", example=null),
     *                     @OA\Property(property="account_status", type="integer", example=1),
     *                     @OA\Property(property="latitude", type="string", example="123123123"),
     *                     @OA\Property(property="longitude", type="string", example="123123123"),
     *                     @OA\Property(property="state_quisioner", type="string", example="0")
     *                 ),
     *                 @OA\Property(property="followers", type="array", @OA\Items(type="object")),
     *                 @OA\Property(property="jobs", type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="string", format="uuid", example="93f23e3e-b758-4e4b-877a-2032fc167d91"),
     *                         @OA\Property(property="user_id", type="string", format="uuid", example="42435330-f8d0-42c2-8d30-96b1c9659093"),
     *                         @OA\Property(property="perusahaan", type="string", example="BUMN"),
     *                         @OA\Property(property="jabatan", type="string", example="Backend Developer"),
     *                         @OA\Property(property="gaji", type="integer", example=20000000),
     *                         @OA\Property(property="jenis_pekerjaan", type="string", example="Tetap"),
     *                         @OA\Property(property="tahun_masuk", type="string", example="2022"),
     *                         @OA\Property(property="tahun_keluar", type="string", example="2023"),
     *                         @OA\Property(property="pekerjaan_saatini", type="integer", example=0),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2023-11-03T18:04:57.000000Z"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2023-11-03T18:04:57.000000Z")
     *                     )
     *                 ),
     *                 @OA\Property(property="educations", type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="perguruan", type="string", example="Politeknik Negeri Jember"),
     *                         @OA\Property(property="strata", type="string", example="D4 - Sarjana Terapan"),
     *                         @OA\Property(property="jurusan", type="string", example="Teknologi Informasi"),
     *                         @OA\Property(property="prodi", type="string", example="Teknik Infomatika"),
     *                         @OA\Property(property="tahun_masuk", type="integer", example=2020),
     *                         @OA\Property(property="tahun_lulus", type="integer", example=2022),
     *                         @OA\Property(property="id", type="string", format="uuid", example="3cef676c-a46c-4bc0-add2-c688db509d32"),
     *                         @OA\Property(property="no_ijazah", type="string", example=null)
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",   
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="code", type="integer", example=401),
     *             @OA\Property(property="message", type="string", example="Ops your token is not valid"),
     *             @OA\Property(property="data", type="object", example=null),
     * 
     *      )
     *   )
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

    /**
     * @OA\Get(
     *     path="/users",
     *     summary="Find all user",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="angkatan",
     *         in="query",
     *         description="Angkatan filter",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="prodi",
     *         in="query",
     *         description="Program Studi filter",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean"),
     *             @OA\Property(property="code", type="integer"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="total_page", type="integer"),
     *                 @OA\Property(property="total_items", type="integer"),
     *                 @OA\Property(property="0", type="object",
     *                     @OA\Property(property="user", type="object",
     *                         @OA\Property(property="id", type="string"),
     *                         @OA\Property(property="fullname", type="string"),
     *                         @OA\Property(property="email", type="string"),
     *                         @OA\Property(property="nik", type="string"),
     *                         @OA\Property(property="no_telp", type="string"),
     *                         @OA\Property(property="foto", type="string"),
     *                         @OA\Property(property="ttl", type="string", nullable=true),
     *                         @OA\Property(property="alamat", type="string"),
     *                         @OA\Property(property="about", type="string"),
     *                         @OA\Property(property="gender", type="string"),
     *                         @OA\Property(property="level", type="string"),
     *                         @OA\Property(property="linkedin", type="string"),
     *                         @OA\Property(property="facebook", type="string", nullable=true),
     *                         @OA\Property(property="instagram", type="string", nullable=true),
     *                         @OA\Property(property="twiter", type="string", nullable=true),
     *                         @OA\Property(property="account_status", type="integer"),
     *                         @OA\Property(property="latitude", type="string", nullable=true),
     *                         @OA\Property(property="longtitude", type="string", nullable=true),
     *                         @OA\Property(property="state_quisioner", type="string")
     *                     ),
     *                     @OA\Property(property="followers", type="array", @OA\Items()),
     *                     @OA\Property(property="jobs", type="array", @OA\Items()),
     *                     @OA\Property(property="educations", type="array", @OA\Items(
     *                         @OA\Property(property="perguruan", type="string"),
     *                         @OA\Property(property="strata", type="string"),
     *                         @OA\Property(property="jurusan", type="string"),
     *                         @OA\Property(property="prodi", type="string"),
     *                         @OA\Property(property="tahun_masuk", type="integer"),
     *                         @OA\Property(property="tahun_lulus", type="integer"),
     *                         @OA\Property(property="id", type="string"),
     *                         @OA\Property(property="no_ijasah", type="string", nullable=true)
     *                     ))
     *                 )
     *             )
     *         )
     *     )
     * )
     */
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

    public function logout(Request $request)
    {
        $userId = $this->userService->extractUserId($request->bearerToken());
        $response = $this->userService->logout($userId);
        return ResponseHelper::successResponse($response['message'], $response['data'], $response['code']);
    }

}