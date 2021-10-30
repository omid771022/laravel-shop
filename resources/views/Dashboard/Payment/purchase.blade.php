@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')

    <div class="table__box">
        <table class="table">
            <thead>
                <tr class="title-row">
                    <th>عنوان دوره</th>
                    <th>تاریخ پرداخت</th>
                    <th>مقدار پرداختی</th>
                    <th>وضعیت پرداخت</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    @foreach ($order->courses as $course)
                        <tr>
                            <th>{{ $course->title }}</th>
                            <td>{{ \Morilog\Jalali\Jalalian::forge($order->created_at)->format('Y/m/d') }}</td>
                            <th>{{ $course->price }}</th>
                            <td>
                                @if ($order['status'] == 'paid')
                                <p style="color:green">پرداخت موفق</p>
                            @elseif ($order['status'] == "unpiad")
                                <p style="color:red">پرداخت ناموفق</p>
                            @elseif ($order['status'] == "cancel")
                                <p style="color:red">در انتظار پرداخت </p>
        
        
                            @endif
        
                            </td>
  
                    @endforeach
                  




                    </tr>

                @endforeach
            </tbody>
        </table>


    </div>

@endsection
