<?php

namespace App\Http\Controllers\web;

use App\Exceptions\WebException;
use App\Http\Controllers\Controller;
use App\Http\Middleware\PaymentFirst;
use App\Models\Bank;
use App\Models\Post;
use App\Services\MitraService;
use App\Services\PostService;
use App\Services\DataPayService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MitraSubmissiosController extends Controller
{
    //

    private MitraService $service;
    private PostService $postService;

    public function __construct()
    {
        $this->service = new MitraService();
        $this->postService = new PostService();
    }

    public function index()
    {
        $data = $this->service->findAll();
        return view('admin.aktivasi.company', ['data' => $data]);
    }

    public function mitra()
    {
        $data = $this->service->findAllMitra();
        return view('admin.company-data', ['data' => $data]);
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nib' => 'required|unique:mitra_submissions,nib',
            'business_license' => 'required|max:2048', // 'max' is in kilobytes, so 2048 KB is 2MB
            'logo' => 'required|max:2048', // 'max' is in kilobytes, so 1024 KB is 1MB
            'address' => 'required',
            'email' => 'required|email|unique:mitra_submissions,email|unique:mitra,email',
            'password' => 'required',
            'phone' => 'required'
        ], [
            'required' => ':attribute Tidak Boleh Kosong',
            'mimes' => 'Business License harus berupa file PDF',
            'max' => [
                'file' => 'Ukuran file :attribute tidak boleh lebih dari :max kilobytes.',
                'string' => 'Panjang karakter :attribute tidak boleh lebih dari :max.',
            ],
        ]);
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        $this->service->register($data, $request->file('business_license'), $request->file('logo'));
        Alert::success("Sukses", "Berhasil Registrasi Silahkan Menunggu kami memvalidasi data anda");
        return back();
    }


    public function accept(Request $request)
    {
        // dd($request->all());
        $data = json_decode($request->input('data'));

        $this->service->accept($data);

        Alert::success("Sukses", "Berhasil Menerima Mitra");
        return back();
    }

    public function reject(Request $request)
    {
        $data = json_decode($request->input('data'));

        $this->service->rejected($data);

        Alert::success("Sukses", "Berhasil Menolak Mitra");
        return back();
    }

    public function login(Request $request)
    {
        $isLogin = auth('mitra')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
        if ($isLogin) {
            return redirect("/company/apply");
        }
        throw new WebException("Silahkan Cek Email Atau Password Anda");
    }

    public function apply()
    {
        $banks = Bank::all();
        // $pays = Pays::all();
        return view('company.vacancy.apply-vacancy', ['banks' => $banks]);
    }

    public function history()
    {
        $mitraId = auth('mitra')->user()->id;
        $posts = Post::where('mitra_id', $mitraId)->get();
        return view('company.vacancy.company-history', ['posts' => $posts]);
    }

    public function updateAccount(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nib' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ], [
            'required' => ':attribute Tidak Boleh Kosong',
            'mimes' => 'Business License harus berupa file PDF',
            'max' => [
                'file' => 'Ukuran file :attribute tidak boleh lebih dari :max kilobytes.',
                'string' => 'Panjang karakter :attribute tidak boleh lebih dari :max.',
            ],
        ]);
        $this->service->updateAccount($request->all(), $request->file('logo'), $request->file('business_license'), auth('mitra')->user()->id);
        Alert::success("Sukses", "Berhasil memperbarui data");
        return back();
    }

    public function updatePassword(Request $request)
    {
        $this->service->updatePassword(auth('mitra')->user()->id, $request->input('password'));
        Alert::success("Sukses", "Berhasil memperbarui password silahkan login ulang");
        auth('mitra')->logout();
        return redirect("/company/login");
    }

    public function logout()
    {
        auth('mitra')->logout();
        return redirect("");
    }

    public function applyToNext(Request $request)
    {
        $this->validate($request, [
            'bukti' => 'required|max:2048',

        ]);
        // Handle file upload
        if ($request->hasFile('bukti')) {
            $image = $request->file('bukti');
            $fileName = time() . "." . $image->getClientOriginalExtension();
            $folder = "mitra/bukti/temp";
            $filePath = $image->move($folder, $fileName); // Store the file in the 'uploads' directory
        } else {
            // Handle the case when no file is uploaded
            $fileName = null;
        }

        $request->session()->put('bukti_path', $fileName);
        $request->session()->put('bank', $request->input('bank'));

        // dd($data);
        // Redirect to the next page with the data
        return redirect('/company/apply/next');
    }


    public function next()
    {
        // $this->middleware(PaymentFirst::class );
        $bukti = session('bukti_path');
        $bank = session('bank');

        return view('company.vacancy.apply-vacancy-next', ['bukti' => $bukti, 'bank' => $bank]);
    }


    public function nextPerfom(Request $request)
    {

        $this->validate($request, [
            'poster' => 'required',
            'description' => 'required',
            'expired_at' => 'required',
            'upload_at' => 'required',
            'link' => 'required|url',
            'position' => 'required'
        ]);
        if ($request->hasFile('poster')) {
            $image = $request->file('poster');
            $fileName = time() . "." . $image->getClientOriginalExtension();
            $folder = "mitra/vacancy-temp";
            $image->move($folder, $fileName); // Store the file in the 'uploads' directory
        } else {
            // Handle the case when no file is uploaded
            $fileName = null;
        }
        $requestData = $request->all();
        $requestData['poster'] = $fileName;
        $request->session()->put('data', $requestData);
        return redirect('company/apply/end');
    }

    public function end()
    {
        $data = session('data');
        // session()->forget('data');
        return view('company.vacancy.apply-vacancy-end', ['data' => $data]);
    }

    public function endPerfom(Request $request)
    {
        $this->validate($request, [
            'bukti' => 'required',
            'poster' => 'required',
            'description' => 'required',
            'expired' => 'required',
            'upload_at' => 'required',
            'link_apply' => 'required|url',
            'position' => 'required'
        ]);
        $image = $request->file('poster');
        $bukti = $request->file('bukti');
        $data = $request->all();
        $data['company'] = auth('mitra')->user()->name;
        // dd($image);
        // dd($data);
        $oldData = session('data');
        if (file_exists(public_path('mitra/bukti/temp/' . $oldData['bukti_path']))) {
            unlink(public_path('mitra/bukti/temp/' . $oldData['bukti_path']));
        } else {
        }

        if (file_exists(public_path('mitra/vacancy-temp/' . $oldData['poster']))) {
            unlink(public_path('mitra/vacancy-temp/' . $oldData['poster']));
        } else {
        }
        $fileNameBukti = time() . "." . $bukti->getClientOriginalExtension();
        $bukti->move('bukti/', $fileNameBukti);
        $data['bukti'] = $fileNameBukti;

        $response = $this->postService->addPostJobMitra($image, auth('mitra')->user()->id, $data);
        if ($response['status']) {
            session()->forget('data');
            Alert::success("Sukses", "Berhasil Menambahkan Lowongan silahkan tunggu lowongan anda di setujui");
            return redirect("/company/history");
        } else {
            Alert::error("Terjadi kesalahan", "Gagal menambahkan lowongan terjadi kesalahan");
            return redirect("/company/history");
        }
    }
}
