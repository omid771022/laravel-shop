
@extends('auth.master')
@section('content')
<main>
    <div class="account">
        <form action="{{route('password.email')}}" class="form" method="post">
        @csrf     
        
        <a class="account-logo" href="index.html">
                <img src="img/weblogo.png" alt="">
            </a>
            <div class="form-content form-account">


            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{session('status')}}
            </div>
            @endif
                <input   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus   type="email" class="txt-l txt @error('email') is-invalid @enderror" placeholder="ایمیل" >
                <br>
                <button class="btn btn-recoverpass">بازیابی</button>
            </div>
            <div class="form-footer">
                <a href="{{route('login')}}">صفحه ورود</a>
            </div>
        </form>
    </div>
</main>
@endsection
