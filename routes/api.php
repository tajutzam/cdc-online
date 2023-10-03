<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenMiddleware;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// user
Route::get("/user", [UserController::class, "getOneUser"]);
Route::get("/users", [UserController::class, "findAllUser"]);
Route::put("/user/visibility/update", [UserController::class, "updateVisibility"]);
Route::put("/user/profile", [UserController::class, "updateProfileUserLogin"]);
Route::get("/user/followers", [UserController::class, "findFolowersByUserLogin"]);
Route::get("/user/followers/{id}", [UserController::class, "findAllFolowersJoin"]);
Route::post("/user/followers", [UserController::class, "followUser"]);
Route::delete("/user/followers", [UserController::class, "unfollowUser"]);
Route::get("/user/followed", [UserController::class, "showUserFolowed"]);
Route::get("/user/followed/{id}", [UserController::class, 'showUserFolowedById']);
Route::put("/user/profile/email", [UserController::class, "updateEmailUserLogin"]);
Route::put("/user/profile/image", [UserController::class, "updateFotoProfile"]);
// education
Route::post("/user/education/add", [EducationController::class, "addNewEducationUser"]);
Route::get("/user/education", [EducationController::class, "showEducationUserLogin"]);
Route::put("/user/education/{idEducation}", [EducationController::class, "updateEducationUserLogin"]);
Route::delete("/user/education", [EducationController::class, "deleteEducationById"]);
Route::get("/user/education/{id}", [EducationController::class, "findEducationByIdAndUserId"]);
//jobs
Route::post("/user/jobs", [JobsController::class, "addNewJobsUser"]);

Route::get("/user/jobs/{id}", [JobsController::class, "findJobsUserLoginById"]);
Route::get("/user/jobs", [JobsController::class, "showJobsUserLogin"]);
Route::put("/user/jobs", [JobsController::class, "updateJobsUserLogin"]);
Route::delete('/user/jobs', [JobsController::class, "removeJobsUserLoginById"]);

// auth
Route::post("/auth/login", [AuthController::class, "login"]);
Route::post("/auth/user/register", [AuthController::class, "registerUser"]);
Route::get("/user/verivication/email", [AuthController::class, "updateEmailVerified"]);