<div class="col-12 bg-white margin-bottom-15 border-radius-3">
    <p class="box__title">سرفصل ها</p>
    @include('Dashboard.commen.feedback')
    <form action="{{ route('seasons.store', $course->id) }}" method="post" class="padding-30">
        @csrf 
        <input type="text" name="title" placeholder="عنوان سرفصل" class="text"  />
        <x-validation-error field="title" />
        <input type="text" name="number" placeholder="شماره سرفصل" class="text" />
        <x-validation-error field="number" />
        <button type="submit" class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
    <div class="table__box padding-30">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th class="p-r-90">شناسه</th>
                <th>عنوان فصل</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
                
            @foreach($course->seasons as $season)
            <tr role="row" class="">
                <td><a href="">{{ $season->number }}</a></td>
                <td><a href="">{{ $season->title }}</a></td>
                <td>
                    <a href="" class="item-delete mlg-15" title="حذف"></a>
                    <a href="" class="item-reject mlg-15" title="رد"></a>
                    <a href="" class="item-confirm mlg-15" title="تایید"></a>
                    <a href="" class="item-edit " title="ویرایش"></a>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div> 