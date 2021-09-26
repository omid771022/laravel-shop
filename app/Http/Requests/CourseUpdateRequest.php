<?php

namespace App\Http\Requests;
use App\Course;
use App\Rules\validTeacherRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
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
            "title" => 'required|min:3|max:190',
            "slug" => 'required|min:3|max:190|',
            "priority" => 'nullable|numeric',
            "price" => 'required|numeric|min:0|max:10000000',
            "percent" => 'required|numeric|min:0|max:100',
            "teacher_id" => ['required','exists:users,id', new validTeacherRule()],
            "typeBuy" => ["required", Rule::in(array_keys(Course::$types))],
            "statusEnum" => ["required", Rule::in(array_keys(Course::$enums))],
            "category_id" => "required|exists:categories,id",
            "image" => "mimes:jpg,png,jpeg",
        ];
    }
}
