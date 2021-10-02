<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileInformationRequest extends FormRequest
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
            "email" => 'required|email|min:3|max:190|unique:users,email,' . auth()->id(),
            "username" => 'nullable|min:3|max:190|unique:users,username,' .  auth()->id(),
            "mobile" => 'nullable',
            "username" => 'required|min:3|max:190|unique:users,username,' .  auth()->id(),
            "card_number" => 'required|string|size:16',
            "shaba" => 'required|size:24',
            "headline" => 'required|min:3|max:60',
            

        ];

   


    }


    public function attributes()
    {
        return [
            'shaba' => 'شماره شبای بانکی',
            'card_number' => 'شماره کارت بانکی',
            'username' => 'نام کاربری',
            'headline' => 'عنوان',
            'bio' => 'بیو',
            "password" => 'رمز عبور جدید',
            "mobile" => "موبایل",
        ];
    }
}
