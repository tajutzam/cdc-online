<?php

use App\Http\Controllers\web\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\web\LegalisirController;
use App\Http\Controllers\web\NewsController;
use App\Http\Controllers\web\NotificationsController;
use App\Http\Controllers\web\PostController;
use App\Http\Controllers\web\ProdiController;
use App\Http\Controllers\web\UserController;
use App\Http\Middleware\AllowUnauthenticated;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(IsAdminMiddleware::class)->group(function () {
    Route::get('login', [AdminController::class, 'login'])->withoutMiddleware(IsAdminMiddleware::class)->middleware(AllowUnauthenticated::class);
    Route::post('login', [AuthController::class, 'loginAdmin'])->name('admin-login')->middleware(AllowUnauthenticated::class)->withoutMiddleware(IsAdminMiddleware::class);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::prefix('lowongan')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('post');
        Route::post('/store', [PostController::class, 'store'])->name('post-store');
    });
    Route::prefix('berita')->group(function () {
        Route::get('', [NewsController::class, 'index'])->name('berita');
        Route::post('', [NewsController::class, 'store'])->name('berita-post');
        Route::put('', [NewsController::class, 'update'])->name('berita-update');
        Route::delete('', [NewsController::class, 'delete'])->name('berita-delete');
    });
    Route::prefix('user')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('user');
    });
    Route::prefix('legalisir')->group(function () {
        Route::get('', [LegalisirController::class, 'index'])->name('legalisir');
    });

    Route::prefix('notifications')->group(function () {
        Route::get('', [NotificationsController::class, 'index'])->name('notifications');
    });
    Route::prefix('prodi')->group(function () {
        Route::get('', [ProdiController::class, 'index'])->name('prodi');
    });
});

Route::get('/info', function () {
    echo phpinfo();
});
