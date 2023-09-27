<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisibleRequest extends FormRequest
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
            'type' => 'required',
            'value' => 'required|regex:/^[01]$/',
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
            "type.required" => "Type tidak boleh kosong",
            "value.required" => "value tidak boleh kosong",
            "value.regex" => "value harus Di isi dengan 1 atau 0"
        ];

    }

}