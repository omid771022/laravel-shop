@component('mail::message')
# کد فعال سازی حساب شما در وب اموز 

این ایمیل به دلیل ثبت نام شما در سایت وب اموز برای شما  ارسال شده است 
**درصورتی که ثبت نامی توسط شما انجام نشده است**
این ایمیل را نادیده بگیرید.
@component('mail::panel')
کد فعال سازی شما :{{$code}}
@endcomponent

پروژه,<br>
{{ config('app.name') }}
@endcomponent
