@extends('Dashboard.layout.master')
@section('contentDashboard')
@include('Dashboard.layout.header')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">کاربران</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>ای دی</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>نقش کاربری</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr role="row" class="">
                        <td><a href="">{{ $user->id }}</a></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="">
                                <ul>
                                    @foreach($user->roles as $userRole)
                                        <li>{{ $userRole->name }}</li>
                                    @endforeach
                                </ul>
                            </a></td>
                        <td>
                            {{-- <a href="" onclick="deleteItem(event, '{{ route('users.destroy', $user->id) }}')" class="item-delete mlg-15" title="حذف"></a> --}}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
     
            </div>
        </div>
    </div>
@endsection
