<?php

use App\Http\Controllers\AuthController;
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
Route::get("/users" , [UserController::class , "findAllUser"]);
Route::put("/user/visibility/update" , [UserController::class , "updateVisibility"]);


Route::post("/auth/login", [AuthController::class, "login"]);

Route::post("/auth/user/register", [AuthController::class, "registerUser"]);