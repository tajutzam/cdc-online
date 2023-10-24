<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Helper\ResponseHelper;
use App\Services\AlumniService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    //

    private AlumniService $alumniService;

    public function __construct()
    {
        $this->alumniService = new AlumniService();
    }

    public function verifikasiAlumni(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required'
        ]);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->first());
        }
        $response = $this->alumniService->verifikasiNimOrEmail($request->all());
        return ResponseHelper::successResponse($response['message'], $response['data'], $response['code']);
    }

}
