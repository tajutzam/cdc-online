<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'emailOrNik' => 'required|string|max:255',
            "password" => 'required'
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

            'emailOrNik.required' => 'Email atau NIK tidak boleh kosong',

            'password.required' => 'Password tidak boleh kosong'

        ];
    }
}
