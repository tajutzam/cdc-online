<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            "fullname" => 'required',
            'nik' => 'required|unique:users,nik',
            'no_telp' => 'required|max:15',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'required',
            'nim' => 'required|string|unique:users,nim',
            'kode_prodi' => 'required|numeric'
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
            'fullname.required' => 'Nama lengkap tidak boleh kosong',
            'nik.required' => 'Nik tidak boleh kosong',
            'no_telp.requireq' => 'No telepon tidak boleh kosong',
            'no_telp.max' => 'No telepon tidak boleh lebih dari 15 karakter',
            'email.required' => 'email tidak boleh kosong',
            'email.email' => 'email tidak sesuai format',
            'nik.unique' => "nik sudah digunakan oleh user lain",
            'email.unique' => 'Email sudah digunakan oleh user lain',
            'alamat' => 'alamat tidak boleh kosong'
        ];

    }
}