<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProdiController extends Controller
{


    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    //
    public function dashboard()
    {
        $prodiId = Auth::guard('prodi')->user()->prodi_id;
        $lastFive = $this->userService->findLastFiveYearsAlumniWhoHaveWorkedByStudyProgram($prodiId);
        $categories = array_keys($lastFive);
        $values = array_values($lastFive);


        foreach ($categories as $key => $value) {
            # code...
            $categories[$key] = "Angkatan " . $value;
        }

        $lastFive = [
            'values' => $lastFive,
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

        return view('prodi.dashboard', ['lastFive' => $lastFive]);
    }

    public function settingsAdmin()
    {
        return view('prodi.settings-admin');
    }




}
