@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')
<div class="main-content font-size-13">
    <div class="row no-gutters  margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>کل فروش ۳۰ روز گذشته  سایت </p>
            <p>{{$getLastTotalDays}}</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>درامد خالص ۳۰ روز گذشته سایت</p>
            <p>{{$getLastNetIncome}}</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>کل فروش سایت</p>
            <p>{{$getAllSeller}}</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p> کل درآمد خالص سایت</p>
            <p>{{$getAllNetIncome}}</p>
        </div>
    </div>
    <div class="row no-gutters border-radius-3 font-size-13">
        <div class="col-12 bg-white padding-30 margin-bottom-20">
            محل نمودار درامد سی روز گذاشته
        </div>

    </div>
    <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
        <p class="margin-bottom-15">همه تراکنش ها</p>
        <div class="t-header-search">
            <form action="" >
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی تراکنش">
                    <div class="t-header-search-content ">
                        <input type="text"  class="text" name="email" {{request("email")}} placeholder="ایمیل">
                        <input type="text"  class="text" name="startDate" {{request("startDate")}} placeholder="از تاریخ : 1399/10/11">
                        <input type="text" class="text margin-bottom-20" name="endDate" {{request("endDate")}} placeholder="تا تاریخ : 1399/10/12">
                        <button type="submit" class="btn btn-webamooz_net">جستجو</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table__box">
        <table width="100%" class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>شناسه پرداخت</th>
                <th>نام و نام خانوادگی</th>
                <th>ایمیل پرداخت کننده</th>
          
                <th>مبلغ (تومان)</th>
                <th>درامد شما</th>
                <th>درامد سایت</th>
                <th>نام دوره</th>
                <th>تاریخ و ساعت</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
       
        
            @foreach ($payments as  $payment)
            @if ($payment)
            <tr role="row">
                <td><a href=""> {{ $payment->id }}</a></td>
                <td><a href="">{{ $payment->order->user->name }}</a></td>
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
                        href="">{{ \Morilog\Jalali\Jalalian::forge($payment->created_at)->format('Y/m/d') }}</a>
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
            @endif
        @endforeach
  
            </tbody>
        </table>
    </div>
</div>
{!! $payments->render() !!}

@endsection