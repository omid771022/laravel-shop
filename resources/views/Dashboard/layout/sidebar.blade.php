<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://webamooz.net"></a>
   

   <x-user-photo/>

    <ul>
  @can('admin' || 'super admin')
        <li class="item-li i-dashboard @if(Request::is('dashboard/') || Request::is('dashboard')) ? is-active @endif  "><a href="{{route('Dashboard.index')}}">پیشخوان</a></li>
        <li class="item-li i-courses @if(Request::is('dashboard/cource/*') || Request::is('dashboard/cource')) ? is-active @endif "><a href="{{route('course.index')}}">دوره ها</a></li>
        <li class="item-li i-courses @if(Request::is('dashboard/cource/create*') || Request::is('dashboard/cource/create')) ? is-active @endif "><a href="{{route('course.create')}}">لیست دوره ها</a></li>
        <li class="item-li i-role-permissions  @if(Request::is('dashboard/RolePermission/*') || Request::is('dashboard/RolePermission')) ? is-active @endif"><a href="{{route('RolePermission.index')}}"> نقش کاربران</a></li>
        <li class="item-li i-role-permissions  @if(Request::is('dashboard/addPermiison/*') || Request::is('dashboard/addPermiison')) ? is-active @endif"><a href="{{route('addPermiison')}}">انتصاب نقش به کاربر </a></li>
        <li class="item-li i-categories @if(Request::is('dashboard/category/*') || Request::is('dashboard/category')) ?  is-active  @endif  "><a href="{{route('category.index')}}">دسته بندی ها</a></li>
        <li class="item-li i-transactions  @if(Request::is('dashboard/user/payment/transaction/*') || Request::is('dashboard/payment/transaction')) ? is-active @endif "><a href="{{route('payment.transaction')}}">تراکنش ها</a></li>
        <li class="item-li i-users  @if(Request::is('dashboard/user/*') || Request::is('dashboard/user')) ? is-active @endif"><a href="{{route('user.index')}}">  کاربران</a></li>
        @endcan
        <li class="item-li i-users  @if(Request::is('dashboard/user/profile/*') || Request::is('dashboard/user/profile')) ? is-active @endif"><a href="{{route('user.profile')}}">  ویرایش کاربر </a></li>
{{-- 
        <li class="item-li i-slideshow"><a href="slideshow.html">اسلایدشو</a></li>
        <li class="item-li i-banners"><a href="banners.html">بنر ها</a></li>
        <li class="item-li i-articles"><a href="articles.html">مقالات</a></li>
        <li class="item-li i-ads"><a href="ads.html">تبلیغات</a></li>
        <li class="item-li i-comments"><a href="comments.html"> نظرات</a></li>
        <li class="item-li i-tickets"><a href="tickets.html"> تیکت ها</a></li>
        <li class="item-li i-discounts"><a href="discounts.html">تخفیف ها</a></li>
    
        <li class="item-li i-checkouts"><a href="checkouts.html">تسویه حساب ها</a></li>
        <li class="item-li i-checkout__request "><a href="checkout-request.html">درخواست تسویه </a></li>
        <li class="item-li i-my__purchases"><a href="mypurchases.html">خرید های من</a></li>
        <li class="item-li i-my__peyments"><a href="mypeyments.html">پرداخت های من</a></li>
        <li class="item-li i-notification__management"><a href="notification-management.html">مدیریت اطلاع رسانی</a>

        </li>
        <li class="item-li i-user__inforamtion"><a href="user-information.html">اطلاعات کاربری</a></li> --}}
    </ul>

</div>