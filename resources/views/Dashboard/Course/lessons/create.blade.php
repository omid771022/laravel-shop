@extends('Dashboard.layout.master');
@section('contentDashboard')
    @include('Dashboard.layout.header')
    @include('Dashboard.commen.feedback')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">ایجاد درس جدید</p>

            <form action="{{ route('lesson.store', $id) }}" class="padding-30" method="post"
                enctype="multipart/form-data">
                @csrf
                <input name="title" placeholder="عنوان درس" type="text" class="text-left text text mlg-15" required />
                <input name="number" placeholder="مدت زمان جلسه" type="number" class="text-left text text mlg-15" required />
                <input name="time" placeholder="شماره جلسه " type="number" class="text-left text text mlg-15" />
                <input type="text" name="slug" placeholder="نام انگلیسی درس اختیاری" class="text-left text text mlg-15"
                    required />
                @if (count($seasons))
                    <select name="season_id" required>
                        <option value="">انتخاب سرفصل درس</option>
                        @foreach ($seasons as $season)
                            <option value="{{ $season->id }}" @if ($season->id == old('season_id')) selected @endif>{{ $season->title }}</option>
                        @endforeach
                    </select>
                @endif
                <div class="w-50">
                    <p class="box__title">ایا این درس رایگان است ؟ </p>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-1" name="free" value="0" type="radio" checked="">
                        <label for="lesson-upload-field-1">خیر</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-2" name="free" value="1" type="radio">
                        <label for="lesson-upload-field-2">بله</label>
                    </div>
                </div>
                <div class="file-upload">
                    <div class="i-file-upload">
                        <span>آپلود درس</span>
                        <input type="file" class="file-upload" id="lesson_file" name="lesson_file"
                            {{ old('lesson_file') }} />
                    </div>
                    <span class="filesize"></span>
                    <span class="selectedFiles">فایلی انتخاب نشده است</span>
                </div>
                <textarea placeholder="توضیحات درس" name="body"></textarea>
                <br>
                <button class="btn btn-webamooz_net">ایجاد درس</button>
            </form>
        </div>
    </div>
@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
@endsection
