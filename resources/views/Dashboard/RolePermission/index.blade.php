@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')


    @if(Session::has('delete_Permssion'))
{{Session::get('delete_Permssion')}}

@endif

    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>شناسه</th>
                                <th>نقش کاربری </th>
                                <th>مجوزها </th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                    <tr role="row" class="">
                        <td><a href="">{{ $role->id }}</a></td>
                        <td><a href="">{{ $role->name }}</a></td>
                        <td>
                            <ul>
                                @foreach($role->Permissions as $permission)
                                    <li>@lang($permission->name)  <a href="{{route('Permission.delete', [$role , $permission] )}}" class="item-delete mlg-15" title="حذف" onclick="  return confirm('ایا مطمن هستید که می خواهید حذف کنید');" ></a></li>
                                @endforeach
                            </ul>
                        </td>
      
                            <td>
                               
                                <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <a href="{{route('editPermissionRole', $role['id'])}}" class="item-edit " title="ویرایش"></a>
                            </td>
                    </tr>
                    @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
            @include('Dashboard.RolePermission.create')
        </div>

    </div>
    </div>



    

@endsection
