<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TokenMiddleware;
use App\Http\Requests\AddNewJobsRequest;
use App\Services\JobsService;
use App\Services\UserService;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    //

    private JobsService $jobsService;
    private UserService $userService;


    public function __construct()
    {
        $this->jobsService = new JobsService();
        $this->userService = new UserService();
        $this->middleware([TokenMiddleware::class]);
    }


    public function addNewJobsUser(AddNewJobsRequest $addNewJobsRequest)
    {
        $addNewJobsRequest->validate($addNewJobsRequest->rules(), $addNewJobsRequest->messages());
        $token = $addNewJobsRequest->bearerToken();
        $userId = $this->userService->extractUserId($token);
        return $this->jobsService->addNewJobs($addNewJobsRequest->all(), $userId);
    }

    public function showJobsUserLogin(Request $request)
    {
        $token = $request->bearerToken();
        $userId = $this->userService->extractUserId($token);
        return $this->jobsService->showJobsUserLogin($userId);
    }

}