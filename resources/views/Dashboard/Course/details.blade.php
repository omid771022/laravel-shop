@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')
    @include('Dashboard.commen.feedback')
    <div class="row no-gutters  ">
        <div class="col-8 bg-white padding-30 margin-left-10 margin-bottom-15 border-radius-3">
            <div class="margin-bottom-20 flex-wrap font-size-14 d-flex bg-white padding-0">
                <p class="mlg-15">دوره مقدماتی تا پیشرفته لاراول</p>
                <a class="color-2b4a83" href="{{route('season.upload', $course->id)}}">آپلود جلسه جدید</a>
        
            </div>
            <div class="d-flex item-center flex-wrap margin-bottom-15 operations__btns">
                <button class="btn all-confirm-btn">تایید همه جلسات</button>
                <button class="btn confirm-btn" onclick="confirmMultiple('{{route('lessons.confirmMultiple')}}')">تایید جلسات</button>
                <button class="btn reject-btn" onclick="rejectMultiple('{{route('lessons.rjectMultiple')}}')">رد جلسات</button>
                <button class="btn delete-btn" onclick="deleteMultiple('{{ route('lessons.destroyMultiple', $course->id) }}')">حذف جلسات</button>

            </div> 
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th style="padding: 13px 30px;">
                            <label class="ui-checkbox">
                                <input type="checkbox" class="checkedAll">
                                <span class="checkmark"></span>
                            </label>
                        </th>
                        <th>شماره</th>
                        <th>عنوان جلسه</th>
                        <th>عنوان فصل</th>
                        <th>مدت زمان جلسه</th>
                        <th>وضعیت تایید</th>
                        <th>وضعیت</th>
                        <th>سطح دسترسی</th>
                       
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($lessons as $lesson)
                        <tr role="row" class="" data-row-id="{{ $lesson->id }}">
                        <td>
                            <label class="ui-checkbox">
                                <input type="checkbox" class="sub-checkbox" data-id="{{ $lesson->id }}">
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <td><a href="">{{ $lesson->id }}</a></td>
                        <td><a href="">{{ $lesson->title}}</a></td>
                        <td>{{ $lesson->season->title }}</td>
                        <td>{{ $lesson->time }} دقیقه </td>
                        <td>
                            @foreach (\App\Lesson::$confirmationStatus as $key => $value)
                            @if ($key == $lesson->confirmationStatus)
                                {{ $value }}
                            @endif
                        @endforeach
                        </td>
                        <td>
                            @foreach (\App\Lesson::$statuses as $key => $value)
                            @if ($key == $lesson->status)
                                {{ $value }}
                            @endif
                        @endforeach
                        </td>
                        <td>{{ $lesson->free ? 'همه'  : 'شرکت کنندگان'}}</td>
                        <td>
                            <a href="{{route('lesson.delete', $lesson->id)}}" onclick="return confirm('آیا از حذف مطمن هستید')" class="item-delete mlg-15" title="حذف"></a>
                            <a href="{{route('lesson.reject', $lesson->id)}}" class="item-reject mlg-15" title="رد"></a>
                            @if ($lesson['status'] == 'open')
                            <a href="{{ route('lesson.lock',$lesson->id) }}"
                                onclick="return confirm('آیا منطمن هستید که می خواهید دوره را در حالت قفل قرار دهید')"
                                class="item-lock mlg-15 text-success"></a>
                            @else
                            <a href="{{ route('seasons.open',$lesson->id) }}" 
                                onclick="return confirm('آیا منطمن هستید که می خواهید دوره را در حالت باز قرار دهید')"
                               
                                class="item-lock mlg-15 text-error"></a>
                            @endif

                            <a href="{{route('lesson.accept', $lesson->id)}}" class="item-confirm mlg-15" title="تایید"></a>
                            <a href="" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4">
            @include('Dashboard.Course.seasons.index')

            <div class="col-12 bg-white margin-bottom-15 border-radius-3">
                <p class="box__title">اضافه کردن دانشجو به دوره</p>
                <form action="" method="post" class="padding-30">
                    <select name="" id="">
                        <option value="0">انتخاب کاربر</option>
                        <option value="1">mohammadniko3@gmail.com</option>
                        <option value="2">sayad@gamil.com</option>
                    </select><div class="dropdown-select wide" tabindex="0"><span class="current">mohammadniko3@gmail.com</span><div class="list"><div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div><ul><li class="option" data-value="0" data-display-text="">انتخاب کاربر</li><li class="option selected" data-value="1" data-display-text="">mohammadniko3@gmail.com</li><li class="option " data-value="2" data-display-text="">sayad@gamil.com</li></ul></div></div>
                    <input type="text" placeholder="مبلغ دوره" class="text">
                    <p class="box__title">کارمزد مدرس ثبت شود ؟</p>
                    <div class="notificationGroup">
                        <input id="course-detial-field-1" name="course-detial-field" type="radio" checked="">
                        <label for="course-detial-field-1">بله</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="course-detial-field-2" name="course-detial-field" type="radio">
                        <label for="course-detial-field-2">خیر</label>
                    </div>
                    <button class="btn btn-webamooz_net">اضافه کردن</button>
                </form>
                <div class="table__box padding-30">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th class="p-r-90">شناسه</th>
                            <th>نام و نام خانوادگی</th>
                            <th>ایمیل</th>
                            <th>مبلغ (تومان)</th>
                            <th>درامد شما</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr role="row" class="">
                            <td><a href="">1</a></td>
                            <td><a href="">توفیق حمزه ای</a></td>
                            <td><a href="">Mohammadniko3@gmail.com</a></td>
                            <td><a href="">40000</a></td>
                            <td><a href="">20000</a></td>
                            <td>
                                <a href="" onclick="" class="item-delete mlg-15" title="حذف"></a>
                                <a href="" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @section('js')
@endsection
@endsection
