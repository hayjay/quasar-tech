<?php

namespace App\Http\Requests\TodoList;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules()
    {
         return [
            'name' => 'required|min:2',
            'description' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required!',
            'description.required' => 'Description field is required!',
            'status.required' => 'Status field is required!',
        ];
    }
}
