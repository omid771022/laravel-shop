@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')
    <div class="col-12 bg-white">
        <p class="box__title">ویرایش</p>
        <form action="{{ route('categories.update', $categoryInfo['id']) }}" method="post" class="padding-30">
            @csrf

            <input type="text" name="name" placeholder="نام دسته بندی" class="text"
                value="{{ $categoryInfo['name'] }}">


            <input type="text" name="slug" placeholder="نام انگلیسی دسته بندی" class="text"
                value="{{ $categoryInfo['slug'] }}">

            <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
            <select name="parent_id" id="parent_id">
                <option value="">ندارد</option>
                @foreach ($categories as $category)
                    <option value="{{ $category['id']}}" @if ( $category['id'] == $categoryInfo['parent_id']  ) selected   @endif >{{ $category['name'] }}</option>

                @endforeach
            </select>

            @if(Session::has('message'))
            <p>{{ Session::get('message') }}</p>
            @endif

            <button class="btn btn-webamooz_net">ویرایش کردن </button>
        </form>
    </div>


@endsection
