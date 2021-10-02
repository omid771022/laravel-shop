
@extends('auth.master')
@section('content')
<main>

    <div class="account">
        <form action="{{route('verification.verify')}}" class="form" method="post">

            @csrf
            <a class="account-logo" href="index.html">
                <img src="img/weblogo.png" alt="">
            </a>
            <div class="card-header">
                <p class="activation-code-title">کد فرستاده شده به ایمیل  <span>{{auth()->user()->email}}</span></p> را وارد کنید</p>
            </div>


            @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="form-content form-content1">
                <input name="verify_code" class="activation-code-input" placeholder="فعال سازی">
                <br>
                <button class="btn i-t">تایید</button>

            </div>
            <div class="form-footer">
                <a href="{{route('register')}}">صفحه ثبت نام</a>
            </div>
        </form>
        <form action="{{route('verification.resend')}}" method="post">
            @csrf
              <button type="submit" class="btn btn-primary">ارسال مجدد</button>
          </form>
        <br>
       
    </div>
</main>


@endsection
@section('js')
<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/activation-code.js"></script>
@endsection