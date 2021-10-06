<?php

namespace App\Rules;

use App\Repositories\SeasonRepo;
use Illuminate\Contracts\Validation\Rule;

class validSeasonRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
   
    public function passes($attribute, $value)
    {
       $season = resolve(SeasonRepo::class)->findByIdandCourseId($value, request()->route('course'));
        if ($season) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return "سرفصل انتخاب شده معتبر نمی باشد.";
    }
}
