@extends('Dashboard.layout.master');
@section('contentDashboard')
@include('Dashboard.layout.header')

@if(Session::has('message'))
<p >{{ Session::get('message') }}</p>
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
                        <th>نام دسته بندی</th>
                        <th>نام انگلیسی دسته بندی</th>
                        <th>دسته پدر</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                    <tr role="row" class="">
                        <td><a href=""></a>{{$category['id']}}</td>
                        <td><a href="">{{$category['name']}}</a></td>
                        <td>{{$category['slug']}}</td>
                        <td>{{$category['parent']}}</td>
                        <td>
                            <a href="{{route('categories.delete', $category['id'])}}" class="item-delete mlg-15" title="حذف" onclick="myFunction()" ></a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="{{route('categories.edit', $category['id'])}}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>

@endforeach

                    </tbody>
                </table>
            </div>
        </div>
  @include('Dashboard.Category.create');
    </div>
</div>
</div>

<script>

function myFunction() {
  confirm("ایا مطمن هستید که می خواهید حذف کنید ");
} 
</script>

@endsection

