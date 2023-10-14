<?php

namespace App\Http\Controllers;

use App\Http\Middleware\TokenMiddleware;
use App\Http\Middleware\VeriviedMiddleware;
use App\Http\Requests\AddNewJobsRequest;
use App\Http\Requests\UpdateJobsRequest;
use App\Services\JobsService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{
    //

    private JobsService $jobsService;
    private UserService $userService;


    public function __construct()
    {
        $this->jobsService = new JobsService();
        $this->userService = new UserService();
        $this->middleware([TokenMiddleware::class, VeriviedMiddleware::class]);
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

    public function updateJobsUserLogin(UpdateJobsRequest $updateJobsRequest)
    {
        $updateJobsRequest->validate($updateJobsRequest->rules(), $updateJobsRequest->messages());

        $userId = $this->userService->extractUserId($updateJobsRequest->bearerToken());
        return $this->jobsService->updateJobsUserLogin($updateJobsRequest->all(), $userId);
    }


    public function findJobsUserLoginById(Request $request, $id)
    {

        $userId = $this->userService->extractUserId($request->bearerToken());
        return $this->jobsService->findByIdJobsUserLogin($userId, $id);
    }

    public function removeJobsUserLoginById(Request $request)
    {
        $userId = $this->userService->extractUserId($request->bearerToken());
        $valid = Validator::make($request->all(), [
            'jobs_id' => 'required'
        ]);
        if ($valid->fails()) {
            return response()->json(
                [
                    'status' => false,
                    "message" => $valid->errors()->first(),
                    'data' => null,
                    'code' => 400
                ],
                400
            );
        }
        return $this->jobsService->removeJobsUserLogin($request->input('jobs_id'), $userId);
    }

}