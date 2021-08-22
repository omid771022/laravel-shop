<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Session;

use App\Notifications\ResatPasswordNotification;
use App\Http\Requests\SendVeryifyPasswordRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;



    public function showVerifyCodeRequestForm()
    {
        return view('auth.passwords.emailpassword');
    }



    public function restpassword()
    {

        return view('auth.passwords.email');
    }

    public function checkveryifycode(SendVeryifyPasswordRequest $request)
    {
        // check if exit databas
        $user = resolve(UserRepo::class)->FindByEmail($request->email);
        if ($user) {
            $user->notify(new ResatPasswordNotification());
            return view('auth.passwords.enter-verify-code-form');
        }
    }
    public function checkcode(Request $request)
    {

        $user = User::where('verify_code', $request['verify_code'])->first();
        if ($user) {

            auth()->loginUsingId($user->id);
            return view('auth.passwords.showFormPassword');
        } else {

            Session::flash('message', ' کد تایید نادرست است ');
            return redirect()->back();
        }



    }

public function passwordUpdate(PasswordRequest $request){
  auth()->user()->password =bcrypt($request->password);
auth()->user()->save();
return redirect()->route('home');
}
}