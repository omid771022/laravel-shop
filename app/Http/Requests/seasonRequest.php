<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class seasonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => 'required|min:3|max:190',
            "number" => 'nullable|numeric|min:0|max:250',
        ];
    }
        public function attributes()
        {
            return [
                "title" => "عنوان فصل",
                "number" => "شماره فصل",
            ];
    }
}
