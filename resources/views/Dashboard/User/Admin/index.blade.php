@extends('Dashboard.layout.master')
@section('contentDashboard')
    @include('Dashboard.layout.header')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            @if (Session::has('delete'))
                {{ Session::get('delete') }}

            @endif

            <p class="box__title">کاربران</p>
            <div class="table__box">

                <table class="table">
                    <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>ای دی</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <td>وضعیت تایید </td>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr role="row" class="">
                        <td><a href="">{{ $user->id }}</a></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                          <td>{{$user->hasVerifiedEmail() ? 'تایید شده' : 'تاییذ نشده'}}</td>
                            <td>
                                <a onclick=" return confirm(' ایا از حذف کاربر اطمینان دارید ')" href="{{ route('users.destroy', $user->id) }}" class="item-delete mlg-15" title="حذف"></a>
                             <a href="{{ route('users.edit', $user->id) }}" class="item-edit mlg-15" title="ویرایش"></a>
                                <a href="{{route('user.manualVerify' , $user->id) }}" class="item-confirm mlg-15"></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('Dashboard.commen.feedback')
                </div>
            </div>
        </div>
@endsection
