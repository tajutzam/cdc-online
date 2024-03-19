<?php

use App\Http\Controllers\web\QuestionsController;
use App\Http\Middleware\PaymentFirst;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\InformationSubmissionController;
use App\Http\Controllers\LandingPageController;
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
use App\Http\Controllers\web\BankController;
use App\Http\Controllers\web\DataPayController;
use App\Http\Controllers\web\MitraSubmissiosController;
use App\Http\Controllers\web\ProvinceController;
use App\Http\Controllers\web\RegencyController;
use App\Http\Middleware\MitraMiddleware;
use App\Http\Middleware\VacancyFirst;
use App\Http\Controllers\PaketKuesionerController;
use App\Http\Controllers\PaketQuesionerDetailController;
use App\Models\PaketKuesioner;
use PhpParser\Node\Stmt\Echo_;
use Symfony\Component\HttpFoundation\Request;

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



Route::get('/company/login', function () {
    return view('company.auth.login');
})->name('login-company');

Route::post('/company/login', [MitraSubmissiosController::class, "login"])->name('login-company-post');

Route::get('/company/register', function () {
    return view('company.auth.register');
})->name('register');


Route::get('/admin/informasi', [InformationSubmissionController::class, 'index'])->name('verify-information');







Route::post("/company/register", [MitraSubmissiosController::class, "register"])->name('mitra-register');






Route::get('/', [LandingPageController::class, "index"])->name('/');
Route::post("/questions", [QuestionsController::class, "store"])->name('asking');
Route::get('/landing-page/blog', [NewsController::class, 'findAllBlog'])->name('blog');

Route::get('/landing-page/single-blog/{id}', [LandingPageController::class, 'findById'])->name('blog-single');

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
        Route::put('/settings-admin', [ProdiAdminController::class, 'update'])->name('settings-admin-prodi-put');

        Route::prefix('quesioner')->group(function () {
            route::get('', [ProdiQuesionerController::class, 'index'])->name('quesioner-index');
            Route::get("/detail/{level}/{userId}", [QuisionerController::class, 'detailQuisionerProdi'])->name('detail-quisioner-prodi');
            Route::post("export", [ProdiQuesionerController::class, "exportExcel"])->name("quesioner-export");
            Route::post("export-pdf", [ProdiQuesionerController::class, "exportPdf"])->name("quesioner-export-pdf");
            Route::post("import", [ProdiQuesionerController::class, "import"])->name("quesioner-import");
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
    Route::get('/settings-admin', [AdminController::class, 'settingsAdmin'])->name('settings-admin-put');
    Route::put('/settings-admin', [AdminController::class, 'update'])->name('settings-admin');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/grup-whatsapp', [GrupWhatsappController::class, 'grupWhatsapp'])->name('grup');
    Route::post('/grup-whatsapp', [GrupWhatsappController::class, 'store'])->name('grup-post');
    Route::delete('/grup-whatsapp', [GrupWhatsappController::class, 'delete'])->name('grup-delete');
    Route::put('/grup-whatsapp', [GrupWhatsappController::class, 'update'])->name('grup-put');

    Route::get('/feedback', [QuestionsController::class, 'index'])->name('feedback');
    Route::post('/answer/{id}', [QuestionsController::class, 'answer'])->name('answer');
    Route::delete('feedback', [QuestionsController::class, 'delete'])->name('feedback-delete');


    Route::get('/bank-account', [BankController::class, "adminBank"])->name('rekening');
    Route::post('/bank-account', [BankController::class, "store"])->name('rekening-post');
    Route::put('/bank-account', [BankController::class, "update"])->name('rekening-put');


    Route::get('/nominal', [DataPayController::class, "adminDataPay"])->name('nominalpay');
    Route::post('/nominal', [DataPayController::class, "store"])->name('pay-post');
    Route::put('/nominal', [DataPayController::class, "update"])->name('pay-put');
    Route::delete('/nominal/{id}', [DataPayController::class, "delete"])->name('pay-delete');
    // Route::get('/trix', 'TrixController@index');
    // Route::post('/upload', 'TrixController@upload');
    // Route::post('/store', 'TrixController@store');
    Route::prefix('vacancy')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('vacancy');
        Route::post('/store', [PostController::class, 'store'])->name('vacancy-store');
        Route::put('/{id}', [PostController::class, 'verifyOrReject'])->name('vacancy-verify');
        Route::put("/mitra/{id}", [PostController::class, "verifyOrRejectMitra"])->name('vacancy-mitra-verify');
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
        Route::get("/detail/{quesioner_answer_detail_id}", [QuisionerController::class, 'detailQuisioner'])->name('detail-quisioner');
        Route::post("export", [QuisionerController::class, "export"])->name('export');
        Route::post("import", [QuisionerController::class, 'import'])->name('import');
        Route::post("export-pdf", [QuisionerController::class, "exportPdf"])->name('export-pdf');
    });

    // Route::get('test-array', function () {
    //     $data = [
    //         "Kab. Kepulauan Seribu (010100)",
    //         "Kota Jakarta Pusat (016000)",
    //         "Kota Jakarta Utara (016100)",
    //         "Kota Jakarta Barat (016200)",
    //         "Kota Jakarta Selatan (016300)",
    //         "Kota Jakarta Timur (016400)",
    //         "Kab. Bogor (020500)",
    //         "Kab. Sukabumi (020600)",
    //         "Kab. Cianjur (020700)",
    //         "Kab. Bandung (020800)",
    //         "Kab. Sumedang (021000)",
    //         "Kab. Garut (021100)",
    //         "Kab. Tasikmalaya (021200)",
    //         "Kab. Ciamis (021400)",
    //         "Kab. Kuningan (021500)",
    //         "Kab. Majalengka (021600)",
    //         "Kab. Cirebon (021700)",
    //         "Kab. Indramayu (021800)",
    //         "Kab. Subang (021900)",
    //         "Kab. Purwakarta (022000)",
    //         "Kab. Karawang (022100)",
    //         "Kab. Bekasi (022200)",
    //         "Kab. Bandung Barat (022300)",
    //         "Kab. Pangandaran (022500)",
    //         "Kota Bandung (026000)",
    //         "Kota Bogor (026100)",
    //         "Kota Sukabumi (026200)",
    //         "Kota Cirebon (026300)",
    //         "Kota Bekasi (026500)",
    //         "Kota Depok (026600)",
    //         "Kota Cimahi (026700)",
    //         "Kota Tasikmalaya (026800)",
    //         "Kota Banjar (026900)",
    //         "Kab. Cilacap (030100)",
    //         "Kab. Banyumas (030200)",
    //         "Kab. Purbalingga (030300)",
    //         "Kab. Banjarnegara (030400)",
    //         "Kab. Kebumen (030500)",
    //         "Kab. Purworejo (030600)",
    //         "Kab. Wonosobo (030700)",
    //         "Kab. Magelang (030800)",
    //         "Kab. Boyolali (030900)",
    //         "Kab. Klaten (031000)",
    //         "Kab. Sukoharjo (031100)",
    //         "Kab. Wonogiri (031200)",
    //         "Kab. Karanganyar (031300)",
    //         "Kab. Sragen (031400)",
    //         "Kab. Grobogan (031500)",
    //         "Kab. Blora (031600)",
    //         "Kab. Rembang (031700)",
    //         "Kab. Pati (031800)",
    //         "Kab. Kudus (031900)",
    //         "Kab. Jepara (032000)",
    //         "Kab. Demak (032100)",
    //         "Kab. Semarang (032200)",
    //         "Kab. Temanggung (032300)",
    //         "Kab. Kendal (032400)",
    //         "Kab. Batang (032500)",
    //         "Kab. Pekalongan (032600)",
    //         "Kab. Pemalang (032700)",
    //         "Kab. Tegal (032800)",
    //         "Kab. Brebes (032900)",
    //         "Kota Magelang (036000)",
    //         "Kota Surakarta (036100)",
    //         "Kota Salatiga (036200)",
    //         "Kota Semarang (036300)",
    //         "Kota Pekalongan (036400)",
    //         "Kota Tegal (036500)",
    //         "Kab. Bantul (040100)",
    //         "Kab. Sleman (040200)",
    //         "Kab. Gunung Kidul (040300)",
    //         "Kab. Kulon Progo (040400)",
    //         "Kota Yogyakarta (046000)",
    //         "Kab. Gresik (050100)",
    //         "Kab. Sidoarjo (050200)",
    //         "Kab. Mojokerto (050300)",
    //         "Kab. Jombang (050400)",
    //         "Kab. Bojonegoro (050500)",
    //         "Kab. Tuban (050600)",
    //         "Kab. Lamongan (050700)",
    //         "Kab. Madiun (050800)",
    //         "Kab. Ngawi (050900)",
    //         "Kab. Magetan (051000)",
    //         "Kab. Ponorogo (051100)",
    //         "Kab. Pacitan (051200)",
    //         "Kab. Kediri (051300)",
    //         "Kab. Nganjuk (051400)",
    //         "Kab. Blitar (051500)",
    //         "Kab. Tulungagung (051600)",
    //         "Kab. Trenggalek (051700)",
    //         "Kab. Malang (051800)",
    //         "Kab. Pasuruan (051900)",
    //         "Kab. Probolinggo (052000)",
    //         "Kab. Lumajang (052100)",
    //         "Kab. Bondowoso (052200)",
    //         "Kab. Situbondo (052300)",
    //         "Kab. Jember (052400)",
    //         "Kab. Banyuwangi (052500)",
    //         "Kab. Pamekasan (052600)",
    //         "Kab. Sampang (052700)",
    //         "Kab. Sumenep (052800)",
    //         "Kab. Bangkalan (052900)",
    //         "Kota Surabaya (056000)",
    //         "Kota Malang (056100)",
    //         "Kota Madiun (056200)",
    //         "Kota Kediri (056300)",
    //         "Kota Mojokerto (056400)",
    //         "Kota Blitar (056500)",
    //         "Kota Pasuruan (056600)",
    //         "Kota Probolinggo (056700)",
    //         "Kota Batu (056800)",
    //         "Kab. Aceh Besar (060100)",
    //         "Kab. Pidie (060200)",
    //         "Kab. Aceh Utara (060300)",
    //         "Kab. Aceh Timur (060400)",
    //         "Kab. Aceh Tengah (060500)",
    //         "Kab. Aceh Barat (060600)",
    //         "Kab. Aceh Selatan (060700)",
    //         "Kab. Aceh Tenggara (060800)",
    //         "Kab. Simeulue (061100)",
    //         "Kab. Bireuen (061200)",
    //         "Kab. Aceh Singkil (061300)",
    //         "Kab. Aceh Tamiang (061400)",
    //         "Kab. Nagan Raya (061500)",
    //         "Kab. Aceh Jaya (061600)",
    //         "Kab. Aceh Barat Daya (061700)",
    //         "Kab. Gayo Lues (061800)",
    //         "Kab. Bener Meriah (061900)",
    //         "Kab. Pidie Jaya (062000)",
    //         "Kota Sabang (066000)",
    //         "Kota Banda Aceh (066100)",
    //         "Kota Lhokseumawe (066200)",
    //         "Kota Langsa (066300)",
    //         "Kab. Sabussalam (066400)",
    //         "Kab. Deli Serdang (070100)",
    //         "Kab. Langkat (070200)",
    //         "Kab. Karo (070300)",
    //         "Kab. Simalungun (070400)",
    //         "Kab. Dairi (070500)",
    //         "Kab. Asahan (070600)",
    //         "Kab. Labuhan Batu (070700)",
    //         "Kab. Tapanuli Utara (070800)",
    //         "Kab. Tapanuli Tengah (070900)",
    //         "Kab. Tapanuli Selatan (071000)",
    //         "Kab. Nias (071100)",
    //         "Kab. Mandailing Natal (071500)",
    //         "Kab. Toba Samosir (071600)",
    //         "Kab. Nias Selatan (071700)",
    //         "Kab. Pak pak Bharat (071800)",
    //         "Kab. Humbang Hasudutan (071900)",
    //         "Kab. Samosir (072000)",
    //         "Kab. Serdang Bedagai (072100)",
    //         "Kab. Batubara (072200)",
    //         "Kab. Padang Lawas utara (072300)",
    //         "Kab. Padang Lawas (072400)",
    //         "Kab. Labuhan Batu Utara (072500)",
    //         "Kab. Labuhan Batu Selatan (072600)",
    //         "Kab. Nias Barat (072700)",
    //         "Kab. Nias Utara (072800)",
    //         "Kota Medan (076000)",
    //         "Kota Binjai (076100)",
    //         "Kota Tebing Tinggi (076200)",
    //         "Kota Pematang Siantar (076300)",
    //         "Kota Tanjung Balai (076400)",
    //         "Kota Sibolga (076500)",
    //         "Kota Padang Sidempuan (076600)",
    //         "Kota Gunung Sitoli (076700)",
    //         "Kab. Agam (080100)",
    //         "Kab. Pasaman (080200)",
    //         "Kab. Lima Puluh Koto (080300)",
    //         "Kab. Solok (080400)",
    //         "Kab. Padang Pariaman (080500)",
    //         "Kab. Pesisir Selatan (080600)",
    //         "Kab. Tanah Datar (080700)",
    //         "Kab. Sawahlunto/ Sijunjung (080800)",
    //         "Kab. Kepulauan Mentawai (081000)",
    //         "Kab. Solok Selatan (081100)",
    //         "Kab. Dharmas Raya (081200)",
    //         "Kab. Pasaman Barat (081300)",
    //         "Kota Bukittinggi (086000)",
    //         "Kota Padang (086100)",
    //         "Kota Padang Panjang (086200)",
    //         "Kota Sawah Lunto (086300)",
    //         "Kota Solok (086400)",
    //         "Kota Payakumbuh (086500)",
    //         "Kota Pariaman (086600)",
    //         "Kab. Kampar (090100)",
    //         "Kab. Bengkalis (090200)",
    //         "Kab. Indragiri Hulu (090400)",
    //         "Kab. Indragiri Hilir (090500)",
    //         "Kab. Pelalawan (090800)",
    //         "Kab. Rokan Hilir (090900)",
    //         "Kab. Siak (091000)",
    //         "Kab. Kuantan Singingi (091100)",
    //         "Kab. Rokan Hulu (091400)",
    //         "Kab. Kepulauan Meranti (091500)",
    //         "Kota Pekanbaru (096000)",
    //         "Kota Dumai (096200)",
    //         "Kab. Batang Hari (100100)",
    //         "Kab. Bungo (100200)",
    //         "Kab. Sarolangun (100300)",
    //         "Kab. Tanjung Jabung Barat (100400)",
    //         "Kab. Kerinci (100500)",
    //         "Kab. Tebo (100600)",
    //         "Kab. Muaro Jambi (100700)",
    //         "Kab. Tanjung Jabung Timur (100800)",
    //         "Kab. Merangin (100900)",
    //         "Kota Jambi (106000)",
    //         "Kab. Sungai Penuh (106100)",
    //         "Kab. Musi Banyu Asin (110100)",
    //         "Kab. Ogan Komering Ilir (110200)",
    //         "Kab. Ogan Komering Ulu (110300)",
    //         "Kab. Muara Enim (110400)",
    //         "Kab. Lahat (110500)",
    //         "Kab. Musi Rawas (110600)",
    //         "Kab. Banyuasin (110700)",
    //         "Kab. Ogan Komering Ulu Timur (110800)",
    //         "Kab. Ogan Komering Ulu Selatan (110900)",
    //         "Kab. Ogan Ilir (111000)",
    //         "Kab. Empat Lawang (111100)",
    //         "Kab. Penukal Abab Lematang Ilir (111200)",
    //         "Kab. Musi Rawas Utara (111300)",
    //         "Kota Palembang (116000)",
    //         "Kota Prabumulih (116100)",
    //         "Kota Lubuk Linggau (116200)",
    //         "Kota Pagar Alam (116300)",
    //         "Kab. Lampung Selatan (120100)",
    //         "Kab. Lampung Tengah (120200)",
    //         "Kab. Lampung Utara (120300)",
    //         "Kab. Lampung Barat (120400)",
    //         "Kab. Tulang Bawang (120500)",
    //         "Kab. Tenggamus (120600)",
    //         "Kab. Lampung Timur (120700)",
    //         "Kab. Way Kanan (120800)",
    //         "Kab. Pasawaran (120900)",
    //         "Kab. Tulang Bawang Barat (121000)",
    //         "Kab. Mesuji (121100)",
    //         "Kab. Pringsewu (121200)",
    //         "Kab. Pesisir Barat (121300)",
    //         "Kota Bandar Lampung (126000)",
    //         "Kota Metro (126100)",
    //         "Kab. Sambas (130100)",
    //         "Kab. Pontianak (130200)",
    //         "Kab. Sanggau (130300)",
    //         "Kab. Sintang (130400)",
    //         "Kab. Kapuas Hulu (130500)",
    //         "Kab. Ketapang (130600)",
    //         "Kab. Bengkayang (130800)",
    //         "Kab. Landak (130900)",
    //         "Kab. Sekadau (131000)",
    //         "Kab. Melawi (131100)",
    //         "Kab. Kayong Utara (131200)",
    //         "Kab. Kuburaya (131300)",
    //         "Kota Pontianak (136000)",
    //         "Kota Singkawang (136100)",
    //         "Kab. Kapuas (140100)",
    //         "Kab. Barito Selatan (140200)",
    //         "Kab. Barito Utara (140300)",
    //         "Kab. Kotawaringin Timur (140400)",
    //         "Kab. Kotawaringin Barat (140500)",
    //         "Kab. Katingan (140600)",
    //         "Kab. Seruyan (140700)",
    //         "Kab. Sukamara (140800)",
    //         "Kab. Lamandau (140900)",
    //         "Kab. Gunung Mas (141000)",
    //         "Kab. Pulang Pisau (141100)",
    //         "Kab. Murung Raya (141200)",
    //         "Kab. Barito Timur (141300)",
    //         "Kota Palangka Raya (146000)",
    //         "Kab. Banjar (150100)",
    //         "Kab. Tanah Laut (150200)",
    //         "Kab. BaritoKuala (150300)",
    //         "Kab. Tapin (150400)",
    //         "Kab. Hulu Sungai Selatan (150500)",
    //         "Kab. Hulu Sungai Tengah (150600)",
    //         "Kab. Hulu Sungai Utara (150700)",
    //         "Kab. Tabalong (150800)",
    //         "Kab. Kota Baru (150900)",
    //         "Kab. Balangan (151000)",
    //         "Kab. Tanah Bumbu (151100)",
    //         "Kota Banjarmasin (156000)",
    //         "Kota Banjarbaru (156100)",
    //         "Kab. Pasir (160100)",
    //         "Kab. Kutai Kartanegara (160200)",
    //         "Kab. Berau (160300)",
    //         "Kab. Bulongan (160400)",
    //         "Kab. Malinau (160700)",
    //         "Kab. Nunukan (160800)",
    //         "Kab. Kutai Barat (160900)",
    //         "Kab. Kutai Timur (161000)",
    //         "Kab. Penajam Paser Utara (161100)",
    //         "Kab. Mahakam Ulu (161200)",
    //         "Kab. Tanah Tidung (165400)",
    //         "Kota Samarinda (166000)",
    //         "Kota Balikpapan (166100)",
    //         "Kota Tarakan (166200)",
    //         "Kota Bontang (166300)",
    //         "Kab. Bolaang Mongondaw (170100)",
    //         "Kab. Minahasa (170200)",
    //         "Kab. Kep. Sangihe (170300)",
    //         "Kab. Kepulauan Talaud (170400)",
    //         "Kab. Minahasa Selatan (170500)",
    //         "Kab. Minahasa Utara (170600)",
    //         "Kab. Bolaang Mongondow Utara (170800)",
    //         "Kab. Kepulauan Sitaro (170900)",
    //         "Kab. Minahasa Tenggara (171000)",
    //         "Kab. Bolaang Mongondow Timur (171100)",
    //         "Kab. Bolaang Mongondow Selatan (171200)",
    //         "Kota Manado (176000)",
    //         "Kota Bitung (176100)",
    //         "Kota Tomohon (176200)",
    //         "Kota. Kotamobagu (176300)",
    //         "Kab. Banggai Kepulauan (180100)",
    //         "Kab. Donggala (180200)",
    //         "Kab. Parigi Mautong (180300)",
    //         "Kab. Banggai (180400)",
    //         "Kab. Buol (180500)",
    //         "Kab. Toli-Toli (180600)",
    //         "Kab. Marowali (180700)",
    //         "Kab. Poso (180800)",
    //         "Kab. Tojo Una-Una (180900)",
    //         "Kab. Sigi (181000)",
    //         "Kab. Banggai Laut (181100)",
    //         "Kab. Morowali Utara (181200)",
    //         "Kota Palu (186000)",
    //         "Kab. Maros (190100)",
    //         "Kab. Pangkajene Kepulauan (190200)",
    //         "Kab. Gowa (190300)",
    //         "Kab. Takalar (190400)",
    //         "Kab. Jeneponto (190500)",
    //         "Kab. Barru (190600)",
    //         "Kab. Bone (190700)",
    //         "Kab. Wajo (190800)",
    //         "Kab. Soppeng (190900)",
    //         "Kab. Bantaeng (191000)",
    //         "Kab. Bulukumba (191100)",
    //         "Kab. Sinjai (191200)",
    //         "Kab. Selayar (191300)",
    //         "Kab. Pinrang (191400)",
    //         "Kab. Sidenreng Rappang (191500)",
    //         "Kab. Enrekang (191600)",
    //         "Kab. Luwu (191700)",
    //         "Kab. Tana Toraja (191800)",
    //         "Kab. Luwu Utara (192400)",
    //         "Kab. Luwu Timur (192600)",
    //         "Kab. Toraja Utara (192700)",
    //         "Kota Makassar (196000)",
    //         "Kota Pare-Pare (196100)",
    //         "Kota Palopo (196200)",
    //         "Kab. Konawe (200100)",
    //         "Kab. Muna (200200)",
    //         "Kab. Buton (200300)",
    //         "Kab. Kolaka (200400)",
    //         "Kab. Konawe Selatan (200500)",
    //         "Kab. Wakatobi (200600)",
    //         "Kab. Bombana (200700)",
    //         "Kab. Kolaka Utara (200800)",
    //         "Kab. Konawe Utara (200900)",
    //         "Kab. Buton Utara (201000)",
    //         "Kab. Kolaka Timur (201100)",
    //         "Kab. Konawe Kepulauan (201200)",
    //         "Kab. Muna Barat (201300)",
    //         "Kab. Buton Selatan (201400)",
    //         "Kab. Buton Tengah (201600)",
    //         "Kota Kupang (206000)",
    //         "Kab. Maluku Tengah (210100)",
    //         "Kab. Maluku Tenggara (210200)",
    //         "Kab. Buru (210300)",
    //         "Kab. Maluku Tenggara Barat (210400)",
    //         "Kab. Seram Bagian Barat (210500)",
    //         "Kab. Seram Bagian Timur (210600)",
    //         "Kab. Kepulauan Aru (210700)",
    //         "Kab. Maluku Barat Daya (210800)",
    //         "Kab. Buru Selatan (210900)",
    //         "Kota Ambon (216000)",
    //         "Kota. Tual (216100)",
    //         "Kab. Buleleng (220100)",
    //         "Kab. Jembrana (220200)",
    //         "Kab. Tabanan (220300)",
    //         "Kab. Badung (220400)",
    //         "Kab. Gianyar (220500)",
    //         "Kab. Klungkung (220600)",
    //         "Kab. Bangli (220700)",
    //         "Kab. Karang Asem (220800)",
    //         "Kota Denpasar (226000)",
    //         "Kab. Lombok Barat (230100)",
    //         "Kab. Lombok Tengah (230200)",
    //         "Kab. Lombok Timur (230300)",
    //         "Kab. Sumbawa (230400)",
    //         "Kab. Dompu (230500)",
    //         "Kab. Bima (230600)",
    //         "Kab. Sumbawa Barat (230700)",
    //         "Kab. Lombok Utara (230800)",
    //         "Kota Mataram (236000)",
    //         "Kota Bima (236100)",
    //         "Kab. Kupang (240100)",
    //         "Kab. Timor Tengah Selatan (240300)",
    //         "Kab. Timor Tengah Utara (240400)",
    //         "Kab. Belu (240500)",
    //         "Kab. Alor (240600)",
    //         "Kab. Flores Timur (240700)",
    //         "Kab. Sikka (240800)",
    //         "Kab. Ende (240900)",
    //         "Kab. Ngada (241000)",
    //         "Kab. Manggarai (241100)",
    //         "Kab. Sumba Timur (241200)",
    //         "Kab. Sumba Barat (241300)",
    //         "Kab. Lembata (241400)",
    //         "Kab. Rote-Ndao (241500)",
    //         "Kab. Manggarai Barat (241600)",
    //         "Kab. Nagakeo (241700)",
    //         "Kab. Sumba Tengah (241800)",
    //         "Kab. Sumba Barat Daya (241900)",
    //         "Kab. Manggarai Timur (242000)",
    //         "Kab. Sabu Raijua (242100)",
    //         "Kab. Malaka (242200)",
    //         "Kota Kupang (246000)",
    //         "Kab. Jayapura (250100)",
    //         "Kab. Biak Numfor (250200)",
    //         "Kab. Yapen Waropen (250300)",
    //         "Kab. Merauke (250700)",
    //         "Kab. Jayawijaya (250800)",
    //         "Kab. Nabire (250900)",
    //         "Kab. Paniai (251000)",
    //         "Kab. Puncak Jaya (251100)",
    //         "Kab. Mimika (251200)",
    //         "Kab. Boven Digoel (251300)",
    //         "Kab. Mappi (251400)",
    //         "Kab. Asmat (251500)",
    //         "Kab. Yahukimo (251600)",
    //         "Kab. Pegunungan Bintang (251700)",
    //         "Kab. Tolikara (251800)",
    //         "Kab. Sarmi (251900)",
    //         "Kab. Keerom (252000)",
    //         "Kab. Waropen (252600)",
    //         "Kab. Supiori (252700)",
    //         "Kab. Memberamo Raya (252800)",
    //         "Kab. Nduga (252900)",
    //         "Kab. Lanny Jaya (253000)",
    //         "Kab. Membramo Tengah (253100)",
    //         "Kab. Yalimo (253200)",
    //         "kab. Puncak (253300)",
    //         "Kab. Dogiyai (253400)",
    //         "Kab. Deiyai (253500)",
    //         "Kab. Intan Jaya (253600)",
    //         "Kota Jayapura (256000)",
    //         "Kab. Bengkulu Utara (260100)",
    //         "Kab. Rejang Lebong (260200)",
    //         "Kab. Bengkulu Selatan (260300)",
    //         "Kab. Muko-muko (260400)",
    //         "Kab. Kepahiang (260500)",
    //         "Kab. Lebong (260600)",
    //         "Kab. Kaur (260700)",
    //         "Kab. Seluma (260800)",
    //         "Kab. Bengkulu Tengah (260900)",
    //         "Kota Bengkulu (266000)",
    //         "Kab. Pulau Taliabu (270100)",
    //         "Kab. Halmahera Tengah (270200)",
    //         "Kab. Halmahera Barat (270300)",
    //         "Kab. halmahera Utara (270400)",
    //         "Kab. Halmahera Selatan (270500)",
    //         "Kab. Halmahera Timur (270600)",
    //         "Kab. Kepulauan Sula (270700)",
    //         "Kab. Kepulauan Morotai (270800)",
    //         "Kota Ternate (276000)",
    //         "Kota Tidore Kepulauan (276100)",
    //         "Kab. Boalemo (300100)",
    //         "Kab. Gorontalo (300200)",
    //         "Kab. Pohuwato (300300)",
    //         "Kab. Bone Bolango (300400)",
    //         "Kab. Gorontalo Utara (300500)",
    //         "Kota Gorontalo (306000)",
    //         "Kab. Bintan (310100)",
    //         "Kab. Karimun (310200)",
    //         "Kab. Natuna (310300)",
    //         "Kab. Lingga (310400)",
    //         "Kab. Kepulauan Anambas (310500)",
    //         "Kota Batam (316000)",
    //         "Kota Tanjungpinang (316100)",
    //         "Kab. Fak-Fak (320100)",
    //         "Kab. Kaimana (320200)",
    //         "Kab. Teluk Wondama (320300)",
    //         "Kab. Teluk Bintuni (320400)",
    //         "Kab. Manokwari (320500)",
    //         "Kab. Sorong Selatan (320600)",
    //         "Kab. Sorong (320700)",
    //         "Kab.Raja Ampat (320800)",
    //         "Kab. Tambrauw (320900)",
    //         "Kab. Maybrat (321000)",
    //         "Kab. Pegunungan Arfak (321100)",
    //         "Kab. Manokwari Selatan (321200)",
    //         "Kota Sorong (326000)",
    //         "Kab. Mamuju (330100)",
    //         "Kab. Mamuju Utara (330200)",
    //         "Kab. Polewali Mamasa (330300)",
    //         "Kab. Mamasa (330400)",
    //         "Kab. Majene (330500)",
    //         "Kab. Mamuju Tengah (330600)",
    //         "Kab. Malinau (340100)",
    //         "Kab. Bulungan (340200)",
    //         "Kab. Tana Tidung (340300)",
    //         "Kab. Nunukan (340500)",
    //         "Kota Tarakan (346000)",
    //         "Luar Negeri (999999)"
    //     ];

    //     $kabupaten = [];
    //     $index = 0;
    //     foreach ($data as $d) {
    //         $parts = explode("(", $d); // Pecah string berdasarkan "("

    //         if (count($parts) == 2) {
    //             $code = trim($parts[1], ")"); // Menghapus tanda ")" dari kode
    //             $name = trim($parts[0]); // Membersihkan nama dari spasi ekstra

    //             // Mengatur ulang format sesuai kebutuhan
    //             $formatted = $code . " - " . $name;

    //             $kabupaten[$index]  = $formatted; // Output: "010100 - Kab. Kepulauan Seribu"
    //             $index++;
    //         } else {
    //             echo "Format tidak sesuai";
    //         }
    //     }
    //     return $kabupaten;
    // });


    Route::get('/provinsi', [ProvinceController::class, "index"])->name('provinsi');

    Route::post('provinsi', [ProvinceController::class, 'import'])->name('province-import');
    Route::post('regency', [RegencyController::class, 'import'])->name('regency-import');
    Route::get('kabupaten', [RegencyController::class, 'index'])->name('kabupaten');



    Route::get('/verify/company', [MitraSubmissiosController::class, "index"])->name('aktivasi-company');
    Route::post('/verify/company/accpet', [MitraSubmissiosController::class, "accept"])->name('company-accept');
    Route::post('/verify/company/reject', [MitraSubmissiosController::class, "reject"])->name('company-reject');

    Route::post('verify/company/information', [InformationSubmissionController::class, 'accept'])->name('information-accept');
    Route::post('verify/company/information/reject', [InformationSubmissionController::class, 'reject'])->name('information-reject');



    Route::get('/data/company', [MitraSubmissiosController::class, "mitra"])->name('company-data');


    Route::get('/mitra', [PostController::class, "verivyMitraVacancy"])->name('vacancy-mitra');
    Route::get('/riwayat/informasi', [InformationSubmissionController::class, 'information'])->name('history-information');



    // PAKET KUESIONER

    Route::get('/paket_kuesioner', [PaketKuesionerController::class, 'index'])->name('paket_kuesioner.index');
    Route::get('/paket_kuesioner/create', [PaketKuesionerController::class, 'create'])->name('paket_kuesioner.create');
    Route::post('/paket_kuesioner', [PaketKuesionerController::class, 'store'])->name('paket_kuesioner.store');
    Route::get('/paket_kuesioner/{id}/edit', [PaketKuesionerController::class, 'edit'])->name('paket_kuesioner.edit');
    Route::put('/paket_kuesioner/{id}', [PaketKuesionerController::class, 'update'])->name('paket_kuesioner.update');
    Route::delete('/paket_kuesioner/{id}', [PaketKuesionerController::class, 'destroy'])->name('paket_kuesioner.destroy');
    Route::get('/paket_kuesioner/{id}', [PaketKuesionerController::class, 'detailKuesioner'])->name('paket_kuesioner.view');
    Route::get('/paket_kuesioner/changeStatus/{id_paket_kuesioner}/{status}', [PaketKuesionerController::class, 'changeStatus'])->name('paket_kuesioner.changeStatus');
    Route::get('/paket_kuesioner/duplicateData/{id_paket_kuesioner}', [PaketKuesionerController::class, 'duplicateData'])->name('paket_kuesioner.duplicateData');


    // PAKET KUESIONER DETAIL
    Route::get('paket_kuesioner_detail/{id}', [PaketQuesionerDetailController::class, 'index'])->name('paket_kuesioner_detail.index');
    Route::get('paket_kuesioner_detail/{id}/test_form', [PaketQuesionerDetailController::class, 'show'])->name('test_form');
    Route::post('paket_kuesioner_detail/update-index', [PaketQuesionerDetailController::class, 'update_index'])->name('paket_kuesioner_detail.update_index');

    Route::post('paket_kuesioner_detail/create', [PaketQuesionerDetailController::class, 'create']);

    Route::resource('paket_kuesioner_detail', PaketQuesionerDetailController::class)->names('paket_kuesioner_detail');
});


Route::prefix("company")->middleware(MitraMiddleware::class)->group(function () {
    Route::get("apply", [MitraSubmissiosController::class, "apply"])->name('vacancy-company-apply');
    Route::get("history", [MitraSubmissiosController::class, "history"])->name('vacancy-company-history');
    Route::post("apply", [MitraSubmissiosController::class, "applyToNext"])->name('apply-post');


    Route::get('/apply/next', [MitraSubmissiosController::class, "next"])->name('vacancy-next')->middleware(PaymentFirst::class);
    Route::post("/apply/next", [MitraSubmissiosController::class, "nextPerfom"])->name('vacancy-next-post');


    Route::get('/resetpassword', function () {
        return view('company.auth.reset-password');
    })->name('reset-company');

    Route::post('/resetpassword', [MitraSubmissiosController::class, "updatePassword"])->name('mitra-reset-password');

    Route::get('/apply/end', [MitraSubmissiosController::class, "end"])->name('vacancy-end')->middleware(VacancyFirst::class);
    Route::post('/apply/end', [MitraSubmissiosController::class, "endPerfom"])->name('vacancy-end-post')->middleware(VacancyFirst::class);
    Route::post("/apply/information/end", [MitraSubmissiosController::class, 'endInformationPerform'])->name('end-information');

    Route::post("/apply/information", [InformationSubmissionController::class, 'store'])->name('information-submissions-post');
    Route::post("/apply/next/information", [MitraSubmissiosController::class, 'nextPerfomInformation'])->name('information-next-perform');

    Route::get('settings', function () {
        return view('company.settings');
    })->name('company-settings');

    Route::put('settings', [MitraSubmissiosController::class, "updateAccount"])->name('mitra-put');
    Route::post('logout', [MitraSubmissiosController::class, "logout"])->name('mitra-logout');

    Route::get('/riwayat/informasi', [MitraSubmissiosController::class, "historyInformation"])->name('information-company-history');
});


Route::post("resend", [WebAuthController::class, "resendEmail"])->name('resend');
Route::get("resend", [WebAuthController::class, "resendView"])->name('success-resend');
Route::get('privacy-policy', function () {
    return view('privacy-policy');
});

Route::get('/info', function () {
    echo phpinfo();
});
