<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationRequest extends FormRequest
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
            'perguruan' => 'required|string',
            'jurusan' => 'required|string',
            'prodi' => 'required|string',
            'tahun_masuk' => 'required|numeric',
            'tahun_lulus' => 'required|numeric',
            'no_ijasah' => 'required',
            'strata' => 'required|in:D3,D4,S1,S2,S3' // Hanya menerima salah satu dari nilai ini
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
            'perguruan.required' => 'Perguruan tidak boleh kosong',
            "perguruan.string" => 'Perguruan harus berupa string',
            'jurusan.required' => 'Jurusan tidak boleh kosong',
            'jurusan.string' => 'Jurusan harus berupa string',
            'prodi.required' => 'Prodi tidak boleh kosong',
            'tahun_masuk.required' => 'Tahun masuk tidak boleh kosong',
            'tahun_masuk.numeric' => 'Tahun masuk harus berupa Numeric',
            'tahun_lulus.required' => 'Tahun lulus tidak boleh kosong',
            'tahun_lulus.numeric' => 'Tahun lulus harus berupa Numeric',
            "no_ijasah.required" => "No Ijasah tidak boleh kosong",
            'strata.in' => 'Harap pilih strata antara , D3 , D4 , S1 , S2 , S3'
        ];
    }
}