<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Upsert extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'price' => 'required|numeric|min:0'
        ];
        return $rules;
    }

    public function failedValidation(Validator $validator)
    {
        $data = $validator->errors();
        $response = response()->json($data->messages(), 422);
        throw new HttpResponseException($response);
    }
}