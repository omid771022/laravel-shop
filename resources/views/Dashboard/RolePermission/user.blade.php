@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')
<br>
<br>


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
                        @foreach($allUserRole as $role)

                <tr role="row" class="">
                    <td><a href="">{{ $role->id }}</a></td>
                    <td>{{ $role->name}}</td>
                    
                    <td>
                        <ul>
                  
                        </ul>
                    </td>
  
                        <td>
                            <a href="{{route('PermissionRole.delete', $role['id'])}}" class="item-delete mlg-15" title="حذف"  ></a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="{{route('editPermissionRole', $role['id'])}}" class="item-edit " title="ویرایش"></a>
                        </td>
                </tr>
                @endforeach
                    </tbody>
                </table>


            </div>
        </div>

        <div class="col-4 bg-white">
            <p class="box__title">انتصاب نقش به کاربر </p>
            <form action="{{route('RolePermission.adduser')}}" method="post" class="padding-30">
                @csrf
        
               @foreach($Roles as $Role)
                <label class="ui-checkbox">
                    <input type="checkbox" class="sub-checkbox" data-id="1" name="Role[{{ $Role['name']}}]" value="{{$Role['name'] }}"
                    @if(is_array(old('Role'))  && array_key_exists($Role['name'], old('permissions'))) checked   @endif>
                    <span class="checkmark"></span>
                @lang($Role['name'])
                </label>
                @endforeach
        
                @error('Role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        
        
                <p class="box__title margin-bottom-15">  انتخاب کاربر </p>
                <select name="user_id" id="user_id" >
                    <option value=""> نام کاربر </option>
                    @foreach ($users as $user)
                    <option value="{{$user['id']}}">{{$user['name']}}</option>
                    @endforeach
                </select>
        
        
                @error('user_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <button class="btn btn-webamooz_net">اضافه کردن</button>
            </form>
        </div>
        
    
    
    
    </div>

</div>
@endsection