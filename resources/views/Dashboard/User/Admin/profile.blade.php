@extends('Dashboard.layout.master')
@section('contentDashboard')
@include('Dashboard.layout.header')
    <div class="row no-gutters margin-bottom-20">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی پروفایل</p>
            <x-user-photo />
            <form action="{{ route('user.profile.update')}}" class="padding-30" method="post">
                @csrf
                <input name="name" placeholder="نام کاربری" type="text" value="{{ auth()->user()->name }}" class="text-left text" required/>
                <x-validation-error field="name" />

                <input type="text" name="email" placeholder="ایمیل" value="{{ auth()->user()->email }}" class="text-left text" required />
                <x-validation-error field="email" />

                <input type="text" name="mobile" placeholder="موبایل" value="{{ auth()->user()->mobile }}" class="text-left text"  />
                <x-validation-error field="mobile" />
                @can('teach')
                <input type="text" name="card_number" placeholder="شماره کارت بانکی" value="{{ auth()->user()->card_number }}" class="text-left text"  />
                <x-validation-error field="card_number" />
                <input type="text" name="shaba" placeholder="شماره شبا بانکی" value="{{ auth()->user()->shaba }}" class="text-left text"  />
                <x-validation-error field="shaba" />
                <input type="text" name="username" placeholder="نام کاربری و آدرس پروفایل" value="{{ auth()->user()->username }}" class="text-left text"  />
                <x-validation-error field="username" />
                <p class="input-help text-left text margin-bottom-12" dir="ltr">
                    {{ auth()->user()->profilePath() }}
                    <a href="{{ auth()->user()->profilePath() }}">{{ auth()->user()->username }}</a>
                </p>
                <input type="text" name="headline" placeholder="عنوان"   class="text-left text"value="{{ auth()->user()->headline }}" />
                <x-validation-error field="headline" />
                <input type="password" name="password" placeholder="پسورد جدید"  class="text-left text" value=""  />
  
                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&amp;*()</strong> باشد.</p>
             @endcan
                <textarea placeholder="بیو" name="bio" value="{{ auth()->user()->bio }}" ></textarea>
                <x-validation-error field="headline" />
              
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی پروفایل</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
    <script >
        @include('Dashboard.commen.feedback')
    </script>
@endsection