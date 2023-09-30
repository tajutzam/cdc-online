<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TokenMiddleware;
use App\Http\Requests\AddEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Services\EducationService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducationController extends Controller
{
    //
    private EducationService $educationService;
    private UserService $userService;

    public function __construct()
    {
        $this->educationService = new EducationService();
        $this->userService = new UserService();
        $this->middleware(TokenMiddleware::class); // user need token to access this controller
    }

    public function addNewEducationUser(AddEducationRequest $request)
    {
        $request->validate($request->rules(), $request->messages());
        $token = $request->bearerToken();
        $id = $this->userService->extractUserId($token);

        return $this->educationService->addNewEducationUser($request->all(), $id);
    }

    public function showEducationUserLogin(Request $request)
    {
        $token = $request->bearerToken();
        $id = $this->userService->extractUserId($token);
        return $this->educationService->showEducationUser($id);
    }


    public function updateEducationUserLogin(UpdateEducationRequest $updateEducationRequest, $idEducation)
    {
        $token = $updateEducationRequest->bearerToken();
        $id = $this->userService->extractUserId($token);
        return $this->educationService->updateEducationUser($updateEducationRequest->all(), $id, $idEducation);
    }

    public function deleteEducationById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_education' => 'required|string',
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
        return $this->educationService->deleteEducationByIdAndUserLogin($request->input('id_education'), $userId);
    }

    public function findEducationByIdAndUserId(Request $request, $id)
    {
        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->educationService->findEducationById($id, $userId);
    }


}