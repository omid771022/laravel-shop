<div class="col-4 bg-white">
    <p class="box__title">ایجاد دسته بندی جدید</p>
    <form action="{{route('categories.store')}}" method="post" class="padding-30">
        @csrf
        <input type="text" name="name" placeholder="نام دسته بندی" class="text">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        
        <input type="text" name="slug" placeholder="نام انگلیسی دسته بندی" class="text">
        @error('slug')
 <span class="invalid-feedback" role="alert">
     <strong>{{ $message }}</strong>
 </span>
 @enderror
        <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
        <select name="parent_id" id="parent_id">
            <option value="">ندارد</option>
            @foreach ($categories as $category)
            <option value="{{$category['id']}}">{{$category['name']}}</option>
 
            @endforeach
        </select>

        @error('parent_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
</div>






