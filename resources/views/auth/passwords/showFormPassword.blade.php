@extends('auth.master');
@section('content');
<main>
    <div class="account">
        <form action="{{route('password.update')}}" class="form" method="post">
            @csrf
            <a class="account-logo" href="index.html">
                <img src="img/weblogo.png" alt="">
            </a>
 

          

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

        </form>
    </div>
</main>

@endsection
