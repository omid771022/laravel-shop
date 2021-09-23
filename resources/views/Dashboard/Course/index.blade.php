@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی دوره</p>
            <form action="{{ route('courses.store') }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" class="text" name="title" value="{{ old('title') }}" placeholder="عنوان دوره" >
                <x-validation-error field="title"/>
                <input type="text" class="text text-left " value="{{ old('slug') }}" name="slug" placeholder="نام انگلیسی دوره" >
                <x-validation-error field="slug" />
                <x-validation-error field="price" />
                <x-validation-error field="percent" />
                <x-validation-error field="priority" />
                <div class="d-flex multi-text">
                    
                    <input type="text" value="{{old('priority')}}" class="text text-left mlg-15" name="priority" placeholder="ردیف دوره">
                 
                    <input type="text" value="{{old('price')}}" placeholder="مبلغ دوره" name="price" class="text-left text mlg-15" >
                    
                    <input type="number" value="{{old('percent')}}" placeholder="درصد مدرس" name="percent" class="text-left text" >
                </div>
                <x-validation-error field="teacher_id"/>
                <select name="teacher_id"  >
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach ($techers as $techer)
                        <option value="{{ $techer->id }}" @if($techer->id == old('teacher_id')) selected @endif   >{{ $techer['name'] }}</option>
                    @endforeach
                </select>
                <x-validation-error field="typeBuy" />
                <select name="typeBuy" >
                    <option value="">نوع دوره</option>
                    @foreach ( \App\Course::$types as $key=>$type)
                    <option value="{{$key}}" @if($key == old('typeBuy')) selected @endif  >{{ $type }}</option>
                    @endforeach
               
         
                </select>
               <x-validation-error field="status_enum" />
                <select name="status_enum">
                    <option value="">وضعیت دوره</option>
                    @foreach (\App\Course::$enums as $key=>$enum )
                    <option value="{{$key}}" >{{$enum}}</option>
                    @endforeach
                </select>
                <x-validation-error field="category_id" />
                <select name="category_id" >
                    <option value="">دسته بندی</option>
                    @foreach ($categories as $category)
                    {{-- @if($techer->id == old('teacher_id')) selected @endif --}}
                        <option value="{{ $category['id'] }}" @if($category['id']  == old('category_id')) selected @endif >{{ $category['name'] }}</option>
                    @endforeach


                </select>
                <x-validation-error field="image" />
                <div class="file-upload">
                    <div class="i-file-upload">
                        <span>آپلود بنر دوره</span>
                        <input type="file" class="file-upload" id="files" name="image" {{old('category_id')}} />
                    </div>
                    <span class="filesize"></span>
                    <span class="selectedFiles">فایلی انتخاب نشده است</span>
                </div>
                <textarea placeholder="توضیحات دوره" name="body" class="text h"></textarea>
                <button class="btn btn-webamooz_net">ایجاد دوره</button>
            </form>
        </div>
    </div>


@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
@endsection
