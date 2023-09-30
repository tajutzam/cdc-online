<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'perusahaan' => 'required',
            'jabatan' => 'required',
            'gaji' => 'required|numeric',
            'jenis_pekerjaan' => 'required',
            'tahun_masuk' => 'required|numeric',
            'is_jobs_now' => 'required',
            'jobs_id' => 'required',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {

        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json([

            'status' => false,

            'message' => $validator->errors()->first(),

            'data' => null,
            'code' => 400

        ], 400));

    }

    public function messages()
    {
        return [
            'perusahaan.required' => 'Perusahaan tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'gaji.required' => 'Gaji tidak boleh kosong',
            "gaji.numeric" => "Gaji harus berupa numeric",
            'jenis_pekerjaan.required' => 'Jenis Pekerjaan Tidak boleh kosong',
            'tahun_masuk.required' => 'Tahun Masuk tidak boleh kosong',
            'tahun_masuk.numeric' => 'Tahun masuk harus berupa Numeric',
            'is_jobs_now.required' => 'Pekerjaan saat ini tidak boleh kosong',
            'jobs_id.required' => 'jobs id tidak boleh kosong' 
        ];

    }
}