<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TokenMiddleware;
use App\Http\Requests\AddEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Services\EducationService;
use App\Services\UserService;
use Illuminate\Http\Request;

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

}