@extends('Dashboard.layout.master')

@section('contentDashboard')
    @include('Dashboard.layout.header')
    @if (Session::has('message'))
        {{ Session::get('delete') }}
    @endif


    <div class="main-content">
        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> موجودی حساب فعلی </p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> کل فروش دوره ها</p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> کارمزد کسر شده </p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
                <p> درآمد خالص </p>
                <p>2,500,000 تومان</p>
            </div>
        </div>
        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> درآمد امروز </p>
                <p>500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> درآمد 30 روز گذاشته</p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> تسویه حساب در حال انجام </p>
                <p>0 تومان </p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white  margin-bottom-10">
                <p>تراکنش های موفق امروز (0) تراکنش </p>
                <p>2,500,000 تومان</p>
            </div>
        </div>
        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-8 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
                محل قرار گیری نمودار
            </div>
            <div class="col-4 info-amount padding-20 bg-white margin-bottom-12-p margin-bottom-10 border-radius-3">

                <p class="title icon-outline-receipt">موجودی قابل تسویه </p>
                <p class="amount-show color-444">600,000<span> تومان </span></p>
                <p class="title icon-sync">در حال تسویه</p>
                <p class="amount-show color-444">0<span> تومان </span></p>
                <a href="/" class=" all-reconcile-text color-2b4a83">همه تسویه حساب ها</a>
            </div>
        </div>
        <div class="row bg-white no-gutters font-size-13">
            <div class="title__row">


            </div>
            <div class="table__box">
                <table width="100%" class="table">
                    <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه پرداخت</th>
                            <th>ایمیل پرداخت کننده</th>
                            <th>مبلغ (تومان)</th>
                            <th>درامد مدرس</th>
                            <th>درامد سایت</th>
                            <th>نام دوره</th>
                            <th>تاریخ و ساعت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $key => $payment)
                            <tr role="row">
                                <td><a href=""> {{ $payment->id }}</a></td>
                                <td><a href="">{{ $payment->order->user->email }}</a></td>
                                <td><a href="">{{ $payment->amount }}</a></td>
                                <td><a href="">{{ $payment->seller_share }}</a></td>
                                <td><a href="">{{ $payment->site_share }}</a></td>
                                <td><a href="">
                                        @foreach ($payment->order->courses as $payment_course)
                                        - {{$payment_course->title}} 
                                        @endforeach
                                    </a></td>
                                <td><a
                                        href="">{{ \Morilog\Jalali\Jalalian::forge($payment->created_at)->format('%B %d، %Y') }}</a>
                                </td>
                                <td>
                                    @if ($payment['status'] == 'success')
                                        <p style="color:green">پرداخت موفق</p>
                                    @elseif ($payment['status'] == "fail")
                                        <p style="color:red">پرداخت ناموفق</p>
                                    @elseif ($payment['status'] == "pending")
                                        <p style="color:red">در انتظار پرداخت </p>


                                    @endif
                                </td>
                                <td class="i__oprations">
                                    <a href="" class="item-delete margin-left-10" title="حذف"></a>
                                    <a href="edit-transaction.html" class="item-edit" title='ویرایش'></a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            {{ $payments->links() }}
        </div>
    </div>
    </div>
@endsection
