@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')
    @include('Dashboard.commen.feedback')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">ایجاد درس جدید</p>
            <form action="{{ route('lessons.update', [$course->id, $lesson->id ]) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <input name="title" placeholder="عنوان درس *" type="text" value="{{ $lesson->title }}"  class="text-left text text mlg-15"   required/>
                <input type="text" name="slug" placeholder="نام انگلیسی درس اختیاری" class="text-left text text mlg-15" value="{{ $lesson->slug }}" />
                <input type="number" name="time" placeholder="مدت زمان جلسه *" class="text-left text text mlg-15"  value="{{ $lesson->time }}" required />
                <input type="number" name="number" placeholder="شماره جلسه" class="text-left text text mlg-15"  value="{{ $lesson->proiority }}"/>

                @if(count($seasons))
                    <select name="season_id" required>
                        <option value="">انتخاب سرفصل درس *</option>
                        @foreach($seasons as $season)
                        <option value="{{ $season->id }}" @if($season->id == $lesson->season_id) selected @endif>{{ $season->title }}</option>
                        @endforeach
                    </select>
                @endif

                <div class="w-50">
                    <p class="box__title">ایا این درس رایگان است ؟ * </p>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-1" name="free" value="0" type="radio" @if(! $lesson->free) checked="" @endif>
                        <label for="lesson-upload-field-1">خیر</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-2" name="free" value="1" type="radio" @if($lesson->free) checked="" @endif>
                        <label for="lesson-upload-field-2">بله</label>
                    </div>
                </div>

         

                <div class="file-upload">
                    <div class="i-file-upload">
                        <span>آپلود درس</span>
                        <input type="file" class="file-upload" id="lesson_file" name="lesson_file"
                           value ="{{$lesson->media->files}}" />
                    </div>
                    <span class="filesize"></span>
                    @if(isset($lesson->media))
                        <span class="selectedFiles">
                            فایل فعلی :
                     <p>   {{ $lesson->media->files }}</p>
                        </span>
                    @else
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    @endif
                </div>

                <textarea placeholder="توضیحات درس" name="body" >{{ $lesson->body }}</textarea>
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی درس</button>
            </form>
        </div>
    </div>
    @section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
@endsection
