@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')
    <br>
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی نقش کاربری</p>
            <form action="{{ route('updatePermissionRole', $role->id) }}" method="post" class="padding-30">
                @csrf
 
                <input type="hidden" name="id" value="{{ $role->id}}">
              
                <input type="text" name="name" required placeholder="نام نقش کاربری" class="text"
                       value="{{ $role->name}}">
                @error("name")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <p class="box__title margin-bottom-15">انتخاب مجوزها</p>
                @foreach($permissions as $permission)
                    <label class="ui-checkbox pt-1">
                        <input type="checkbox" name="permissions[{{ $permission->name }}]" class="sub-checkbox"
                               data-id="2"
                               value="{{ $permission->name }}"
                               @if($role->hasPermissionTo($permission->name)) checked @endif>
                        <span class="checkmark"></span>
                        @lang($permission->name)
                    </label>
                @endforeach
                @error("permissions")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <hr>

                <button class="btn btn-webamooz_net mt-2">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection