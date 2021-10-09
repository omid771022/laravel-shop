<?php

namespace App\Http\Requests;

use App\Rules\validSeasonRule;
use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
     
            $rules = [
                "title" => 'required|min:3|max:190',
                "slug" => 'nullable|min:3|max:190',
                "number" => 'nullable|numeric',
                "time" => 'required|numeric|min:0|max:255',
                "free" => "required|boolean",
                "lesson_file" => "required|file|mimes:avi,mkv,mp4,zip,rar",
         
        ];
        if (request()->method === 'PATCH') {
            $rules['lesson_file'] = 'nullable|file|mimes:avi,mkv,mp4,zip,rar' ;
        }
        return $rules;
    }
    public function attributes()
    {
        return [
            "title" => 'عنوان درس',
            "slug" => 'عنوان انگلیسی درس',
            "number" => 'شماره درس',
            "time" => 'مدت زمان درس',
            "season_id" => "سرفصل",
            "free" => "رایگان",
            "lesson_file" => "فایل درس",
            "body" => "توضیحات درس"
        ];
    }



}
