<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\NewsController as ApiNewsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuisionerController;
use App\Http\Controllers\StudyProgramPublicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\web\NewsController;
use App\Http\Controllers\WhatshappController;
use App\Http\Middleware\TokenMiddleware;
use App\Http\Middleware\VeriviedMiddleware;
use App\Services\UserService;
use GuzzleHttp\Middleware;
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
Route::get("/users", [UserController::class, "findAllUser"])->middleware([VeriviedMiddleware::class]);
Route::get("/user/detail/{id}", [UserController::class, "findUserById"])->middleware([VeriviedMiddleware::class]);

Route::post("/user/search", [UserController::class, 'findByName'])->withoutMiddleware(VeriviedMiddleware::class);


Route::put("/user/visibility/update", [UserController::class, "updateVisibility"])->middleware([VeriviedMiddleware::class]);

Route::put("/user/profile", [UserController::class, "updateProfileUserLogin"])->middleware([VeriviedMiddleware::class]);

Route::get("/user/followers", [UserController::class, "findAllFollowers"])->middleware([VeriviedMiddleware::class]);

Route::get("/user/followers/{id}", [UserController::class, "findAllFolowersJoin"])->middleware([VeriviedMiddleware::class]);

Route::post("/user/followers", [UserController::class, "followUser"])->middleware([VeriviedMiddleware::class]);

Route::delete("/user/followers", [UserController::class, "unfollowUser"])->middleware([VeriviedMiddleware::class]);

Route::get("/user/followed", [UserController::class, "showUserFolowed"])->middleware([VeriviedMiddleware::class]);

Route::get("/user/followed/{id}", [UserController::class, 'showUserFolowedById'])->middleware([VeriviedMiddleware::class]);

Route::put("/user/profile/email", [UserController::class, "updateEmailUserLogin"])->middleware([VeriviedMiddleware::class]);

Route::post("/user/profile/image", [UserController::class, "updateFotoProfile"])->middleware([VeriviedMiddleware::class]);

// education
Route::post("/user/education/add", [EducationController::class, "addNewEducationUser"])->middleware([VeriviedMiddleware::class]);

Route::get("/user/education", [EducationController::class, "showEducationUserLogin"])->withoutMiddleware([VeriviedMiddleware::class]);

Route::put("/user/education/{idEducation}", [EducationController::class, "updateEducationUserLogin"])->middleware([VeriviedMiddleware::class]);

Route::delete("/user/education", [EducationController::class, "deleteEducationById"])->middleware([VeriviedMiddleware::class]);

Route::get("/user/education/{id}", [EducationController::class, "findEducationByIdAndUserId"])->middleware([VeriviedMiddleware::class]);

//jobs
Route::post("/user/jobs", [JobsController::class, "addNewJobsUser"]);


Route::get("/user/jobs/{id}", [JobsController::class, "findJobsUserLoginById"]);

Route::get("/user/jobs", [JobsController::class, "showJobsUserLogin"])->withoutMiddleware(VeriviedMiddleware::class);
Route::put("/user/jobs", [JobsController::class, "updateJobsUserLogin"]);

Route::delete('/user/jobs', [JobsController::class, "removeJobsUserLoginById"]);


// auth
Route::post("/auth/login", [AuthController::class, "login"])->withoutMiddleware(VeriviedMiddleware::class);
Route::post("/auth/user/register", [AuthController::class, "registerUser"])->withoutMiddleware(VeriviedMiddleware::class);
Route::post("/auth/recovery", [AuthController::class, "recovery"]);
Route::get("/user/verivication/email", [AuthController::class, "updateEmailVerified"])->withoutMiddleware(VeriviedMiddleware::class);


// prodi
Route::get("/prodi", [StudyProgramPublicController::class, "findAll"]);

// quisioner
Route::post("/user/quisioner/identity", [QuisionerController::class, 'addQuisionerIdentity']);
Route::post("/user/quisioner/main", [QuisionerController::class, "addQuisionerMain"]);
Route::post("/user/quisioner/furthestudy", [QuisionerController::class, 'addQuisionerFurtheStudy']);
Route::post("/user/quisioner/competence", [QuisionerController::class, 'addQuisionerCompetence']);
Route::post("/user/quisioner/studymethod", [QuisionerController::class, 'addQuisionerStudyMethod']);
Route::post("/user/quisioner/jobstreet", [QuisionerController::class, 'addQuisionerJobStreet']);
Route::post("/user/quisioner/howtofindjobs", [QuisionerController::class, 'addQuisionerHowFindJobs']);
Route::post("/user/quisioner/companyapplied", [QuisionerController::class, 'addQuisionerCompanyApplied']);
Route::post("/user/quisioner/jobsuitability", [QuisionerController::class, 'addQuisionerjobSuitability']);
Route::get("/user/quisioner/check", [QuisionerController::class, 'showUpdateQuisionerLevel']);
Route::post("/user/logout", [UserController::class, "logout"]);
Route::post("/user/post", [PostController::class, 'addPost'])->middleware([TokenMiddleware::class, VeriviedMiddleware::class]);
Route::get("/user/post", [PostController::class, 'getAllPost'])->middleware([TokenMiddleware::class]);
Route::get("/user/post/login", [PostController::class, 'getPostUserLogin'])->middleware([TokenMiddleware::class]);
Route::get("/user/post/detail/{id}", [PostController::class, 'getPostByUserId'])->middleware([TokenMiddleware::class]);
Route::put("/user/post/update/{id}", [PostController::class, "updatePost"])->middleware([TokenMiddleware::class, VeriviedMiddleware::class]);
Route::delete("/user/post/delete/{id}", [PostController::class, "deletePost"])->middleware([TokenMiddleware::class, VeriviedMiddleware::class]);
Route::put("/user/post/update/comment/{id}", [PostController::class, 'updateComment'])->middleware([TokenMiddleware::class, VeriviedMiddleware::class]);
Route::get("/user/whatsapp", [WhatshappController::class, 'findAll']);
Route::get("/user/notifications" , [NotificationsController::class , "findAllNotificationsUser"]);


Route::post('/user/post/search', [PostController::class, 'findByPosition'])->middleware(TokenMiddleware::class);

// NEWS USER
Route::get('/user/news', [ApiNewsController::class, 'findAllActive']);
Route::get('/user/news/{id}', [ApiNewsController::class, 'findById']);


// notifications
Route::put('/user/fcmtoken', [UserController::class, 'sendFcmToken'])->withoutMiddleware(VeriviedMiddleware::class);
Route::put("/user/position", [UserController::class, "setPosition"]);

Route::get("/user/ranking/followers", [UserController::class, "getTopUser"]);
Route::get("/user/ranking/salary", [UserController::class, "getTopSalary"]);


// comment
Route::post('/user/post/comment', [CommentsController::class, 'addComment']);
Route::delete('/user/post/comment', [CommentsController::class, 'deleteComment']);


// admin api
Route::put("/admin/lowongan/verified", [PostController::class, 'updateVerified'])->withoutMiddleware([TokenMiddleware::class, VeriviedMiddleware::class]);

Route::get("/auth/generate/token", [AuthController::class, "generateTokenApiPolije"]);
Route::post('/auth/verifikasi/email', [AuthController::class, 'verifikasiEmail']);

Route::get("/auth/verifikasi", [AuthController::class, "verifikasi"]);
Route::get("/alumni/update", [AuthController::class, "verifikasi"]);
Route::get("/alumni/check", [AuthController::class, 'checkAlumniData']);


Route::post("/alumni/submissions", [AlumniController::class, 'submissions']);
Route::get("/alumni/submissions", [AlumniController::class, 'findAllSubmissions']);
Route::post('/alumni/acc', [AlumniController::class, 'accOrReject']);

Route::post('/verifikasi/alumni', [AlumniController::class, 'verifikasiAlumni']);


// documentations
Route::get('/api/documentation', function () {
    return view('vendor.l5-swagger.index');
});
