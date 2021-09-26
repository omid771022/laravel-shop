@extends('auth.master');
@section('content');
<main>

    <div class="account">
        <form action="{{route('register')}}" class="form" method="post">
            @csrf
            <a class="account-logo" href="index.html">
                <!-- <img src="img/weblogo.png" alt=""> -->
            </a>
            <div class="form-content form-account">
                <input type="text" class="txt @error('name') is-valid @enderror" placeholder="نام و نام خانوادگی" name="name" value="{{old('name')}}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror






                <input name="mobile" value="{{old('mobile')}}" required autocomplete="mobile" 
                autofocustype="text" class="txt txt-l @error('mobile') is-valid @enderror" placeholder="موبایل">
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror





                <input name="email" value="{{old('email')}}" required autocomplete="email" 
                autofocustype="text" class="txt txt-l @error('email') is-valid @enderror" placeholder="ایمیل">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror

                <input type="password" name="password" class="txt txt-l @error('password') is-valid @enderror " placeholder="رمز عبور">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror

                <input type="password" name="password_confirmation"  class="txt txt-l @error('password-confirm') is-valid @enderror " placeholder="تکرار رمز عبور ">
                @error('password-confirm')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror

                <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
                <br>
                <button class="btn continue-btn">ثبت نام و ادامه</button>

            </div>
            <div class="form-footer">
                <a href="login.html">صفحه ورود</a>
            </div>
        </form>
    </div>

    @endsection