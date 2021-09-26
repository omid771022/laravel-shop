<div class="col-4 bg-white">
    <p class="box__title">ایجاد نقش کاربری  جدید</p>
    <form action="{{route('RolePermission.store')}}" method="post" class="padding-30">
        @csrf
        <input type="text" name="name" placeholder="نام نقش کاربری " class="text">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        
@foreach($Permissions as $Permission)
        <label class="ui-checkbox">
            <input type="checkbox" class="sub-checkbox" data-id="1" name="permissions[{{ $Permission['name']}}]" value="{{$Permission['name'] }}"
            @if(is_array(old('permissions'))  && array_key_exists($Permission['name'], old('permissions'))) checked   @endif>
            <span class="checkmark"></span>
        @lang($Permission['name'])
        </label>
        @endforeach

        @error('permissions')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>




    <p class="box__title">ایجاد نقش   جدید</p>
    <form action="{{route('storePermissions')}}" method="post" class="padding-30">
        @csrf
        <input type="text" name="name" placeholder="نام نقش کاربری " class="text" required>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>







</div>






