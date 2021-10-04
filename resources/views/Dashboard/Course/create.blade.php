@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')

    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دسته بندی ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>ردیف</th>
                            <th>ای دی</th>
                            <th>بنر</th>
                            <th>عنوان</th>
                            <th>مدرس</th>
                            <th>قیمت</th>
                            <th>جزییات</th>
                            <th>درصد مدرس</th>
                            <th>وضعیت</th>
                            <th>تایید دوره </th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $key => $course)
                            <tr role="row"
                                class="">

                        <td>{{ $key + 1 }}</td>
                        <td><a href="">{{ $course->id }}</a></td>
                                <td width=" 80"><img width="150" src="/uploads/course/{{ $course->media->files }}" />
                                </td>
                                <td><a href="">{{ $course->title }}</a></td>
                                <td><a href="">{{ $course->teacher->name }}</a></td>
                                <td>{{ $course->price }}</td>
                                <td> <a href="{{route('course.details', $course->id) }}"> مشاهده</a></td>
                                <td>{{ $course->percent }}%</td>
                                <td>
                                    @foreach (\App\Course::$enums as $key => $value)
                                        @if ($key == $course['enum'])
                                            {{ $value }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach (\App\Course::$confirmationStatus as $key => $value)
                                        @if ($key == $course['confirmationStatus'])
                                            {{ $value }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('courses.destroy', $course->id) }}" class="item-delete mlg-15"
                                        title="حذف"></a>
                                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{ route('courses.edit', $course->id) }}" class="item-edit "
                                        title="ویرایش"></a>
                                    <a href=" {{ route('course.accept', $course->id) }}"
                                        onclick="return confirm('آیا مطمن هستید که میخواهید دور را تایید کنید')"
                                        class="item-confirm mlg-15" title="تایید شد"></a>
                                    <a href="{{ route('course.reject',$course->id) }}"
                                        onclick="return confirm('آیا مطمن هستید که میخواهید دور را رد کنید')"
                                        class="item-reject mlg-15">
                                        <a href="{{ route('course.pending',$course->id) }}"
                                            onclick="return confirm('آیا منطمن هستید که می خواهید دوره را در حالت قفل قرار دهید')"
                                            class="item-lock mlg-15">

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
@endsection
