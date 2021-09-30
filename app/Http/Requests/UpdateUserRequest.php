<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "name" => 'required|min:3|max:190',
            "email" => 'required|email|min:3|max:190',
            "username" => 'nullable|min:3|max:190',
            "mobile" => 'nullable',
            "status" => ["required", Rule::in(\App\User::$statues)],
            "image" => "nullable|mimes:jpg,png,jpeg",
        ];
    }
}
