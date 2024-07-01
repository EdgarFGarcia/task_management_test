<?php

namespace App\Http\Controllers\Task\Validation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ValidateAddTask extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'task_status_id'                => 'required|numeric',
            'title'                         => 'required|string|max:100',
            'content'                       => 'required|string',
            'image'                         => 'nullable|sometimes|mimes:jpeg,jpg,png,gif|required|max:4000' //max of 4 mb
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'response'      => false,
            'message'       => 'Validation Error',
            'data'          => $validator->errors()
        ], 422));
    }

    public function messages()
    {
        return [];
    }
}
