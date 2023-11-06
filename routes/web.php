<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\AlumniController;
use App\Http\Middleware\IsAdminMiddleware;

use App\Http\Controllers\web\NewsController;
use App\Http\Controllers\web\PostController;

use App\Http\Controllers\web\UserController;
use App\Http\Controllers\web\AdminController;
use App\Http\Controllers\web\ProdiController;

use App\Http\Middleware\AllowUnauthenticated;
use App\Http\Controllers\web\AktivasiController;

use App\Http\Controllers\web\FeedbackController;

use App\Http\Controllers\web\LegalisirController;

use App\Http\Controllers\web\QuisionerController;
use App\Http\Controllers\web\UserProdiController;
use App\Http\Controllers\web\AdminProdiController;
use App\Http\Controllers\web\ProdiAdminController;
use App\Http\Controllers\web\GrupWhatsappController;


use App\Http\Controllers\web\NotificationsController;
use App\Http\Controllers\web\ReferenceUserController;
use App\Http\Controllers\web\ProdiQuesionerController;
use App\Http\Middleware\IsProdiAdministratorMiddleware;
use App\Http\Controllers\web\ManageProdiAdminController;
use App\Http\Controllers\web\AuthController as WebAuthController;

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
    return view('landing-page.index');
})->name('/');

Route::get('/landing-page/blog', [NewsController::class, 'findAllBlog'])->name('blog');

Route::get('/landing-page/single-blog', function () {
    return view('landing-page.blog-single');
})->name('blog-single');

Route::get('/landing-page/portofolio', function () {
    return view('landing-page.portofolio-details');
})->name('portofolio-details');

Route::get('/forgotpassword/{token}', [WebAuthController::class, "recovery"])->name('forgotpassword');
Route::put("/forgotpassword/{token}", [WebAuthController::class, 'updatePassword'])->name('forgotpassword-put');

Route::get('/succeschange', function () {
    return view('admin.auth.successchange');
})->name('successchange');

Route::prefix('prodi')->middleware(IsProdiAdministratorMiddleware::class)->group(
    function () {
        Route::get('/dashboard', [AdminProdiController::class, 'dashboard'])->name('dashboard-prodi');
        Route::get('/settings-admin', [AdminProdiController::class, 'settingsAdmin'])->name('settings-admin-prodi');
        Route::prefix('quesioner')->group(function () {
            route::get('', [ProdiQuesionerController::class, 'index'])->name('quesioner-index');
            Route::get("/detail/{level}/{userId}", [QuisionerController::class, 'detailQuisionerProdi'])->name('detail-quisioner-prodi');
        });
        Route::prefix('user')->group(function () {
            Route::get('', [UserProdiController::class, 'index'])->name('user-prodi');
        });
        Route::get('', [ProdiAdminController::class, 'index']);
        Route::get('login', [ProdiAdminController::class, 'login'])->withoutMiddleware(IsProdiAdministratorMiddleware::class);
        Route::post("login", [WebAuthController::class, 'loginProdi'])->withoutMiddleware(IsProdiAdministratorMiddleware::class)->name('prodi-login');
        Route::post("logout", [ProdiAdminController::class, "logout"])->name('prodi-logout');
    }
);
Route::prefix('admin')->middleware(IsAdminMiddleware::class)->group(function () {
    Route::get('login', [AdminController::class, 'login'])->withoutMiddleware(IsAdminMiddleware::class)->middleware(AllowUnauthenticated::class);

    Route::post('login', [WebAuthController::class, 'loginAdmin'])->name('admin-login')->middleware(AllowUnauthenticated::class)->withoutMiddleware(IsAdminMiddleware::class);

    Route::post("logout", [AdminController::class, "logout"])->name('admin-logout');
    Route::get('', [AdminController::class, 'dashboard']);
    Route::get('/manage-admin', [AdminController::class, 'manageAdmin'])->name('manage-admin');
    Route::post("/manage-admin", [AdminController::class, 'register'])->name('manage-admin-post');
    Route::delete("/manage-admin", [AdminController::class, 'deleteAdmin'])->name('manage-admin-delete');
    Route::get('/manage-admin-prodi', [ManageProdiAdminController::class, 'manageAdminProdi'])->name('manage-admin-prodi');
    Route::post("/manage-admin-prodi", [ManageProdiAdminController::class, "addNewAdminProdi"])->name('manage-admin-prodi-add');
    Route::delete("/manage-admin-prodi", [ManageProdiAdminController::class, 'delete'])->name('manage-admin-prodi-delete');
    Route::get('/settings-admin', [AdminController::class, 'settingsAdmin'])->name('settings-admin');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/grup-whatsapp', [GrupWhatsappController::class, 'grupWhatsapp'])->name('grup');
    Route::post('/grup-whatsapp', [GrupWhatsappController::class, 'store'])->name('grup-post');
    Route::delete('/grup-whatsapp', [GrupWhatsappController::class, 'delete'])->name('grup-delete');
    Route::put('/grup-whatsapp', [GrupWhatsappController::class, 'update'])->name('grup-put');

    Route::get('/feedback', [FeedbackController::class, 'feedback'])->name('feedback');


    // Route::get('/trix', 'TrixController@index');
    // Route::post('/upload', 'TrixController@upload');
    // Route::post('/store', 'TrixController@store');

    Route::prefix('vacancy')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('vacancy');
        Route::post('/store', [PostController::class, 'store'])->name('vacancy-store');
        Route::put('/{id}', [PostController::class, 'verifyOrReject'])->name('vacancy-verify');
        Route::get('/history', [PostController::class, 'history'])->name('history');
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

    Route::prefix('reference-user')->group(function () {
        Route::get('', [AlumniController::class, 'findAllReferenceAlumni'])->name('reference-alumni');
        Route::put('', [AktivasiController::class, 'updateDataReference'])->name('reference-alumni-update');
    });

    Route::prefix('legalisir')->group(function () {
        Route::get('', [LegalisirController::class, 'index'])->name('legalisir');
    });
    Route::prefix('aktivasi')->group(function () {
        Route::get('', [AktivasiController::class, 'index'])->name('aktivasi-alumni');
        Route::put('/{id}', [AktivasiController::class, 'accOrReject'])->name('acc-reject');
    });
    Route::prefix('notifications')->group(function () {
        Route::get('', [NotificationsController::class, 'index'])->name('notifications');
        Route::post("", [NotificationsController::class, 'send'])->name('notifications-post');
    });
    Route::prefix('prodi')->group(function () {
        Route::get('', [ProdiController::class, 'index'])->name('prodi');
        Route::post('', [ProdiController::class, 'addProdi'])->name('prodi-post');
        Route::put('', [ProdiController::class, 'updateProdi'])->name('prodi-put');
        Route::delete('', [ProdiController::class, 'deleteProdi'])->name('prodi-delete');
    });

    Route::prefix('quisioner')->group(function () {
        Route::get('', [QuisionerController::class, 'index'])->name('quisioner-index');
        Route::get("/detail/{level}/{userId}", [QuisionerController::class, 'detailQuisioner'])->name('detail-quisioner');
        Route::post("export", [QuisionerController::class, "export"])->name('export');
        Route::post("import", [QuisionerController::class, 'import'])->name('import');
        Route::post("export-pdf", [QuisionerController::class, "exportPdf"])->name('export-pdf');
    });

});



Route::get('/info', function () {
    echo phpinfo();
});
