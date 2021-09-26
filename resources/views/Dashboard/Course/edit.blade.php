@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی دوره</p>
            <form action="{{route('course.update', $course['id'] )}}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                <input required  type="text" class="text" name="title" value="{{ $course->title }}" placeholder="عنوان دوره" >
                <input type="text" class="text text-left " value="{{ $course->slug }}" name="slug" placeholder="نام انگلیسی دوره" >


                <div class="d-flex multi-text">
                    
                    <input type="text" value="{{ $course->proiority }}" class="text text-left mlg-15" name="priority" placeholder="ردیف دوره">
                 
                    <input type="text" value="{{ $course->price }}" placeholder="مبلغ دوره" name="price" class="text-left text mlg-15" >
                    
                    <input type="number"  value="{{ $course->percent }}" placeholder="درصد مدرس" name="percent" class="text-left text" >
                </div>


                <select name="teacher_id" required>
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @if ($teacher->id == $course->teacher_id) selected @endif>{{ $teacher->name }}</option>
                    @endforeach
                </select>
                <select name="typeBuy" required>
                    <option value="">نوع دوره</option>
                    @foreach ( \App\Course::$types as $key=>$type)
                    <option value="{{$key}}" @if($key == $course->type) selected @endif>{{ $type }}</option>
                    @endforeach
                </select>

                <select name="statusEnum" required>
                    <option value="">وضعیت دوره</option>
                    @foreach(\App\Course::$enums as $key=>$enum)
                    <option value="{{$key}}" @if( $key == $course->enum) selected @endif>{{$enum}}</option>
                   
                    @endforeach
                        </select>
  
                <select name="category_id" required>
                    <option value="">دسته بندی</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == $course->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>

  
                <div class="file-upload">
                    <div class="i-file-upload">
                        <span>آپلود بنر دوره</span>
                        <input type="file" class="file-upload"  name="image" value="{{$course->media->files}}" >
                    </div>
                    <span class="filesize"></span>
                    @if(isset($course->media))
                        <span class="selectedFiles">
                            تصویر فعلی:
                        <img src="/uploads/course/{{ $course->media->files }}" width="150" alt="">
                        </span>
                    @else
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    @endif
                </div>
                <textarea placeholder="توضیحات دوره" name="body" value="">{{$course->body}}</textarea>
                <button  type="submit" class="btn btn-webamooz_net">بروزرسانی دوره</button>
            </form>
        </div>
    </div>
@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
@endsection
