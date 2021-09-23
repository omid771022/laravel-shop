<?php

namespace App\Rules;


use App\Repositories\UserRepoInterface;

use App\Repositories\UserRepo;
use Illuminate\Contracts\Validation\Rule;

class validTeacherRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

 


    public function __construct()
    {
    
    }

   
    public function passes($attribute, $value)
    {


        $user = resolve(UserRepo::class)->findByUserId($value);
        return $user->hasPermissionTo('teach');

        // $user = User::where('id', $value)->first();
        // return $user->hasPermissionTo('teach');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' کاربر انتخاب شده یک مدرس معتبر نیست ';
    }
}
