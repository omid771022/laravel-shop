


<div class="col-4 bg-white">
    <p class="box__title">ایجاد دسته بندی جدید</p>
    <form action="{{route('categories.store')}}" method="post" class="padding-30">
        <input type="text" name="title" placeholder="نام دسته بندی" class="text">
        <input type="text" name="slug" placeholder="نام انگلیسی دسته بندی" class="text">
        <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
        <select name="parent_id" id="parent_id">
            <option value="">ندارد</option>
            <option value="0">برنامه نویسی</option>
        </select>
        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
</div>






