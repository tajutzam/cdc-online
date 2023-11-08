<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'fullname' => 'required|string',
            'ttl' => 'required|string',
            'about' => 'required|string',
            'linkedin' => 'nullable|string',
            'instagram' => 'nullable|string',
            'x' => 'nullable|string',
            'facebook' => 'nullable|string',
            'no_telp' => 'required|max:13',
            'gender' => 'required|in:male,female',
            'alamat' => 'required',
            'nik' => 'required|unique:users,email'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Kolom Nama Lengkap harus diisi.',
            'fullname.string' => 'Kolom Nama Lengkap harus berupa teks.',
            'ttl.required' => 'Kolom Tempat Tanggal Lahir harus diisi.',
            'ttl.string' => 'Kolom Tempat Tanggal Lahir harus berupa teks.',
            'about.required' => 'Kolom Tentang Saya harus diisi.',
            'about.string' => 'Kolom Tentang Saya harus berupa teks.',
            'linkedin.required' => 'Kolom LinkedIn harus diisi.',
            'linkedin.string' => 'Kolom LinkedIn harus berupa teks.',
            'instagram.required' => 'Kolom Akun Instagram harus diisi.',
            'instagram.string' => 'Kolom Akun Instagram harus berupa teks.',
            'x.required' => 'Kolom X harus diisi.',
            'x.string' => 'Kolom X harus berupa teks.',
            'facebook.required' => 'Kolom Akun Facebook harus diisi.',
            'facebook.string' => 'Kolom Akun Facebook harus berupa teks.',
            'no_telp.required' => 'Kolom Nomor Telepon harus diisi.',
            'gender.required' => 'Kolom Jenis Kelamin harus diisi.',
            'gender.in' => 'Kolom Jenis Kelamin harus salah satu dari: "male" atau "female".',
            'alamat.required' => 'Kolom Alamat harus diisi.',
            'nik.required' => 'Kolom NIK harus diisi.',
            'nik.unique' => 'NIK sudah digunakan sebelumnya, harap gunakan NIK yang berbeda.',
            'no_telp.max' => 'No telepon maksimal adalah 13 karakter'
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



}