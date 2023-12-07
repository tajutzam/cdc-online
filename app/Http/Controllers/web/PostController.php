<?php


namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{


    private PostService $postService;


    public function __construct()
    {
        $this->postService = new PostService();
    }


    public function index()
    {

        $data = $this->postService->findVerivyVacancy();

        // Extract the counts and dates from the $countsByDay array
        $dates = array_keys($data['count_by_day']);
        $counts_by_day = array_values($data['count_by_day']);

        return view('admin.vacancy.verify-vacancy', [
            'data' => $data['vacancy'],
            'total_of_week' => $data['total_of_week'],
            'count_by_day' => $counts_by_day,
            'total' => sizeOf($data['vacancy'])
        ]);
    }

    public function verivyMitraVacancy(){
        $data = $this->postService->findVerifyVacancyMitra();
        // dd($data);

       
        // Extract the counts and dates from the $countsByDay array
        $dates = array_keys($data['count_by_day']);
        $counts_by_day = array_values($data['count_by_day']);

    

        return view('admin.vacancy.mitra-vacancy', [
            'data' => $data['vacancy'],
            'total_of_week' => $data['total_of_week'],
            'count_by_day' => $counts_by_day,
            'total' => sizeOf($data['vacancy'])
        ]);
    }

    public function history()
    {
        $data = $this->postService->findHistoryVacancy();
        return view('admin.vacancy.history-vacancy', ['data' => $data]);
    }
    public function store(Request $request)
    {
        $rules = [
            'description' => 'required',
            'position' => 'required|max:250',
            'company' => 'required|max:250',
            'link_apply' => 'required|url',
            'expired' => 'required',
            'image' => 'required|max:1024',
            'type_jobs' => 'required|in:Purnawaktu,Paruh Waktu,Wiraswasta,Pekerja Lepas,Kontrak,Musiman'
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];


        $data = $this->validate($request, $rules, $customMessages);
        $isCanComment = false;
        if (isset($data['can_comment'])) {
            $isCanComment = true;
        }

        $adminId = $this->checkLogin();
        $data = $this->postService->addPostJobAdmin($request->file('image'), $adminId, $request->all(), $isCanComment);
        if ($data['status']) {
            Alert::success('Sukses', $data['message']);
            return back();
        }
        return back()->withErrors($data['message']);
    }


    private function checkLogin()
    {
        if (Auth::guard('admin')->check()) {
            return Auth::guard('admin')->user()->id;
        }
        return redirect('admin/login')->withErrors('Ops sesi Anda sudah habis');
    }


    public function verifyOrReject(Request $request, $id)
    {
        $data = [
            'verified' => $request->input('verified'),
            'id' => $id
        ];
        $response = $this->postService->updateVerified($data);
        Alert::success('Success', 'Berhasil Memperbarui');
        return back();
    }


    private function getDataFromJson($data): array
    {
        return $data->getData(true)['data'];
    }
}
