@component('mail::message')
# کد باز یابی رمز عبور  حساب شما در وب اموز 

در خواست شما جهت بازیابی رمز عبور ارسال شده است 
**لطفا ایمیل خود را چک کنید **

@component('mail::panel')
کد بازیابی  :{{$code}}
@endcomponent

پروژه,<br>
{{ config('app.name') }}
@endcomponent
