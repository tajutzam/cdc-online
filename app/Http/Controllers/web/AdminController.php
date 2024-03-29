<?php

namespace App\Http\Controllers\web;

use App\Exceptions\WebException;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\AdminService;
use App\Services\AuthService;
use App\Services\QuisionerService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{

    private AuthService $authService;
    private AdminService $adminService;

    private UserService $userService;

    private QuisionerService $quisionerService;


    public function __construct()
    {
        $this->authService = new AuthService();
        $this->adminService = new AdminService();
        $this->userService = new UserService();
    }

    //
    public function dashboard()
    {
        // ambil 5 tahun terakhir angkatan
        {
            $lastFiveYearsHaveWorker = $this->userService->findLastFiveYearsAlumniWhoHaveWorked();
            $categories = array_keys($lastFiveYearsHaveWorker);
            $values = array_values($lastFiveYearsHaveWorker);
            $users = $this->userService->findAll();

            foreach ($categories as $key => $value) {
                # code...
                $categories[$key] = "Angkatan " . $value;
            }

            $lastFive = [
                'values' => $lastFiveYearsHaveWorker,
                'categories' => $categories
            ];

            $sixLevel = [];
            $zeroLevel = [];
            $twelveLevel = [];

            foreach ($lastFive['values'] as $key => $value) {
                # code...
                array_push($zeroLevel, $value[0]);
                array_push($sixLevel, $value[6]);
                array_push($twelveLevel, $value[12]);
            }

            $lastFive = [
                'zero' => $zeroLevel,
                'six' => $sixLevel,
                'twelve' => $twelveLevel,
                'categories' => $categories
            ];

        } {
            $totalPerStudyProgam = $this->userService->countUsersPerStudyProgram();
        } {
            $enrollProgres = $this->userService->applicationEnrollmentProgress();
        } {
            $totalUsers = $this->userService->totalUsers();
        } {
            $topSalary = $this->userService->getTopUserBySalary();
        } {
            $topFollowers = $this->userService->getTopUser();
        }

        return view('admin.dashboard', [
            'users' => $users['alumni'],
            'lastFive' => $lastFive,
            'totalPerStudyProgram' => $totalPerStudyProgam,
            'enrollProgres' => $enrollProgres,
            'total' => $totalUsers,
            'topSalary' => $topSalary,
            'topFollowers' => $topFollowers
        ]);
    }

    public function settingsAdmin()
    {
        return view('admin.settings-admin');
    }

    public function login()
    {
        return view('admin.auth.login');
    }
    public function manageAdmin()
    {

        $adminId = Auth::guard('admin')->user()->id;
        $data = $this->adminService->findAllAdminWithoutAdminLogin($adminId);
        return view('admin.manage-admin', ['data' => $data]);
    }



    public function deleteAdmin(Request $request)
    {

        $response = $this->adminService->delete($request->input('id'));
        if ($response) {
            Alert::success('Sukses', 'Berhasil Menghapus Admin');
            return back();
        } else {
            throw new WebException('Ops , gagal menghapus admin , admin tidak ditemukan');
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|max:500',
            'email' => 'required|email|unique:admin,email',
            'npwp' => 'digits:16|required',
            'alamat' => 'required',
            'password' => 'required'
        ];

        $customMessages = [
            'required' => ':attribute Dibutuhkan.',
        ];

        $data = $this->validate($request, $rules, $customMessages);
        $response = $this->adminService->register($data);
        if ($response) {
            Alert::success('Sukses', 'Berhasil Mendaftarkan Admin Baru');
            return back();
        }
        return back()->withErrors('gagal menambahkan admin');
    }

    public function logout()
    {
        return $this->authService->logoutAdmin();
    }


    public function update(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required | email',
            'npwp' => 'required',
            'address' => 'required'
        ]);
        $id = auth('admin')->user()->id;

        $prodiAdmin = Admin::find($id);
        $prodiAdmins = Admin::where('email', '<>', $prodiAdmin->email)->get()->toArray();
        foreach ($prodiAdmins as $key => $value) {
            # code...
            if ($request->input('email') == $value['email']) {
                throw new WebException("Email Sudah Digunakan");
            }
        }
        $passwordUpdate = false;
        if ($request->input('password') != null) {
            $passwordUpdate = true;
        }
        if (!$passwordUpdate) {

            Admin::where('id', $id)->update(
                [
                    'name' => $request->input('name'),
                    'npwp' => $request->input('npwp'),
                    'alamat' => $request->input('address'),
                    'email' => $request->input('email')
                ]
            );
            Alert::success("Sukses", "Berhasil Memperbarui  Admin");
            return back();
        } else {
            $id = auth('admin')->user()->id;
            Admin::where('id', $id)->update(
                [
                    'name' => $request->input('name'),
                    'npwp' => $request->input('npwp'),
                    'alamat' => $request->input('address'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password'))
                ]
            );
            Alert::success("Sukses", "Berhasil Memperbarui   Admin Silahkan Login Ulang");
            auth('admin')->logout();
            return redirect('admin/login');
        }
    }


}
