@extends('Dashboard.layout.master')
@section('contentDashboard')
@include('Dashboard.layout.header')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی کاربر</p>



            <form action="{{ route('users.update', $user->id) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
             
                <input name="name" placeholder="نام کاربر" type="text" value="{{ $user->name }}" class="text-left text"  required/>
                <x-validation-error field="name" />
                <input type="text" name="email" placeholder="ایمیل" value="{{ $user->email }}" class="text-left text" required />
                <x-validation-error field="email" />
                <input type="text" name="username" placeholder="نام کاربری" value="{{ $user->username }}" class="text-left text"  />
                <x-validation-error field="username" />
                <input type="text" name="mobile" placeholder="موبایل" value="{{ $user->mobile }}" class="text-left text"  />
                <x-validation-error field="mobile" />
                <input type="text" name="headline" placeholder="عنوان" value="{{ $user->headline }}" class="text-left text"  />
                <input type="text" name="website" placeholder="وب سایت" value="{{ $user->website }}" class="text-left text"  />
                <input type="text" name="linkedin" placeholder="لینکداین" value="{{ $user->linkedin }}" class="text-left text"  />
                <input type="text" name="facebook" placeholder="فیسبوک" value="{{ $user->facebook }}" class="text-left text"  />
                <input type="text" name="twitter" placeholder="توییتر" value="{{ $user->twitter }}" class="text-left text"  />
                <input type="text" name="youtube" placeholder="یوتیوب" value="{{ $user->youtube }}" class="text-left text"  />
                <input type="text" name="instagram" placeholder="اینستاگرام" value="{{ $user->instagram }}" class="text-left text"  />

                <select name="status" required>
                    <option value="">وضعیت حساب</option>
             
                    @foreach(\App\User::$statues as $key=>$status)
                    <option value="{{$key}}" @if( $key == $user->status) selected @endif>{{$status}}</option>
                   
                    @endforeach
                        </select>
                </select>

                <div class="file-upload">
                    <div class="i-file-upload">
                        <span>آپلود بنر دوره</span>
                        <input type="file" class="file-upload"  name="image" value="" >
                    </div>
                    <span class="filesize"></span>
                    @if(isset($user->media))
                        <span class="selectedFiles">
                            تصویر فعلی:
                        <img src="/uploads/user/{{ $user->image }}" width="150" alt="">
                        </span>
                    @else
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    @endif
                </div>
                <x-validation-error field="image" />

                <textarea placeholder="توضیحات دوره" name="body" value="">{{$user->body}}</textarea>


                <input type="password" name="password" class="text-left text" placeholder="پسورد جدید" value=""  />
                <textarea placeholder="بیو" name="bio" value="{{ $user->bio }}" ></textarea>
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی کاربر</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
 
@endsection