<?php

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Upsert extends FormRequest
{
    public function rules()
    {
        $rules = [
            '*.product_id' =>'required|exists:products,id',
            '*.quantity' => 'required|numeric|min:1',
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